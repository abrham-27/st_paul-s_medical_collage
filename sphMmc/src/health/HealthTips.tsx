import { useState, useEffect, type JSX } from 'react';
import './HealthTips.css';
import { apiService, type HealthCategory, type HealthDisease } from '../services/api';

type Category = HealthCategory;
type DiseaseType = HealthDisease;

export default function HealthTips({ onBack }: { onBack: () => void }): JSX.Element {
    const [categories, setCategories] = useState<Category[]>([]);
    const [loading, setLoading] = useState(true);
    const [selectedCategory, setSelectedCategory] = useState<Category | null>(null);
    const [selectedDisease, setSelectedDisease] = useState<DiseaseType | null>(null);

    useEffect(() => {
        apiService.getHealthCategories()
            .then(res => setCategories(res.data))
            .catch(() => setCategories([]))
            .finally(() => setLoading(false));
    }, []);

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

    if (loading) {
        return (
            <div className="health-tips-page">
                <div className="container" style={{ textAlign: 'center', paddingTop: '4rem', color: '#1e3a5f' }}>
                    Loading health tips...
                </div>
            </div>
        );
    }

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
                            <h1>Health &amp; Wellness Tips</h1>
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
                            {categories.map((cat) => (
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
                            {categories.map((cat) => (
                                <div key={cat.id} className="disease-card category-card" onClick={() => handleCategoryClick(cat)}>
                                    <div className="card-top">
                                        <div className="disease-icon-wrapper">{cat.icon}</div>
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
                            {selectedCategory.diseases.map((disease) => (
                                <div key={disease.id} className="disease-card type-card" onClick={() => handleDiseaseClick(disease)}>
                                    <div className="card-top">
                                        <div className="disease-icon-wrapper mini">{selectedCategory.icon}</div>
                                        <div className="card-badge">Condition</div>
                                    </div>
                                    <div className="card-body">
                                        <h3>{disease.name}</h3>
                                        <p>{disease.description}</p>
                                    </div>
                                    <div className="card-footer">
                                        <span className="card-action-link">Prevention &amp; Symptoms ↗</span>
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
                                    <ul>{selectedDisease.symptoms?.map((s, i) => <li key={i}>{s}</li>)}</ul>
                                </section>
                                <section className="detail-section prevention">
                                    <div className="section-icon">🛡️</div>
                                    <h3>Prevention Steps</h3>
                                    <ul>{selectedDisease.prevention?.map((s, i) => <li key={i}>{s}</li>)}</ul>
                                </section>
                                <section className="detail-section advice">
                                    <div className="section-icon">💡</div>
                                    <h3>Expert Advice</h3>
                                    <ul>{selectedDisease.advice?.map((s, i) => <li key={i}>{s}</li>)}</ul>
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
