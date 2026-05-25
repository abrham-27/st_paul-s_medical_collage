import { type JSX, useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { apiService, type MedicinePartnershipDetail } from '../services/api';
import { containsHtml } from '../services/content';
import './Overview.css';
import './Partnership.css';

interface PartnershipDetailProps {
    onBack: () => void;
}

export default function MedicinePartnershipDetail({ onBack }: PartnershipDetailProps): JSX.Element {
    const { slug = '' } = useParams<{ slug: string }>();
    const [partnership, setPartnership] = useState<MedicinePartnershipDetail | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        if (!slug) return;

        const fetchPartnership = async () => {
            try {
                setLoading(true);
                setError(null);
                const data = await apiService.getMedicinePartnership(slug);
                setPartnership(data);
            } catch (err) {
                setError('Unable to load partnership details.');
                console.error(err);
            } finally {
                setLoading(false);
            }
        };

        fetchPartnership();
    }, [slug]);

    return (
        <div className="medicine-overview-page medicine-partnership-page">
            <div className="hero-section">
                <div className="container">
                    <button type="button" className="back-btn" onClick={onBack}>
                        ← Back to Partnerships
                    </button>
                    <div className="hero-content">
                        <span className="badge">School of Medicine</span>
                        {partnership && (
                            <span
                                className={`partnership-area-badge partnership-area-hero partnership-area-${partnership.area}`}
                            >
                                {partnership.area_label}
                            </span>
                        )}
                        <h1>{partnership?.title || 'Partnership Detail'}</h1>
                    </div>
                </div>
            </div>

            <div className="container main-content">
                {loading && (
                    <div className="partnership-loading">Loading partnership details…</div>
                )}

                {error && <div className="partnership-error">{error}</div>}

                {!loading && !error && partnership && (
                    <section className="partnership-content-section">
                        {partnership.featured_image && (
                            <div className="partnership-featured-image">
                                <img src={partnership.featured_image} alt={partnership.title} />
                            </div>
                        )}

                        <div className="partnership-text-card">
                            {partnership.content?.trim() ? (
                                containsHtml(partnership.content) ? (
                                    <div
                                        className="partnership-body"
                                        dangerouslySetInnerHTML={{ __html: partnership.content }}
                                    />
                                ) : (
                                    <p className="partnership-body">{partnership.content}</p>
                                )
                            ) : (
                                <p className="partnership-empty">No additional details provided.</p>
                            )}
                        </div>
                    </section>
                )}
            </div>
        </div>
    );
}
