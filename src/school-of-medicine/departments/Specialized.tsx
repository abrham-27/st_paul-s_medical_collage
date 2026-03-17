import { type JSX } from 'react';
import './Departments.css'

interface SubDept {
    name: string;
    desc?: string;
}

interface SpecializedGroup {
    id: string;
    category: string;
    icon: string;
    description: string;
    subDepartments: SubDept[];
}

const specializedGroups: SpecializedGroup[] = [
    {
        id: "advanced_centers",
        category: "Advanced Medical Specialty Centers",
        icon: "🎗️",
        description: "Leading centers of excellence providing specialized care and pioneering medical research.",
        subDepartments: [
            { name: "Oncology" },
            { name: "Radiotherapy" },
            { name: "Infectious Diseases" },
            { name: "Nephrology" },
            { name: "Kidney Transplant Center" }
        ]
    },
    {
        id: "trauma_rehab",
        category: "Emergency, Trauma & Rehabilitation",
        icon: "🚨",
        description: "Comprehensive services for acute trauma, recovery, and long-term supportive care.",
        subDepartments: [
            { name: "Trauma & Orthopedics" },
            { name: "Emergency Medicine" },
            { name: "Rehabilitation Medicine" },
            { name: "Palliative Care" }
        ]
    }
];

export default function Specialized({ onBack }: { onBack: () => void }): JSX.Element {
    return (
        <div className="dept-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Departments</button>
                <header className="dept-header">
                    <span className="dept-tag">Centers of Excellence</span>
                    <h1>Specialized Units</h1>
                    <p className="intro">SPHMMC's advanced centers of excellence, hosting Ethiopia's premier facilities for specialized medical solutions and surgical innovations.</p>
                </header>
                
                <div className="clinical-sections">
                    {specializedGroups.map(group => (
                        <div key={group.id} className="clinical-group-card">
                            <div className="group-header">
                                <span className="group-icon">{group.icon}</span>
                                <div className="group-title-info">
                                    <h3>{group.category}</h3>
                                    <p className="group-desc">{group.description}</p>
                                </div>
                            </div>
                            
                            <div className="sub-dept-links">
                                <label>Departmental Units:</label>
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
