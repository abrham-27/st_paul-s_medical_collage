import { useState, type JSX } from 'react';
import './HealthTips.css';

interface HealthDetail {
    symptoms: string[];
    prevention: string[];
    advice: string[];
}

interface DiseaseType {
    id: string;
    name: string;
    description: string;
    details: HealthDetail;
}

interface Category {
    id: string;
    name: string;
    description: string;
    icon: string;
    diseases: DiseaseType[];
}

const healthData: Category[] = [
    {
        id: "cancer",
        name: "Cancer",
        description: "Authoritative resources on various types of cancer, their early detection, and management.",
        icon: "🎗️",
        diseases: [
            {
                id: "breast-cancer",
                name: "Breast Cancer",
                description: "One of the most common cancers affecting women worldwide.",
                details: {
                    symptoms: ["Painless lump in the breast", "Change in breast shape or size", "Skin dimpling or redness", "Nipple discharge"],
                    prevention: ["Regular self-examination", "Clinical breast exams and mammograms", "Maintaining a healthy weight", "Limiting alcohol consumption"],
                    advice: ["Early detection significantly improves survival rates", "Consult a doctor immediately if you find a lump", "Genetic counseling for those with family history"]
                }
            },
            {
                id: "lung-cancer",
                name: "Lung Cancer",
                description: "Leading cause of cancer-related deaths, often linked to smoking.",
                details: {
                    symptoms: ["Persistent cough", "Coughing up blood", "Shortness of breath", "Chest pain", "Unexplained weight loss"],
                    prevention: ["Avoid smoking and tobacco products", "Reduce exposure to secondhand smoke", "Test home for radon", "Use protective gear in hazardous workplaces"],
                    advice: ["Quitting smoking at any age reduces risk", "Early screening for high-risk individuals is vital", "Support groups can help manage the emotional impact"]
                }
            },
            {
                id: "prostate-cancer",
                name: "Prostate Cancer",
                description: "Common cancer in men, often slow-growing but requiring monitoring.",
                details: {
                    symptoms: ["Frequent urination, especially at night", "Difficulty starting or stopping urination", "Blood in urine or semen", "Bone pain in the lower back or hips"],
                    prevention: ["Maintain a healthy diet rich in fruits and vegetables", "Regular physical activity", "Screening for men over 50 (or earlier if high risk)"],
                    advice: ["Discuss screening pros and cons with your doctor", "Many prostate cancers grow slowly and may not even require immediate treatment", "Choose a healthy lifestyle to support overall prostate health"]
                }
            }
        ]
    },
    {
        id: "cardiovascular",
        name: "Cardiovascular",
        description: "Information on conditions affecting the blood vessels and circulation system.",
        icon: "🩸",
        diseases: [
            {
                id: "hypertension",
                name: "Hypertension",
                description: "High blood pressure that can lead to severe health complications.",
                details: {
                    symptoms: ["Severe headaches", "Fatigue or confusion", "Vision problems", "Chest pain", "Difficulty breathing"],
                    prevention: ["Reduce salt intake", "Eat a balanced diet (DASH diet)", "Regular exercise", "Limit alcohol and caffeine"],
                    advice: ["Monitor your blood pressure regularly at home", "Take prescribed medications consistently", "Reduce stress through relaxation techniques"]
                }
            },
            {
                id: "stroke",
                name: "Stroke",
                description: "A medical emergency when blood supply to part of the brain is interrupted.",
                details: {
                    symptoms: ["Face drooping", "Arm weakness", "Speech difficulty", "Sudden confusion", "Trouble seeing in one or both eyes"],
                    prevention: ["Manage high blood pressure", "Control cholesterol and diabetes", "Quit smoking", "Stay physically active"],
                    advice: ["Remember FAST (Face, Arms, Speech, Time)", "Immediate medical attention is critical", "Rehabilitation is key to recovery post-stroke"]
                }
            }
        ]
    },
    {
        id: "heart",
        name: "Heart Health",
        description: "Dedicated resources for maintaining a healthy heart and managing heart-specific conditions.",
        icon: "❤️",
        diseases: [
            {
                id: "heart-failure",
                name: "Heart Failure",
                description: "Condition where the heart doesn't pump blood as well as it should.",
                details: {
                    symptoms: ["Shortness of breath during activity or lying down", "Fatigue and weakness", "Swelling in legs, ankles, and feet", "Rapid or irregular heartbeat"],
                    prevention: ["Manage underlying conditions like CAD and hypertension", "Maintain a healthy weight", "Lower high cholesterol", "Don't smoke"],
                    advice: ["Follow a low-sodium diet", "Track your daily fluid intake if advised", "Exercise within your doctor's recommended limits"]
                }
            },
            {
                id: "arrhythmia",
                name: "Arrhythmia",
                description: "Problems with the rhythm or rate of the heartbeat.",
                details: {
                    symptoms: ["Fluttering in the chest", "Racing heartbeat (tachycardia)", "Slow heartbeat (bradycardia)", "Chest pain", "Shortness of breath"],
                    prevention: ["Reduce stress", "Limit caffeine and nicotine", "Avoid stimulants in over-the-counter medications", "Treat sleep apnea if present"],
                    advice: ["Learn to check your own pulse", "Identify triggers for your irregular heartbeats", "Carry a list of your medications at all times"]
                }
            }
        ]
    },
    {
        id: "infectious",
        name: "Infectious Diseases",
        description: "Preventing and managing diseases caused by organisms like bacteria, viruses, or parasites.",
        icon: "🦠",
        diseases: [
            {
                id: "malaria",
                name: "Malaria",
                description: "Mosquito-borne disease prevalent in many tropical regions.",
                details: {
                    symptoms: ["Fever and chills", "Headache", "Nausea and vomiting", "Muscle pain and fatigue"],
                    prevention: ["Sleep under insecticide-treated nets", "Use mosquito repellents", "Wear protective clothing", "Take preventive antimalarial medication when traveling"],
                    advice: ["Seek treatment immediately if symptoms appear after being in a malaria region", "Complete the full course of treatment as prescribed", "Help eliminate mosquito breeding sites around the home"]
                }
            },
            {
                id: "tuberculosis",
                name: "Tuberculosis",
                description: "Infectious disease primarily affecting the lungs but can spread to other parts.",
                details: {
                    symptoms: ["Cough that lasts 3 weeks or more", "Coughing up blood", "Chest pain", "Unintentional weight loss", "Night sweats"],
                    prevention: ["BCG vaccination", "Covering mouth and nose when coughing", "Ensuring good ventilation", "Identifying and treating latent TB infections"],
                    advice: ["TB is curable with proper long-term treatment", "Never skip doses of TB medication", "Consult a doctor if you have persistent cough for more than 2 weeks"]
                }
            }
        ]
    }
];

