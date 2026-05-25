import { type JSX, useState, useEffect } from 'react';
import './Announcements.css';
import { apiService, type LatestPost } from '../services/api';

interface Announcement {
    id: number;
    title: string;
    description: string;
    content?: string;
    date: string;
    target: 'all' | 'staff' | 'students' | 'vacancies';
    icon: string;
}

const fallback: Announcement[] = [
    { id: 1, title: 'New Academic Calendar 2026/27 Released', description: 'The academic calendar for the upcoming year has been officially approved and published for all students and staff.', date: 'Mar 28, 2026', target: 'all', icon: '📅' },
    { id: 2, title: 'Postgraduate Residency Application Now Open', description: 'Applications for the 2026 postgraduate residency programs in Cardiology, Surgery, and Pediatrics are now open.', date: 'Mar 20, 2026', target: 'students', icon: '📝' },
    { id: 3, title: 'Staff Development Workshop — April 15', description: 'All academic staff are invited to attend the professional development workshop on evidence-based teaching methods.', date: 'Mar 15, 2026', target: 'staff', icon: '📋' },
    { id: 4, title: 'Library Extended Hours During Exam Period', description: 'The main library will operate extended hours from 6am to midnight during the final examination period.', date: 'Mar 10, 2026', target: 'students', icon: '📚' },
    { id: 5, title: 'Vacancy: Senior Lecturer — Department of Surgery', description: 'SPHMMC invites applications from qualified candidates for the position of Senior Lecturer in the Department of Surgery.', date: 'Mar 5, 2026', target: 'vacancies', icon: '💼' },
    { id: 6, title: 'Updated HR Policy Effective April 1', description: 'The revised Human Resources policy document is now available on the staff portal. All staff are required to review the changes.', date: 'Feb 28, 2026', target: 'staff', icon: '📋' },
];

function decodeHtmlEntities(html: string) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = html;
    return textarea.value;
}

function stripHtml(html: string) {
    return decodeHtmlEntities(html.replace(/<[^>]+>/g, ' ')).replace(/\s+/g, ' ').trim();
}

export default function Announcements({ onBack }: { onBack: () => void }): JSX.Element {
    const [activeTab, setActiveTab] = useState<'all' | 'students' | 'staff' | 'vacancies'>('all');
    const [announcements, setAnnouncements] = useState<Announcement[]>(fallback);
    const [selectedAnnouncement, setSelectedAnnouncement] = useState<Announcement | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        apiService.getLatestAnnouncements()
            .then(res => {
                if (res.success && res.data.length > 0) {
                    setAnnouncements(res.data.map((p: LatestPost) => {
                        let target: Announcement['target'] = 'all';
                        const t = p.title.toLowerCase();
                        if (t.includes('vacanc') || t.includes('job')) target = 'vacancies';
                        else if (t.includes('student') || t.includes('exam')) target = 'students';
                        else if (t.includes('staff') || t.includes('policy')) target = 'staff';
                        return {
                            id: p.id, title: p.title,
                            description: stripHtml(p.content || ''),
                            date: new Date(p.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }),
                            target,
                            icon: target === 'vacancies' ? '💼' : target === 'students' ? '📝' : target === 'staff' ? '📋' : '📢',
                        };
                    }));
                }
            })
            .catch(() => {})
            .finally(() => setLoading(false));
    }, []);

    const filtered = activeTab === 'all' ? announcements : announcements.filter(a => a.target === activeTab);

    return (
        <div className="lp-page lp-ann-page">
            <div className="lp-hero-bar">
                <button className="lp-back-btn" onClick={onBack}>← Back</button>
                <div className="lp-hero-text">
                    <span className="lp-label">SPHMMC · Official</span>
                    <h1>Announcements</h1>
                    <p>Official notices, administrative updates and career opportunities.</p>
                </div>
            </div>

            <div className="lp-container">
                <nav className="ann-tabs">
                    {(['all', 'students', 'staff', 'vacancies'] as const).map(tab => (
                        <button
                            key={tab}
                            className={`ann-tab${activeTab === tab ? ' active' : ''}`}
                            onClick={() => setActiveTab(tab)}
                        >
                            {tab === 'all' ? 'All Notices' : tab.charAt(0).toUpperCase() + tab.slice(1)}
                        </button>
                    ))}
                </nav>

                {loading && <div className="lp-loading">Loading…</div>}

                <div className="ann-grid">
                    {filtered.length > 0 ? filtered.map((item, idx) => (
                        <article
                            key={item.id}
                            className="ann-card"
                            style={{ animationDelay: `${idx * 0.06}s` }}
                            onClick={() => setSelectedAnnouncement(item)}
                            role="button"
                            tabIndex={0}
                            onKeyDown={e => { if (e.key === 'Enter' || e.key === ' ') { setSelectedAnnouncement(item); e.preventDefault(); } }}
                        >
                            <div className={`ann-icon-col ann-icon--${item.target}`}>
                                <span>{item.icon}</span>
                            </div>
                            <div className="ann-body">
                                <div className="ann-meta-row">
                                    <span className={`ann-pill ann-pill--${item.target}`}>{item.target}</span>
                                    <span className="ann-date-sm">{item.date}</span>
                                </div>
                                <h3>{item.title}</h3>
                                <p>{item.description.slice(0, 130)}{item.description.length > 130 ? '…' : ''}</p>
                            </div>
                            <div className="ann-action-col">
                                <span className="ann-arrow">↗</span>
                            </div>
                        </article>
                    )) : (
                        <p className="lp-empty">No announcements in this category.</p>
                    )}
                </div>
                {selectedAnnouncement && (
                    <div
                        className="detail-modal"
                        style={{ position: 'fixed', inset: 0, zIndex: 9999, backgroundColor: 'rgba(0,0,0,0.7)', display: 'flex', alignItems: 'center', justifyContent: 'center', padding: 20 }}
                        onClick={() => setSelectedAnnouncement(null)}
                    >
                        <div
                            style={{ background: '#fff', borderRadius: 20, width: '100%', maxWidth: 760, maxHeight: '90vh', overflowY: 'auto', position: 'relative', padding: 28 }}
                            onClick={e => e.stopPropagation()}
                        >
                            <button
                                type="button"
                                onClick={() => setSelectedAnnouncement(null)}
                                style={{ position: 'absolute', top: 18, right: 18, border: 'none', background: 'transparent', fontSize: 28, lineHeight: 1, cursor: 'pointer' }}
                                aria-label="Close detail"
                            >
                                ×
                            </button>
                            <div style={{ marginBottom: 16, color: '#6b7280', fontSize: 14 }}>{selectedAnnouncement.date}</div>
                            <h2 style={{ marginTop: 0, marginBottom: 16 }}>{selectedAnnouncement.title}</h2>
                            <div style={{ color: '#111', lineHeight: 1.75 }} dangerouslySetInnerHTML={{ __html: selectedAnnouncement.content || selectedAnnouncement.description }} />
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
}
