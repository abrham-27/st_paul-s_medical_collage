import { type JSX, useState } from 'react';
import './Announcements.css';

interface Announcement {
    id: number;
    title: string;
    description: string;
    date: string;
    target: 'all' | 'staff' | 'students' | 'vacancies';
    icon: string;
}

const mockAnnouncements: Announcement[] = [
    {
        id: 1,
        title: "Holiday Notice: Victory of Adwa Celebration",
        description: "The college will be closed on March 2nd in observance of the Victory of Adwa. Essential medical services will remain operational.",
        date: "March 01, 2026",
        target: "all",
        icon: "🇪🇹"
    },
    {
        id: 2,
        title: "Revised Policy on Clinical Staff Shift Handover",
        description: "In order to improve patient safety, new mandatory shift handover protocols will be enforced starting next Monday.",
        date: "March 09, 2026",
        target: "staff",
        icon: "📋"
    },
    {
        id: 3,
        title: "Mid-Term Examination Schedule - 2026 Semester II",
        description: "The comprehensive mid-term schedule for all medical and nursing students has been posted on the student portal.",
        date: "March 07, 2026",
        target: "students",
        icon: "📝"
    },
    {
        id: 4,
        title: "Vacancy: Assistant Professor of Cardiovascular Surgery",
        description: "SPHMMC is seeking a experienced professional for the position of Assistant Professor in the Department of Surgery.",
        date: "March 05, 2026",
        target: "vacancies",
        icon: "💼"
    },
    {
        id: 5,
        title: "New Research Grant Opportunities for Faculty Members",
        description: "Applications are now open for the 2026 Internal Research Grant. Faculty members are encouraged to submit their proposals.",
        date: "March 04, 2026",
        target: "staff",
        icon: "🔬"
    },
    {
        id: 6,
        title: "Student Health Insurance Renewal Deadline",
        description: "All students must renew their mandatory health insurance coverage by March 15th to avoid late fees.",
        date: "March 03, 2026",
        target: "students",
        icon: "🏥"
    },
    {
        id: 7,
        title: "Vacancy: Senior Laboratory Technician",
        description: "Join our state-of-the-art laboratory at SPHMMC. We are looking for a skilled technician with experience in molecular diagnostics.",
        date: "March 02, 2026",
        target: "vacancies",
        icon: "🧬"
    }
];

export default function Announcements({ onBack }: { onBack: () => void }): JSX.Element {
    const [activeTab, setActiveTab] = useState<'all' | 'staff' | 'students' | 'vacancies'>('all');

    const filteredAnnouncements = activeTab === 'all' 
        ? mockAnnouncements 
        : mockAnnouncements.filter(a => a.target === activeTab);

    return (
        <div className="announcements-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Campus Home</button>
                
                <header className="announcements-header">
                    <h1>College Announcements</h1>
                    <p>Official notices, administrative updates, and career opportunities at St. Paul's Hospital Millennium Medical College.</p>
                </header>

                <nav className="announcements-nav">
                    <button 
                        className={`announcements-nav-link ${activeTab === 'all' ? 'active' : ''}`}
                        onClick={() => setActiveTab('all')}
                    >
                        All Notices
                    </button>
                    <button 
                        className={`announcements-nav-link ${activeTab === 'staff' ? 'active' : ''}`}
                        onClick={() => setActiveTab('staff')}
                    >
                        For Staff
                    </button>
                    <button 
                        className={`announcements-nav-link ${activeTab === 'students' ? 'active' : ''}`}
                        onClick={() => setActiveTab('students')}
                    >
                        For Students
                    </button>
                    <button 
                        className={`announcements-nav-link ${activeTab === 'vacancies' ? 'active' : ''}`}
                        onClick={() => setActiveTab('vacancies')}
                    >
                        Vacancies
                    </button>
                </nav>

                <div className="announcements-grid">
                    {filteredAnnouncements.length > 0 ? (
                        filteredAnnouncements.map(item => (
                            <div key={item.id} className="announcement-card animate-in">
                                <div className="announcement-icon-box">
                                    {item.icon}
                                </div>
                                <div className="announcement-content">
                                    <div className="announcement-meta">
                                        <span className={`announcement-badge badge-${item.target}`}>
                                            {item.target}
                                        </span>
                                        <span className="announcement-date">{item.date}</span>
                                    </div>
                                    <h3>{item.title}</h3>
                                    <p>{item.description}</p>
                                </div>
                                <div className="announcement-action">
                                    <a href="#" className="view-details-btn">View Details ↗</a>
                                </div>
                            </div>
                        ))
                    ) : (
                        <div style={{ textAlign: 'center', padding: '50px', color: '#64748b' }}>
                            <p>No announcements found in this category.</p>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
