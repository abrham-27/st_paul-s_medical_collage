import { type JSX } from 'react';
import './Overview.css';

export default function Overview({ onBack }: { onBack: () => void }): JSX.Element {
    return (
        <div className="medicine-overview-page">
            <div className="hero-section">
                <div className="container">
                    <button className="back-btn" onClick={onBack}>← Back to Home</button>
                    <div className="hero-content">
                        <span className="badge">Academics</span>
                        <h1>School of Medicine</h1>
                        <p className="lead">Pioneering medical education and clinical excellence in Ethiopia since 2008.</p>
                    </div>
                </div>
            </div>

            <div className="container main-content">
                <section className="about-section">
                    <div className="grid-2">
                        <div className="text-box">
                            <h2>Excellence in Medical Education</h2>
                            <p>St. Paul's Hospital Millennium Medical College (SPHMMC) was formally launched in 2008, following the legacy of St. Paul's Hospital which has served the Ethiopian people for decades. Our School of Medicine is the heart of our mission to address the shortage of physicians in Ethiopia.</p>
                            <p>We employ an integrated, modular, and problem-based curriculum (PBL) that prepares our students for the complexities of modern healthcare. Our graduates are trained not just to be doctors, but to be leaders and researchers in the medical field.</p>
                        </div>
                        <div className="stats-box">
                            <div className="stat-item">
                                <span className="value">700+</span>
                                <span className="label">Beds Capacity</span>
                            </div>
                            <div className="stat-item">
                                <span className="value">20+</span>
                                <span className="label">Specialty Programs</span>
                            </div>
                            <div className="stat-item">
                                <span className="value">75%</span>
                                <span className="label">Free Services</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section className="vision-mission-section">
                    <div className="grid-2">
                        <div className="card mission">
                            <h3>Our Mission</h3>
                            <p>To provide high-quality medical education, research, and clinical services through a commitment to excellence and community engagement.</p>
                        </div>
                        <div className="card vision">
                            <h3>Our Vision</h3>
                            <p>To be a premier center of excellence in health sciences education and specialized clinical care in Africa.</p>
                        </div>
                    </div>
                </section>

                <section className="highlights">
                    <h2>Key Highlights</h2>
                    <div className="highlights-grid">
                        <div className="hl-card">
                            <div className="hl-icon">🏥</div>
                            <h4>Integrated Learning</h4>
                            <p>Students rotate through specialized departments early in their training for hands-on clinical exposure.</p>
                        </div>
                        <div className="hl-card">
                            <div className="hl-icon">🔬</div>
                            <h4>Research Focus</h4>
                            <p>Extensive research facilities and opportunities for both undergraduate and postgraduate students.</p>
                        </div>
                        <div className="hl-card">
                            <div className="hl-icon">🤝</div>
                            <h4>Global Partnerships</h4>
                            <p>Collaborations with Harvard Medical School and other international institutions for faculty and student exchange.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    );
}
