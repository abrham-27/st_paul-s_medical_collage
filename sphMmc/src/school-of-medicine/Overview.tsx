import { type JSX, useEffect, useState } from 'react';
import { apiService } from '../services/api';
import './Overview.css';

interface MedicineOverview {
  title: string | null;
  content: string | null;
  secondary_title: string | null;
  secondary_content: string | null;
  tertiary_title: string | null;
  tertiary_content: string | null;
  featured_image: string | null;
}

function RichContent({ html }: { html: string | null | undefined }) {
  if (!html) return null;
  const hasHtml = /<[a-z][\s\S]*>/i.test(html);
  if (hasHtml) {
    return <div className="rich-content" dangerouslySetInnerHTML={{ __html: html }} />;
  }
  return <p style={{ whiteSpace: 'pre-line' }}>{html}</p>;
}

export default function Overview({ onBack }: { onBack: () => void }): JSX.Element {
  const [page, setPage] = useState<MedicineOverview | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiService.getAcademicPage('medicine', 'overview')
      .then(res => { if (res.success && res.data) setPage(res.data as MedicineOverview); })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  if (loading) return (
    <div className="medicine-overview-page">
      <div className="hero-section"><div className="container"><p style={{ color: '#fff' }}>Loading...</p></div></div>
    </div>
  );

  return (
    <div className="medicine-overview-page">
      {/* Hero */}
      <div className="hero-section">
        <div className="container">
          <button className="back-btn" onClick={onBack}>← Back to Home</button>
          <div className="hero-content">
            <span className="badge">Academics · School of Medicine</span>
            <h1>{page?.title || 'School of Medicine'}</h1>
            <p className="lead">Pioneering medical education and clinical excellence in Ethiopia since 2008.</p>
          </div>
        </div>
      </div>

      <div className="container main-content">

        {/* Featured Image */}
        {page?.featured_image && (
          <section className="about-section" style={{ paddingBottom: 0 }}>
            <img
              src={page.featured_image}
              alt="School of Medicine"
              style={{ width: '100%', maxHeight: '420px', objectFit: 'cover', borderRadius: '12px', marginBottom: '2rem' }}
            />
          </section>
        )}

        {/* About Section */}
        <section className="about-section">
          <div className="grid-2">
            <div className="text-box">
              <h2>About School of Medicine</h2>
              <RichContent html={page?.content} />
            </div>
            <div className="stats-box">
              <div className="stat-item"><span className="value">700+</span><span className="label">Beds Capacity</span></div>
              <div className="stat-item"><span className="value">20+</span><span className="label">Specialty Programs</span></div>
              <div className="stat-item"><span className="value">75%</span><span className="label">Free Services</span></div>
            </div>
          </div>
        </section>

        {/* Mission & Vision */}
        <section className="vision-mission-section">
          <div className="grid-2">
            <div className="card mission">
              <h3>{page?.secondary_title || 'Our Mission'}</h3>
              <RichContent html={page?.secondary_content} />
            </div>
            <div className="card vision">
              <h3>{page?.tertiary_title || 'Our Vision'}</h3>
              <RichContent html={page?.tertiary_content} />
            </div>
          </div>
        </section>

        {/* Key Highlights */}
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
