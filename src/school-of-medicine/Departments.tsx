import { type JSX } from 'react';
import './DepartmentsLanding.css';

interface PrimaryDept {
    id: string;
    title: string;
    icon: string;
    desc: string;
}

const categories: PrimaryDept[] = [
    { id: 'basic', title: 'Basic Sciences Departments', icon: '🔬', desc: 'Anatomy, Physiology, Biochemistry, and foundational sciences.' },
    { id: 'preclinical', title: 'Preclinical and Paraclinical', icon: '🏥', desc: 'Community Health, Forensic Medicine, and Medical Ethics.' },
    { id: 'clinical', title: 'Clinical Departments', icon: '🩺', desc: 'Internal Medicine, Surgery, Pediatrics, and Clinical Care.' },
    { id: 'specialized', title: 'Specialized Units', icon: '🎗️', desc: 'Oncology, Nephrology, Trauma, and advanced specialized units.' }
];

export default function DepartmentsLanding({ onBack, onSelect }: { onBack: () => void, onSelect: (id: string) => void }): JSX.Element {
    return (
        <div className="dept-landing-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Home</button>
                <header className="header">
                    <h1>Medical College Departments</h1>
                    <p>Our academic structure is built upon these core pillars of medical knowledge and practice.</p>
                </header>

                <div className="categories-grid">
                    {categories.map(cat => (
                        <button key={cat.id} className="cat-card" onClick={() => onSelect(cat.id)}>
                            <div className="icon">{cat.icon}</div>
                            <div className="info">
                                <h3>{cat.title}</h3>
                                <p>{cat.desc}</p>
                            </div>
                            <div className="arrow">↗</div>
                        </button>
                    ))}
                </div>
            </div>
        </div>
    );
}
