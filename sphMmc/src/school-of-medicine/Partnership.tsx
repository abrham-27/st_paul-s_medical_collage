import { type JSX, useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { apiService, type MedicinePartnershipListItem } from '../services/api';
import './Overview.css';
import './Partnership.css';

interface PartnershipProps {
    onBack: () => void;
}

type AreaFilter = 'all' | 'local' | 'international';

export default function MedicinePartnership({ onBack }: PartnershipProps): JSX.Element {
    const [partnerships, setPartnerships] = useState<MedicinePartnershipListItem[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [areaFilter, setAreaFilter] = useState<AreaFilter>('all');

    useEffect(() => {
        const fetchPartnerships = async () => {
            try {
                setLoading(true);
                setError(null);
                const data = await apiService.getMedicinePartnerships();
                setPartnerships(Array.isArray(data) ? data : []);
            } catch (err) {
                setError('Unable to load partnerships.');
                console.error(err);
            } finally {
                setLoading(false);
            }
        };

        fetchPartnerships();
    }, []);

    const filtered = partnerships.filter((p) =>
        areaFilter === 'all' ? true : p.area === areaFilter
    );

    return (
        <div className="medicine-overview-page medicine-partnership-page">
            <div className="hero-section">
                <div className="container">
                    <button type="button" className="back-btn" onClick={onBack}>
                        ← Back to Home
                    </button>
                    <div className="hero-content">
                        <span className="badge">School of Medicine</span>
                        <h1>Partnership & Collaboration</h1>
                        <p className="lead">
                            Explore our local and international partnerships advancing medical
                            education and clinical excellence.
                        </p>
                    </div>
                </div>
            </div>

            <div className="container main-content">
                <div className="partnership-filters">
                    <button
                        type="button"
                        className={areaFilter === 'all' ? 'active' : ''}
                        onClick={() => setAreaFilter('all')}
                    >
                        All
                    </button>
                    <button
                        type="button"
                        className={areaFilter === 'local' ? 'active' : ''}
                        onClick={() => setAreaFilter('local')}
                    >
                        Local
                    </button>
                    <button
                        type="button"
                        className={areaFilter === 'international' ? 'active' : ''}
                        onClick={() => setAreaFilter('international')}
                    >
                        International
                    </button>
                </div>

                {loading && (
                    <div className="partnership-loading">Loading partnerships…</div>
                )}

                {error && <div className="partnership-error">{error}</div>}

                {!loading && !error && filtered.length === 0 && (
                    <div className="partnership-empty">
                        No partnerships found in this category.
                    </div>
                )}

                {!loading && !error && filtered.length > 0 && (
                    <div className="partnership-list-grid">
                        {filtered.map((item) => (
                            <article key={item.id} className="partnership-list-card">
                                {item.featured_image && (
                                    <div className="partnership-list-card-image">
                                        <img src={item.featured_image} alt={item.title} />
                                    </div>
                                )}
                                <div className="partnership-list-card-body">
                                    <span
                                        className={`partnership-area-badge partnership-area-${item.area}`}
                                    >
                                        {item.area_label}
                                    </span>
                                    <h3>{item.title}</h3>
                                    {item.excerpt && <p>{item.excerpt}</p>}
                                    <Link
                                        to={`/academics/medicine/partnership-collaboration/${item.slug}`}
                                        className="partnership-view-detail"
                                    >
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