export default function HealthTips({ onBack }: { onBack: () => void }): JSX.Element {
    const [selectedCategory, setSelectedCategory] = useState<Category | null>(null);
    const [selectedDisease, setSelectedDisease] = useState<DiseaseType | null>(null);

    const handleCategoryClick = (category: Category) => {
        setSelectedCategory(category);
        setSelectedDisease(null);
        window.scrollTo(0, 0);
    };

    const handleDiseaseClick = (disease: DiseaseType) => {
        setSelectedDisease(disease);
        window.scrollTo(0, 0);
    };

    const resetSelection = () => {
        if (selectedDisease) {
            setSelectedDisease(null);
        } else if (selectedCategory) {
            setSelectedCategory(null);
        } else {
            onBack();
        }
    };

    return (
        <div className="health-tips-page">
            <div className="container">
                <nav className="health-nav">
                    <button className="back-btn" onClick={resetSelection}>
                        {selectedCategory ? (selectedDisease ? "← Back to Types" : "← Back to Categories") : "← Back to Home"}
                    </button>
                    {selectedCategory && (
                        <div className="breadcrumbs">
                            <span onClick={() => {setSelectedCategory(null); setSelectedDisease(null);}}>Categories</span>
                            <span className="separator">/</span>
                            <span onClick={() => setSelectedDisease(null)} className={!selectedDisease ? "active" : ""}>{selectedCategory.name}</span>
                            {selectedDisease && (
                                <>
                                    <span className="separator">/</span>
                                    <span className="active">{selectedDisease.name}</span>
                                </>
                            )}
                        </div>
                    )}
                </nav>
                
                <header className="health-tips-header">
                    <span className="subtitle">SPHMMC Medical Resources</span>
                    {!selectedCategory ? (
                        <>
                            <h1>Health & Wellness Tips</h1>
                            <p>Explore authoritative health information categorized by medical areas to help you live a healthier life.</p>
                        </>
                    ) : !selectedDisease ? (
                        <>
                            <h1>{selectedCategory.name} Conditions</h1>
                            <p>{selectedCategory.description}</p>
                        </>
                    ) : (
                        <>
                            <h1>{selectedDisease.name}</h1>
                            <p>{selectedDisease.description}</p>
                        </>
                    )}
                </header>

                {!selectedCategory && (
                    <div className="disease-links-section">
                        <h3>Browse Categories</h3>
                        <div className="links-grid">
                            {healthData.map((cat: Category) => (
                                <button key={cat.id} onClick={() => handleCategoryClick(cat)} className="disease-link-item">
                                    <span className="dot"></span> {cat.name}
                                </button>
                            ))}
                        </div>
                    </div>
                )}

                <div className="content-area">
                    {!selectedCategory ? (
                        <div className="disease-cards-grid">
                            {healthData.map((cat: Category) => (
                                <div key={cat.id} className="disease-card category-card" onClick={() => handleCategoryClick(cat)}>
                                    <div className="card-top">
                                        <div className="disease-icon-wrapper">
                                            {cat.icon}
                                        </div>
                                        <div className="card-badge">{cat.diseases.length} Types</div>
                                    </div>
                                    <div className="card-body">
                                        <h3>{cat.name}</h3>
                                        <p>{cat.description}</p>
                                    </div>
                                    <div className="card-footer">
                                        <span className="card-action-link">View Diseases ↗</span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : !selectedDisease ? (
                        <div className="disease-cards-grid">
                            {selectedCategory.diseases.map((disease: DiseaseType) => (
                                <div key={disease.id} className="disease-card type-card" onClick={() => handleDiseaseClick(disease)}>
                                    <div className="card-top">
                                        <div className="disease-icon-wrapper mini">
                                            {selectedCategory.icon}
                                        </div>
                                        <div className="card-badge">Condition</div>
                                    </div>
                                    <div className="card-body">
                                        <h3>{disease.name}</h3>
                                        <p>{disease.description}</p>
                                    </div>
                                    <div className="card-footer">
                                        <span className="card-action-link">Prevention & Symptoms ↗</span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="detail-view">
                            <div className="detail-grid">
                                <section className="detail-section symptoms">
                                    <div className="section-icon">⚠️</div>
                                    <h3>Common Symptoms</h3>
                                    <ul>
                                        {selectedDisease.details.symptoms.map((s: string, i: number) => <li key={i}>{s}</li>)}
                                    </ul>
                                </section>
                                <section className="detail-section prevention">
                                    <div className="section-icon">🛡️</div>
                                    <h3>Prevention Steps</h3>
                                    <ul>
                                        {selectedDisease.details.prevention.map((s: string, i: number) => <li key={i}>{s}</li>)}
                                    </ul>
                                </section>
                                <section className="detail-section advice">
                                    <div className="section-icon">💡</div>
                                    <h3>Expert Advice</h3>
                                    <ul>
                                        {selectedDisease.details.advice.map((s: string, i: number) => <li key={i}>{s}</li>)}
                                    </ul>
                                </section>
                            </div>
                            <div className="emergency-notice">
                                <p><strong>Note:</strong> This information is for educational purposes. If you are experiencing a medical emergency, please call your local emergency services or visit the nearest hospital.</p>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
