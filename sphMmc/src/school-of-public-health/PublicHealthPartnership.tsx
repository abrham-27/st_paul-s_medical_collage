import { useState, useEffect } from 'react';
import { apiService, type AcademicPageData } from '../services/api';
import './PublicHealthAbout.css';

interface Props { onBack: () => void }

export default function PublicHealthPartnership({ onBack }: Props) {
  const [page, setPage] = useState<AcademicPageData | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiService.getAcademicPage('public_health', 'partnership')
      .then(res => { if (res.success && res.data) setPage(res.data); })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  return (
    <div className="sph-about-page">
      <div className="sph-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Academics</button>
          <span className="school-label">School of Public Health (SPH)</span>
          <h1>{page?.title || 'Partnership & Collaboration'}</h1>
        </div>
      </div>

      <div className="sph-content-wrapper container">
        <div className="sph-main-content fade-in">

          {loading && <section className="sph-section"><p style={{ color: '#888' }}>Loading…</p></section>}
          {!loading && page?.featured_image && (
            <section className="sph-section">
              <img src={page.featured_image} alt="Partnership"
                   style={{ width: '100%', maxHeight: 360, objectFit: 'cover', borderRadius: 10, marginBottom: '1.5rem' }} />
            </section>
          )}

          <section className="sph-section">
            <div className="section-icon">🤝</div>
            <h2>{page?.title || 'Partnership & Collaboration'}</h2>
            {page?.content ? (
              <p style={{ whiteSpace: 'pre-line', lineHeight: 1.8, color: '#444', fontSize: '1rem' }}>{page.content}</p>
            ) : (
              <>
                <p className="lead-text">
                  The School of Public Health at SPHMMC collaborates with national and international partners to advance public health education, research, and community service.
                </p>
                <div className="stats-banner">
                  <div className="stat-item"><span className="stat-number">20+</span><span className="stat-label">Partner Organizations</span></div>
                  <div className="stat-item"><span className="stat-number">5+</span><span className="stat-label">International Partners</span></div>
                  <div className="stat-item"><span className="stat-number">10+</span><span className="stat-label">Research Collaborations</span></div>
                </div>
              </>
            )}
          </section>

        </div>
      </div>
    </div>
  );
}
