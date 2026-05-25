import { type JSX, useState, useEffect } from 'react';
import './Overview.css';

interface OverviewData {
  title?: string;
  description?: string;
  stats?: Array<{ value: string; label: string }>;
  mission?: string;
  vision?: string;
  [key: string]: any;
}

export default function Overview({ onBack }: { onBack: () => void }): JSX.Element {
    const [overviewData, setOverviewData] = useState<OverviewData | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchMedicineOverview = async () => {
            try {
                // Backend URL - no double /api
                const endpoint = 'http://127.0.0.1:8000/api/medicine-overview';
                
                console.log('Fetching from:', endpoint);

                const response = await fetch(endpoint, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                    // Removed credentials: 'include' to fix CORS issue
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.error('Response is not JSON:', text.substring(0, 100));
                    throw new Error(`Expected JSON response but received: ${contentType}`);
                }

                const data = await response.json();
                console.log('Successfully fetched data:', data);
                setOverviewData(data);
            } catch (err) {
                console.error('Error fetching medicine overview:', err);
                setError(err instanceof Error ? err.message : 'Unknown error occurred');
            } finally {
                setLoading(false);
            }
        };

        fetchMedicineOverview();
    }, []);

    if (loading) return <div className="medicine-overview-page"><div className="container"><p>Loading...</p></div></div>;
    if (error) return <div className="medicine-overview-page"><div className="container"><p style={{color: 'red'}}>Error: {error}</p></div></div>;

    return (
        <div className="medicine-overview-page">
            <div className="hero-section">
                <div className="container">
                    <button className="back-btn" onClick={onBack}>← Back to Home</button>
                    <div className="hero-content">
                        <span className="badge">Academics</span>
                        <h1>{overviewData?.title || 'School of Medicine'}</h1>
                        <p className="lead">{overviewData?.description || 'Pioneering medical education and clinical excellence in Ethiopia since 2008.'}</p>
                    </div>
                </div>
            </div>

            <div className="container main-content">
                <section className="about-section">
                    <div className="grid-2">
                        <div className="text-box">
                            <h2>Excellence in Medical Education</h2>
                            <p>St. Paul's Hospital Millennium Medical College (SPHMMC) was formally launched in 2008, following the legacy of St. Paul's Hospital which has served the Ethiopian people for decades.</p>
                            <p>We employ an integrated, modular, and problem-based curriculum (PBL) that prepares our students for the complexities of modern healthcare. Our graduates are trained to be competent, compassionate physicians.</p>
                        </div>
                        <div className="stats-box">
                            {overviewData?.stats && overviewData.stats.length > 0 ? (
                                overviewData.stats.map((stat: any, idx: number) => (
                                    <div key={idx} className="stat-item">
                                        <span className="value">{stat.value}</span>
                                        <span className="label">{stat.label}</span>
                                    </div>
                                ))
                            ) : (
                                <>
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
                                </>
                            )}
                        </div>
                    </div>
                </section>

                <section className="vision-mission-section">
                    <div className="grid-2">
                        <div className="card mission">
                            <h3>Our Mission</h3>
                            <p>{overviewData?.mission || 'To provide high-quality medical education, research, and clinical services through a commitment to excellence and community engagement.'}</p>
                        </div>
                        <div className="card vision">
                            <h3>Our Vision</h3>
                            <p>{overviewData?.vision || 'To be a premier center of excellence in health sciences education and specialized clinical care in Africa.'}</p>
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
