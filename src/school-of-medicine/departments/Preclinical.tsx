import { type JSX } from 'react';
import './Departments.css'

interface SubDept {
    name: string;
    desc?: string;
}

interface PreclinicalGroup {
    id: string;
    category: string;
    icon: string;
    description: string;
    subDepartments: SubDept[];
}

const preclinicalGroups: PreclinicalGroup[] = [
    {
        id: "public_health",
        category: "Public Health & Social Medicine",
        icon: "🏘️",
        description: "Focusing on community wellness, health policy, and social determinants of health.",
        subDepartments: [
            { name: "Community Medicine" },
            { name: "Public Health" },
            { name: "Social Medicine" },
            { name: "Epidemiology" }
        ]
    },
    {
        id: "behavioral",
        category: "Behavioral & Ethical Sciences",
        icon: "⚖️",
        description: "Understanding the psychological and ethical dimensions of medical practice.",
        subDepartments: [
            { name: "Medical Ethics" },
            { name: "Behavioral Sciences" },
            { name: "Medical Sociology" }
        ]
    },
    {
        id: "legal_education",
        category: "Medico-Legal & Education",
        icon: "🎓",
        description: "Integrating legal medicine with advanced pedagogical methods in medical training.",
        subDepartments: [
            { name: "Forensic Medicine" },
            { name: "Medical Education" },
            { name: "Clinical Skills Training" }
        ]
    }
];

export default function Preclinical({ onBack }: { onBack: () => void }): JSX.Element {
    return (
        <div className="dept-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Departments</button>
                <header className="dept-header">
                    <span className="dept-tag">Bridging Sciences & Practice</span>
                    <h1>Preclinical & Paraclinical</h1>
                    <p className="intro">Integrating foundational scientific knowledge with public health, ethics, and professional clinical preparation.</p>
                </header>
                
                <div className="clinical-sections">
                    {preclinicalGroups.map(group => (
                        <div key={group.id} className="clinical-group-card">
                            <div className="group-header">
                                <span className="group-icon">{group.icon}</span>
                                <div className="group-title-info">
                                    <h3>{group.category}</h3>
                                    <p className="group-desc">{group.description}</p>
                                </div>
                            </div>
                            
                            <div className="sub-dept-links">
                                <label>Specialized Units:</label>
                                <div className="links-grid">
                                    {group.subDepartments.map((sub, idx) => (
                                        <a key={idx} href="#" className="sub-dept-item">
                                            <span className="dot"></span> {sub.name}
                                        </a>
                                    ))}
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
