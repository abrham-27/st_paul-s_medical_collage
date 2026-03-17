import { type JSX } from 'react';
import './Departments.css'

interface SubDept {
    name: string;
    desc?: string;
}

interface BasicScienceGroup {
    id: string;
    category: string;
    icon: string;
    description: string;
    subDepartments: SubDept[];
}

const basicSciencesGroups: BasicScienceGroup[] = [
    {
        id: "morphological",
        category: "Morphological & Functional Sciences",
        icon: "🦴",
        description: "Study of the human body's structure and its intricate physical functions.",
        subDepartments: [
            { name: "Anatomy" },
            { name: "Physiology" },
            { name: "Histology" },
            { name: "Embryology" }
        ]
    },
    {
        id: "molecular",
        category: "Cellular & Molecular Sciences",
        icon: "🧪",
        description: "Exploring the biochemical and molecular foundations of life processes.",
        subDepartments: [
            { name: "Biochemistry" },
            { name: "Molecular Biology" },
            { name: "Genetics" }
        ]
    },
    {
        id: "pathobiology",
        category: "Pathobiology & Infection",
        icon: "🔬",
        description: "Detailed investigation into the nature of diseases and infectious agents.",
        subDepartments: [
            { name: "Pathology" },
            { name: "Microbiology" },
            { name: "Parasitology" }
        ]
    },
    {
        id: "pharmacology_immuno",
        category: "Pharmacology & Immunology",
        icon: "💊",
        description: "Study of drug interactions and the body's defensive immune responses.",
        subDepartments: [
            { name: "Pharmacology" },
            { name: "Immunology" },
            { name: "Clinical Pharmacology" }
        ]
    }
];

export default function BasicSciences({ onBack }: { onBack: () => void }): JSX.Element {
    return (
        <div className="dept-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Departments</button>
                <header className="dept-header">
                    <span className="dept-tag">Scientific Foundation</span>
                    <h1>Basic Sciences</h1>
                    <p className="intro">The fundamental building blocks of medical knowledge at St. Paul's, providing the scientific basis for advanced clinical practice and research.</p>
                </header>
                
                <div className="clinical-sections">
                    {basicSciencesGroups.map(group => (
                        <div key={group.id} className="clinical-group-card">
                            <div className="group-header">
                                <span className="group-icon">{group.icon}</span>
                                <div className="group-title-info">
                                    <h3>{group.category}</h3>
                                    <p className="group-desc">{group.description}</p>
                                </div>
                            </div>
                            
                            <div className="sub-dept-links">
                                <label>Academic Units:</label>
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
