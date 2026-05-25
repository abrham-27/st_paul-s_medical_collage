import { useState, useEffect, type JSX } from 'react';
import './SpecializedCenters.css';
import { apiService, type SpecializedCenterData } from '../services/api';

type Center = SpecializedCenterData;

export default function SpecializedCenters({ onBack }: { onBack: () => void }): JSX.Element {
    const [centers, setCenters] = useState<Center[]>([]);
    const [loading, setLoading] = useState(true);
    const [selectedCenter, setSelectedCenter] = useState<Center | null>(null);

    useEffect(() => {
        apiService.getSpecializedCenters()
            .then(res => setCenters(res.data))
            .catch(() => setCenters([]))
            .finally(() => setLoading(false));
    }, []);

    const handleCenterClick = (center: Center) => {
        setSelectedCenter(center);
        window.scrollTo(0, 0);
    };

    if (loading) {
        return (
            <div className="centers-page">
                <div className="container" style={{ textAlign: 'center', paddingTop: '4rem', color: '#1e3a5f' }}>
                    Loading centers...
                </div>
            </div>
        );
    }

    return (
        <div className="centers-page">
            <div className="container">
                <nav className="centers-nav">
                    <button className="back-btn" onClick={selectedCenter ? () => setSelectedCenter(null) : onBack}>
                        {selectedCenter ? "← Back to Centers" : "← Back to Home"}
                    </button>
                    {selectedCenter && (
                        <div className="breadcrumbs">
                            <span onClick={() => setSelectedCenter(null)}>Specialized Centers</span>
                            <span className="separator">/</span>
                            <span className="active">{selectedCenter.name}</span>
                        </div>
                    )}
                </nav>

                <header className="centers-header">
                    <span className="subtitle">SPHMMC Clinical Excellence</span>
                    {!selectedCenter ? (
                        <>
                            <h1>Specialized Surgical & Medical Centers</h1>
                            <p>Discover our world-class specialized centers providing advanced medical treatments and surgical procedures in Ethiopia.</p>
                        </>
                    ) : (
                        <>
                            <h1>{selectedCenter.name}</h1>
                            <p>{selectedCenter.description}</p>
                        </>
                    )}
                </header>

                {!selectedCenter ? (
                    <div className="centers-section">
                        <div className="centers-hero-links">
                            <h3>Quick Access</h3>
                            <div className="hero-links-grid">
                                {centers.map(center => (
                                    <button key={center.id} onClick={() => handleCenterClick(center)} className="center-link-pill">
                                        {center.name} ↗
                                    </button>
                                ))}
                            </div>
                        </div>

                        <div className="centers-grid">
                            {centers.map(center => (
                                <div key={center.id} className="center-card" onClick={() => handleCenterClick(center)}>
                                    <div className="card-header">
                                        <div className="center-icon">{center.icon}</div>
                                        <div className="center-status">Operational</div>
                                    </div>
                                    <div className="card-body">
                                        <h3>{center.name}</h3>
                                        <p>{center.description}</p>
                                    </div>
                                    <div className="card-footer">
                                        <span className="view-details">Explore Center ↗</span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                ) : (
                    <div className="center-detail-view">
                        <div className="detail-layout">
                            <div className="detail-main">
                                <section className="info-block">
                                    <h3>About the Center</h3>
                                    <p>{selectedCenter.details}</p>
                                </section>
                                <div className="detail-actions">
                                    <button className="meet-doctors-btn">
                                        Meet Our Doctors <span className="icon">👨‍⚕️</span>
                                    </button>
                                    <button className="book-appointment-btn">
                                        Book Appointment ↗
                                    </button>
                                </div>
                            </div>
                            <div className="detail-sidebar">
                                <div className="sidebar-card">
                                    <h4>Center Information</h4>
                                    <ul>
                                        <li><strong>Location:</strong> {selectedCenter.location ?? 'Main Hospital Block, 3rd Floor'}</li>
                                        <li><strong>Hours:</strong> {selectedCenter.hours ?? '24/7 Emergency, 8:00 AM - 5:00 PM OPD'}</li>
                                        <li><strong>Contact:</strong> {selectedCenter.contact ?? '+251 112 75 01 25'}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div className="emergency-note">
                            <p><strong>Emergency:</strong> If you are seeking immediate trauma or burn care, please proceed directly to the Emergency Entrance.</p>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
}
