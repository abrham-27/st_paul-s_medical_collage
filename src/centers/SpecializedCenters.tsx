import { useState, type JSX } from 'react';
import './SpecializedCenters.css';

interface Center {
    id: string;
    name: string;
    description: string;
    details: string;
    icon: string;
}

const centers: Center[] = [
    {
        id: "kidney-transplant",
        name: "National Kidney Transplant Center",
        description: "St. Paul's established and operates the first kidney transplant center in Ethiopia.",
        details: "Our center is equipped with state-of-the-art facilities for kidney transplantation, providing life-saving procedures to patients from across the nation and beyond. We utilize advanced surgical techniques and provide comprehensive post-operative care.",
        icon: "🧬"
    },
    {
        id: "open-heart",
        name: "Open-Heart Surgery Service",
        description: "Launched in partnership with the Children's Heart Fund of Ethiopia and other specialized centers.",
        details: "This service provides specialized cardiac surgeries, including complex open-heart procedures. Our collaborative approach ensures that patients receive the highest standard of cardiovascular care using modern medical technology.",
        icon: "❤️"
    },
    {
        id: "ivf-fertility",
        name: "IVF and Fertility Center",
        description: "Offers advanced reproductive health services, including IVF and fertility treatments.",
        details: "Our center provides a range of advanced reproductive health services, including In-Vitro Fertilization (IVF), fertility preservation, and specialized gynecological care. We are dedicated to helping families achieve their dreams of parenthood.",
        icon: "👶"
    },
    {
        id: "trauma-care",
        name: "Specialized Trauma Care",
        description: "Features dedicated facilities for trauma and orthopedics.",
        details: "The trauma unit is designed to handle severe injuries and orthopedic emergencies. With dedicated operating rooms and intensive care facilities, our specialized team provides rapid and effective treatment for trauma patients.",
        icon: "🚑"
    },
    {
        id: "burn-care",
        name: "Burn Care Unit",
        description: "Specialized treatment for burn injuries.",
        details: "Our Burn Care Unit provides comprehensive treatment for all types of burn injuries. We focus on advanced wound management, surgical skin grafting, and long-term rehabilitation to ensure the best possible outcomes for survivors.",
        icon: "🔥"
    }
];

export default function SpecializedCenters({ onBack }: { onBack: () => void }): JSX.Element {
    const [selectedCenter, setSelectedCenter] = useState<Center | null>(null);

    const handleCenterClick = (center: Center) => {
        setSelectedCenter(center);
        window.scrollTo(0, 0);
    };

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
                                        <li><strong>Location:</strong> Main Hospital Block, 3rd Floor</li>
                                        <li><strong>Hours:</strong> 24/7 Emergency, 8:00 AM - 5:00 PM OPD</li>
                                        <li><strong>Contact:</strong> +251 112 75 01 25</li>
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
