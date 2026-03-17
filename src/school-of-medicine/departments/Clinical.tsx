import { type JSX } from 'react';
import './Departments.css'

interface SubDept {
    name: string;
    desc?: string;
}

interface ClinicalDept {
    id: string;
    category: string;
    icon: string;
    description: string;
    subDepartments: SubDept[];
}

const clinicalGroups: ClinicalDept[] = [
    {
        id: "medicine",
        category: "Medicine and Allied Specialties",
        icon: "🏥",
        description: "Primary and specialized adult medical care services.",
        subDepartments: [
            { name: "Internal Medicine" },
            { name: "Cardiology" },
            { name: "Dermatology" },
            { name: "Neurology" },
            { name: "Psychiatry" }
        ]
    },
    {
        id: "surgery",
        category: "Surgery and Allied Specialties",
        icon: "🔪",
        description: "Advanced surgical procedures and postoperative care.",
        subDepartments: [
            { name: "General Surgery" },
            { name: "Orthopedics" },
            { name: "Neurosurgery" },
            { name: "Urology" },
            { name: "Plastic and Reconstructive Surgery" }
        ]
    },
    {
        id: "pediatrics",
        category: "Pediatrics and Child Health",
        icon: "👶",
        description: "Specialized healthcare for infants, children, and adolescents.",
        subDepartments: [
            { name: "General Pediatrics" },
            { name: "Neonatology" },
            { name: "Pediatric Cardiology" },
            { name: "Pediatric Surgery" }
        ]
    },
    {
        id: "obgyn",
        category: "Obstetrics and Gynecology",
        icon: "🤰",
        description: "Comprehensive women's health and maternal services.",
        subDepartments: [
            { name: "General Obstetrics" },
            { name: "Gynecology" },
            { name: "Maternal and Fetal Medicine" }
        ]
    },
    {
        id: "radiology",
        category: "Radiology and Imaging",
        icon: "☢️",
        description: "Cutting-edge diagnostic and interventional imaging.",
        subDepartments: [
            { name: "Diagnostic Radiology" },
            { name: "Interventional Radiology" }
        ]
    },
    {
        id: "anesthesiology",
        category: "Anesthesiology",
        icon: "😴",
        description: "Pain management, critical care, and perioperative medicine.",
        subDepartments: [
            { name: "General Anesthesia" },
            { name: "Pain Management" },
            { name: "Critical Care Medicine" }
        ]
    },
    {
        id: "ophthalmology",
        category: "Ophthalmology",
        icon: "👁️",
        description: "Comprehensive eye care and precision ophthalmic surgery.",
        subDepartments: [
            { name: "Focused on eye care and surgery" }
        ]
    },
    {
        id: "ent",
        category: "Otorhinolaryngology (ENT)",
        icon: "👂",
        description: "Specialized care for disorders of the ear, nose, and throat.",
        subDepartments: [
            { name: "Focused on ear, nose, throat, and related structures" }
        ]
    },
    {
        id: "ortho_standalone",
        category: "Orthopedics",
        icon: "🦴",
        description: "Excellence in bone, joint, and musculoskeletal system care.",
        subDepartments: [
            { name: "Covering bone, joint, and spine conditions" }
        ]
    }
];

export default function Clinical({ onBack }: { onBack: () => void }): JSX.Element {
    return (
        <div className="dept-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Departments</button>
                <header className="dept-header">
                    <span className="dept-tag">Clinical Excellence</span>
                    <h1>Clinical Departments</h1>
                    <p className="intro">SPHMMC provides high-level medical education combined with specialized clinical training across multiple healthcare pillars.</p>
                </header>
                
                <div className="clinical-sections">
                    {clinicalGroups.map(group => (
                        <div key={group.id} className="clinical-group-card">
                            <div className="group-header">
                                <span className="group-icon">{group.icon}</span>
                                <div className="group-title-info">
                                    <h3>{group.category}</h3>
                                    <p className="group-desc">{group.description}</p>
                                </div>
                            </div>
                            
                            <div className="sub-dept-links">
                                <label>Sub-Departments & Units:</label>
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
