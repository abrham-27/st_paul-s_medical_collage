import { type JSX, useState, useEffect } from 'react'
import { apiService, type LatestPost } from '../services/api'
import './Documents.css'

const fallback: LatestPost[] = [
    { id: 1, title: 'SPHMMC Strategic Plan 2025-2030', slug: 'strategic-plan', content: 'The five-year strategic plan outlining institutional goals, priorities and key performance indicators.', type: 'document', featured_image: null, file_path: '#', event_date: null, author: 'Office of the Provost', status: 'published', created_at: '2026-03-01T00:00:00Z', updated_at: '2026-03-01T00:00:00Z' },
    { id: 2, title: 'Academic Quality Assurance Policy', slug: 'qa-policy', content: 'Guidelines and standards for maintaining academic quality across all programs and departments.', type: 'document', featured_image: null, file_path: '#', event_date: null, author: 'Academic Office', status: 'published', created_at: '2026-02-15T00:00:00Z', updated_at: '2026-02-15T00:00:00Z' },
    { id: 3, title: 'Research Ethics Guidelines 2026', slug: 'research-ethics', content: 'Updated ethical guidelines for all research activities conducted at SPHMMC and affiliated institutions.', type: 'document', featured_image: null, file_path: '#', event_date: null, author: 'IRB Office', status: 'published', created_at: '2026-02-01T00:00:00Z', updated_at: '2026-02-01T00:00:00Z' },
    { id: 4, title: 'Student Handbook 2025/26', slug: 'student-handbook', content: 'Comprehensive guide covering student rights, responsibilities, academic regulations and campus services.', type: 'document', featured_image: null, file_path: '#', event_date: null, author: 'Student Affairs', status: 'published', created_at: '2026-01-15T00:00:00Z', updated_at: '2026-01-15T00:00:00Z' },
    { id: 5, title: 'Annual Report 2024/25', slug: 'annual-report-2025', content: 'Comprehensive annual report covering academic achievements, research output and financial performance.', type: 'document', featured_image: null, file_path: '#', event_date: null, author: 'Office of the Provost', status: 'published', created_at: '2025-12-01T00:00:00Z', updated_at: '2025-12-01T00:00:00Z' },
    { id: 6, title: 'HR Policy Manual — Revised Edition', slug: 'hr-policy', content: 'The revised human resources policy manual covering recruitment, conduct, leave and benefits.', type: 'document', featured_image: null, file_path: '#', event_date: null, author: 'HR Department', status: 'published', created_at: '2025-11-01T00:00:00Z', updated_at: '2025-11-01T00:00:00Z' },
];

function fileIcon(title: string) {
    const t = title.toLowerCase();
    if (t.includes('report') || t.includes('annual')) return '📊';
    if (t.includes('policy') || t.includes('guideline')) return '📋';
    if (t.includes('handbook') || t.includes('manual')) return '📖';
    if (t.includes('plan') || t.includes('strategic')) return '🗺️';
    if (t.includes('research') || t.includes('ethics')) return '🔬';
    return '📄';
}

function decodeHtmlEntities(html: string) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = html;
    return textarea.value;
}

function stripHtml(html: string) {
    return decodeHtmlEntities(html.replace(/<[^>]+>/g, ' ')).replace(/\s+/g, ' ').trim();
}

export default function Documents(): JSX.Element {
    const [docs, setDocs] = useState<LatestPost[]>(fallback);
    const [loading, setLoading] = useState(true);
    const [search, setSearch] = useState('');

    useEffect(() => {
        apiService.getPostsByType('document')
            .then(r => { if (r.success && r.data.data.length > 0) setDocs(r.data.data); })
            .catch(() => {})
            .finally(() => setLoading(false));
    }, []);

    const filtered = docs.filter(d => d.title.toLowerCase().includes(search.toLowerCase()));

    return (
        <div className="lp-page lp-docs-page">
            <div className="lp-hero-bar">
                <div className="lp-hero-text">
                    <span className="lp-label">SPHMMC · Resources</span>
                    <h1>Documents</h1>
                    <p>Access and download official institutional publications and policies.</p>
                </div>
            </div>
            <div className="lp-container">
                <div className="docs-search-row">
                    <input
                        className="docs-search"
                        type="text"
                        placeholder="Search documents..."
                        value={search}
                        onChange={e => setSearch(e.target.value)}
                    />
                </div>
                {loading && <div className="lp-loading">Loading...</div>}
                <div className="docs-grid">
                    {filtered.map((doc, idx) => (
                        <div key={doc.id} className="doc-card" style={{ animationDelay: `${idx * 0.06}s` }}>
                            <div className="doc-icon-col">
                                <span className="doc-icon">{fileIcon(doc.title)}</span>
                            </div>
                            <div className="doc-body">
                                <h3>{doc.title}</h3>
                                {doc.content && <p>{stripHtml(doc.content).slice(0, 100)}...</p>}
                                <div className="doc-meta">
                                    {doc.author && <span>{doc.author}</span>}
                                    <span>{new Date(doc.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</span>
                                </div>
                            </div>
                            {doc.file_path && (
                                <a href={doc.file_path} target="_blank" rel="noopener noreferrer" className="doc-download-btn">
                                    Download
                                </a>
                            )}
                        </div>
                    ))}
                    {filtered.length === 0 && !loading && (
                        <p className="lp-empty">No documents match your search.</p>
                    )}
                </div>
            </div>
        </div>
    );
}
