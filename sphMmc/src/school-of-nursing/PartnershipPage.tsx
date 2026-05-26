import { type JSX, useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { apiService, type NursingPartnershipListItem } from '../services/api';
import '../school-of-medicine/Overview.css';
import '../school-of-medicine/Partnership.css';

type AreaFilter = 'all' | 'local' | 'international';

export default function NursingPartnershipPage({ onBack }: { onBack: () => void }): JSX.Element {
    const [partnerships, setPartnerships] = useState<NursingPartnershipListItem[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [areaFilter, setAreaFilter] = useState<AreaFilter>('all');

    useEffect(() => {
        apiService.getNursingPartnerships()
            .then(data => setPartnerships(Array.isArray(data) ? data : []))
            .catch(() => setError('Unable to load partnerships.'))
            .finally(() => setLoading(false));
    }, []);

    const filtered = partnerships.filter(p => areaFilter === 'all' || p.area === areaFilter);

    return (
        <div className="medicine-overview-page medicine-partnership-page">
            <div className="hero-section">
                <div className="container">
                    <button type="button" className="back-btn" onClick={onBack}>← Back to Home</button>
                    <div className="hero-content">
                        <span className="badge">School of Nursing</span>
                        <h1>Partnership & Collaboration</h1>
                        <p className="lead">Explore our local and international partnerships advancing nursing education and clinical excellence.</p>
                    </div>
                </div>
            </div>

            <div className="container main-content">
                <div className="partnership-filters">
                    <button type="button" className={areaFilter === 'all' ? 'active' : ''} onClick={() => setAreaFilter('all')}>All</button>
                    <button type="button" className={areaFilter === 'local' ? 'active' : ''} onClick={() => setAreaFilter('local')}>Local</button>
                    <button type="button" className={areaFilter === 'international' ? 'active' : ''} onClick={() => setAreaFilter('international')}>International</button>
                </div>

                {loading && <div className="partnership-loading">Loading partnerships…</div>}
                {error && <div className="partnership-error">{error}</div>}
                {!loading && !error && filtered.length === 0 && (
                    <div className="partnership-empty">No partnerships found in this category.</div>
                )}
                {!loading && !error && filtered.length > 0 && (
                    <div className="partnership-list-grid">
                        {filtered.map(item => (
                            <article key={item.id} className="partnership-list-card">
                                {item.featured_image && (
                                    <div className="partnership-list-card-image">
                                        <img src={item.featured_image} alt={item.title} />
                                    </div>
                                )}
                                <div className="partnership-list-card-body">
                                    <span className={`partnership-area-badge partnership-area-${item.area}`}>{item.area_label}</span>
                                    <h3>{item.title}</h3>
                                    {item.excerpt && <p>{item.excerpt}</p>}
                                    <Link to={`/academics/nursing/partnership-collaboration/${item.slug}`} className="partnership-view-detail">
                                        View detail →
                                    </Link>
                                </div>
                            </article>
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}
