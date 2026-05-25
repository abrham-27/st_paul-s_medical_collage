import { useState, useEffect } from 'react';
import { apiService, type LatestPost } from '../services/api';

interface NewsCard {
  id: number;
  title: string;
  excerpt: string;
  image: string;
  category: string;
  date: string;
  slug: string;
}

const FALLBACK: NewsCard[] = [
  {
    id: 1,
    title: 'SPHMMC Hosts AICS Conference on Health Professions Education',
    excerpt: 'Internationalization of Higher Education was the main theme of this landmark conference held at the main campus.',
    image: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&fit=crop',
    category: 'Academic',
    date: 'May 07, 2026',
    slug: 'aics-conference',
  },
  {
    id: 2,
    title: 'Breakthrough in Malaria Research Published in Ethiopian Journal',
    excerpt: 'The SPHMMC Research Institute publishes significant findings on local malaria variants.',
    image: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&fit=crop',
    category: 'Research',
    date: 'May 04, 2026',
    slug: 'malaria-research',
  },
  {
    id: 3,
    title: 'New Postgraduate Residency Programs Receive Full Accreditation',
    excerpt: 'Three new residency programs in Cardiology, Oncology and Pediatric Surgery accredited.',
    image: 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&fit=crop',
    category: 'Academic',
    date: 'May 01, 2026',
    slug: 'residency-accreditation',
  },
  {
    id: 4,
    title: 'Community Health Outreach Program Reaches 5,000 Patients',
    excerpt: 'Annual free health screening served over five thousand community members across Addis Ababa.',
    image: 'https://images.unsplash.com/photo-1584432810601-6c7f27d2362b?w=400&fit=crop',
    category: 'Community',
    date: 'Apr 28, 2026',
    slug: 'outreach-2026',
  },
];

const STORAGE_URL = 'http://127.0.0.1:8000/storage';
const FALLBACK_IMG = 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&fit=crop';

function decodeHtmlEntities(html: string) {
  const textarea = document.createElement('textarea');
  textarea.innerHTML = html;
  return textarea.value;
}

function stripHtml(html: string) {
  return decodeHtmlEntities(html.replace(/<[^>]+>/g, ' ')).replace(/\s+/g, ' ').trim();
}

function resolveImage(path: string | null): string {
  if (!path) return FALLBACK_IMG;
  // Already a full URL (returned by updated backend)
  if (path.startsWith('http://') || path.startsWith('https://')) return path;
  // Relative path — prepend storage base
  return `${STORAGE_URL}/${path}`;
}

function mapPost(p: LatestPost): NewsCard {
  return {
    id: p.id,
    title: p.title,
    excerpt: p.content ? `${stripHtml(p.content).slice(0, 130)}…` : '',
    image: resolveImage(p.featured_image),
    category: 'News',
    date: new Date(p.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }),
    slug: p.slug,
  };
}

interface Props {
  navigate: (path: string) => void;
}

export default function HomeNewsSection({ navigate }: Props) {
  const [articles, setArticles] = useState<NewsCard[]>(FALLBACK);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiService.getLatestNews()
      .then(res => {
        if (res.success && res.data.length > 0) {
          setArticles(res.data.slice(0, 4).map(mapPost));
        }
      })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  const [featured, ...rest] = articles;

  return (
    <section className="home-news-section">
      <div className="home-news-inner">
        {/* Header */}
        <div className="home-news-header">
          <span className="home-news-label">Latest News</span>
          <h2 className="home-news-title">What's New</h2>
        </div>

        {loading ? (
          <div className="hn-layout">
            <div className="hn-featured-skeleton" />
            <div className="hn-side-list">
              {[1, 2, 3].map(i => <div key={i} className="hn-side-skeleton" />)}
            </div>
          </div>
        ) : (
          <div className="hn-layout">
            {/* Featured large card */}
            {featured && (
              <div className="hn-featured" onClick={() => navigate('/latests/news')}>
                <div className="hn-featured-img-wrap">
                  <img
                    src={featured.image}
                    alt={featured.title}
                    className="hn-featured-img"
                    loading="lazy"
                    onError={(e) => { (e.target as HTMLImageElement).src = FALLBACK_IMG; }}
                  />
                </div>
                <div className="hn-featured-body">
                  <h3 className="hn-featured-title">{featured.title}</h3>
                  <p className="hn-featured-excerpt">{featured.excerpt}</p>
                  <span className="hn-featured-date">{featured.date}</span>
                </div>
              </div>
            )}

            {/* Side list of smaller cards */}
            <div className="hn-side-list">
              {rest.map(a => (
                <div key={a.id} className="hn-side-card" onClick={() => navigate('/latests/news')}>
                  <div className="hn-side-img-wrap">
                  <img
                    src={a.image}
                    alt={a.title}
                    className="hn-side-img"
                    loading="lazy"
                    onError={(e) => { (e.target as HTMLImageElement).src = FALLBACK_IMG; }}
                  />
                  </div>
                  <div className="hn-side-body">
                    <h4 className="hn-side-title">{a.title}</h4>
                    <span className="hn-side-date">{a.date}</span>
                  </div>
                </div>
              ))}

              <button className="home-news-view-all" onClick={() => navigate('/latests/news')}>
                View All News ↗
              </button>
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
