import { type JSX, useState, useEffect } from 'react';
import './News.css';
import { apiService, type LatestPost } from '../services/api';

interface NewsArticle {
    id: number;
    title: string;
    description: string;
    content?: string;
    image: string;
    category: string;
    date: string;
    author: string;
    slug: string;
}

const fallback: NewsArticle[] = [
    { id: 1, title: 'SPHMMC Hosts AICS Conference on Health Professions Education', description: 'Internationalization of Higher Education was the main theme of this year\'s landmark conference held at the main campus.', image: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&fit=crop', category: 'Academic', date: 'Mar 28, 2026', author: 'SPHMMC Media', slug: 'aics-conference' },
    { id: 2, title: 'Breakthrough in Malaria Research Published', description: 'The SPHMMC Research Institute publishes significant findings on local malaria variants in the Ethiopian Journal of Medicine.', image: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&fit=crop', category: 'Research', date: 'Mar 20, 2026', author: 'Research Office', slug: 'malaria-research' },
    { id: 3, title: 'New Postgraduate Residency Programs Accredited', description: 'Three new residency programs in Cardiology, Oncology and Pediatric Surgery have received full accreditation.', image: 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=600&fit=crop', category: 'Academic', date: 'Mar 15, 2026', author: 'Academic Office', slug: 'residency-accreditation' },
    { id: 4, title: 'Community Health Outreach Reaches 5,000 Patients', description: 'The annual free health screening program served over five thousand community members across Addis Ababa.', image: 'https://images.unsplash.com/photo-1584432810601-6c7f27d2362b?w=600&fit=crop', category: 'Community', date: 'Mar 10, 2026', author: 'Community Health', slug: 'outreach-2026' },
    { id: 5, title: 'SPHMMC Signs MOU with International Medical Partners', description: 'A new memorandum of understanding strengthens research and training collaboration with European institutions.', image: 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&fit=crop', category: 'Partnership', date: 'Mar 5, 2026', author: 'SPHMMC Media', slug: 'mou-international' },
    { id: 6, title: 'Annual Medical Skills Competition Results Announced', description: 'Students from the School of Medicine swept top honors at the national clinical skills competition held in Hawassa.', image: 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=600&fit=crop', category: 'Student Life', date: 'Feb 28, 2026', author: 'Student Affairs', slug: 'skills-competition' },
];

function decodeHtmlEntities(html: string) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = html;
    return textarea.value;
}

function stripHtml(html: string) {
    return decodeHtmlEntities(html.replace(/<[^>]+>/g, ' ')).replace(/\s+/g, ' ').trim();
}

export default function News({ onBack }: { onBack: () => void }): JSX.Element {
    const [articles, setArticles] = useState<NewsArticle[]>(fallback);
    const [selectedArticle, setSelectedArticle] = useState<NewsArticle | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        apiService.getLatestNews()
            .then(res => {
                if (res.success && res.data.length > 0) {
                    setArticles(res.data.map((p: LatestPost) => ({
                        id: p.id,
                        title: p.title,
                        description: stripHtml(p.content || ''),
                        image: p.featured_image || 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&fit=crop',
                        category: 'News',
                        date: new Date(p.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }),
                        author: p.author || 'SPHMMC',
                        slug: p.slug,
                    })));
                }
            })
            .catch(() => {})
            .finally(() => setLoading(false));
    }, []);

    return (
        <div className="lp-page lp-news-page">
            <div className="lp-hero-bar">
                <button className="lp-back-btn" onClick={onBack}>← Back</button>
                <div className="lp-hero-text">
                    <span className="lp-label">SPHMMC · Latest</span>
                    <h1>News &amp; Media</h1>
                    <p>Groundbreaking research, campus events and clinical breakthroughs.</p>
                </div>
            </div>

            <div className="lp-container">
                {loading && <div className="lp-loading">Loading…</div>}
                <div className="news-cards-grid">
                    {articles.map(a => (
                        <article key={a.id} className="nc-card">
                            <button
                                type="button"
                                className="nc-card-button"
                                onClick={() => setSelectedArticle(a)}
                                style={{ all: 'unset', display: 'block', width: '100%', cursor: 'pointer' }}
                            >
                            <div className="nc-img" style={{ backgroundImage: `url(${a.image})` }}>
                                <span className="nc-badge">{a.category}</span>
                            </div>
                            <div className="nc-body">
                                <div className="nc-meta">
                                    <span>{a.date}</span>
                                    <span className="nc-dot" />
                                    <span>{a.author}</span>
                                </div>
                                <h3>{a.title}</h3>
                                <p>{a.description.slice(0, 110)}{a.description.length > 110 ? '…' : ''}</p>
                                <span className="nc-link">Read story →</span>
                            </div>
                            </button>
                        </article>
                    ))}
                </div>
                {selectedArticle && (
                    <div
                        className="detail-modal"
                        style={{ position: 'fixed', inset: 0, zIndex: 9999, backgroundColor: 'rgba(0,0,0,0.7)', display: 'flex', alignItems: 'center', justifyContent: 'center', padding: 20 }}
                        onClick={() => setSelectedArticle(null)}
                    >
                        <div
                            style={{ background: '#fff', borderRadius: 20, width: '100%', maxWidth: 900, maxHeight: '90vh', overflowY: 'auto', position: 'relative', padding: 28 }}
                            onClick={e => e.stopPropagation()}
                        >
                            <button
                                type="button"
                                onClick={() => setSelectedArticle(null)}
                                style={{ position: 'absolute', top: 18, right: 18, border: 'none', background: 'transparent', fontSize: 28, lineHeight: 1, cursor: 'pointer' }}
                                aria-label="Close details"
                            >
                                ×
                            </button>
                            <div style={{ marginBottom: 16, color: '#6b7280', fontSize: 14 }}>
                                {selectedArticle.date} · {selectedArticle.author}
                            </div>
                            <h2 style={{ marginTop: 0, marginBottom: 16 }}>{selectedArticle.title}</h2>
                            {selectedArticle.image && (
                                <div style={{ width: '100%', minHeight: 220, borderRadius: 16, backgroundImage: `url(${selectedArticle.image})`, backgroundSize: 'cover', backgroundPosition: 'center', marginBottom: 18 }} />
                            )}
                            <div style={{ color: '#111', lineHeight: 1.75 }} dangerouslySetInnerHTML={{ __html: selectedArticle.content || selectedArticle.description }} />
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
}
