import { useState, useEffect } from 'react';
import { apiService, type AcademicPageData } from '../services/api';
import { containsHtml } from '../services/content';
import './PublicHealthAbout.css';

interface Props { onBack: () => void }

export default function PublicHealthOverview({ onBack }: Props) {
  const [page, setPage] = useState<AcademicPageData | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchPage = async () => {
      try {
        setLoading(true);
        setError(null);
        const res = await apiService.getAcademicPage('public_health', 'overview');
        if (res.success) {
          setPage(res.data);
        } else {
          setError('Unable to load overview content.');
        }
      } catch (err) {
        console.error('Failed to fetch public health overview:', err);
        setError('Unable to load overview content.');
      } finally {
        setLoading(false);
      }
    };

    fetchPage();
  }, []);

  if (loading) {
    return (
      <div className="sph-about-page">
        <div className="container" style={{ padding: '4rem 0' }}>
          <p>Loading overview content…</p>
        </div>
      </div>
    );
  }

  return (
    <div className="sph-about-page">
      <div className="sph-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Academics</button>
          <span className="school-label">School of Public Health (SPH)</span>
          <h1>Overview</h1>
        </div>
      </div>

      <div className="sph-content-wrapper container sph-overview-content">
        <div className="sph-main-content fade-in">

          {error && (
            <section className="sph-section" style={{ background: '#fff1f2', borderRadius: 12, padding: '1rem 1.5rem', marginBottom: '1.5rem', border: '1px solid #fca5a5' }}>
              <p style={{ margin: 0, color: '#b91c1c' }}>{error}</p>
            </section>
          )}

          {/* About Block */}
          <section className="sph-section">
            <div className="section-icon">🏥</div>
            <h2>{page?.title || 'About School of Public Health'}</h2>
            {page?.content ? (
              containsHtml(page.content) ? (
                <div
                  style={{ lineHeight: 1.8, color: '#444' }}
                  dangerouslySetInnerHTML={{ __html: page.content }}
                />
              ) : (
                <p style={{ whiteSpace: 'pre-line', lineHeight: 1.8, color: '#444' }}>{page.content}</p>
              )
            ) : (
              <>
                <p className="lead-text">
                  The School of Public Health (SPH) is one of the schools under Saint Paul's Hospital Millennium Medical College (SPHMMC). SPH is one of the nation's premier schools of public health, with a strong track record of outstanding research, teaching, and community service excellence.
                </p>
                <div className="stats-banner">
                  <div className="stat-item"><span className="stat-number">6</span><span className="stat-label">Advanced Training Programs</span></div>
                  <div className="stat-item"><span className="stat-number">300+</span><span className="stat-label">Graduates Across Disciplines</span></div>
                  <div className="stat-item"><span className="stat-number">350+</span><span className="stat-label">Currently Enrolled Students</span></div>
                </div>
              </>
            )}
          </section>

          {/* Mission Block */}
          <section className="sph-section" style={{ background: '#f0f4ff', borderRadius: 12, padding: '2rem', marginBottom: '2rem' }}>
            <div className="section-icon">🎯</div>
            <h2>{page?.secondary_title || 'Mission'}</h2>
            {page?.secondary_content ? (
              containsHtml(page.secondary_content) ? (
                <div
                  style={{ lineHeight: 1.8, color: '#444', fontSize: '1rem' }}
                  dangerouslySetInnerHTML={{ __html: page.secondary_content }}
                />
              ) : (
                <p style={{ whiteSpace: 'pre-line', lineHeight: 1.8, color: '#444', fontSize: '1rem' }}>
                  {page.secondary_content}
                </p>
              )
            ) : (
              <p style={{ whiteSpace: 'pre-line', lineHeight: 1.8, color: '#444', fontSize: '1rem' }}>
                To advance the health of the people by developing and implementing innovative Public Health Education, research and community services through proposing interventions and health policies based on scientific knowledge and evidence.
              </p>
            )}
          </section>

          {/* Research Publications Card */}
          <section className="sph-section" style={{ background: '#ebf8ff', borderRadius: 16, padding: '2rem', marginBottom: '2rem' }}>
            <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
              <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                <div className="section-icon">📚</div>
                <div>
                  <h2>Research & Publications</h2>
                  <p style={{ margin: 0, color: '#334155' }}>
                    Discover the latest research and publications from the School of Public Health.
                  </p>
                </div>
              </div>
              <a
                href="/academics/public-health/research-publications"
                style={{ display: 'inline-flex', alignItems: 'center', justifyContent: 'center', width: 'fit-content', padding: '0.85rem 1.5rem', borderRadius: 999, background: '#2563eb', color: '#fff', textDecoration: 'none', fontWeight: 700 }}
              >
                View Research Publications
              </a>
            </div>
          </section>

          {/* Vision Block */}
          <section className="sph-section" style={{ background: '#fff8f0', borderRadius: 12, padding: '2rem' }}>
            <div className="section-icon">🔭</div>
            <h2>{page?.tertiary_title || 'Vision'}</h2>
            {page?.tertiary_content ? (
              containsHtml(page.tertiary_content) ? (
                <div
                  style={{ lineHeight: 1.8, color: '#444', fontSize: '1rem' }}
                  dangerouslySetInnerHTML={{ __html: page.tertiary_content }}
                />
              ) : (
                <p style={{ whiteSpace: 'pre-line', lineHeight: 1.8, color: '#444', fontSize: '1rem' }}>
                  {page.tertiary_content}
                </p>
              )
            ) : (
              <p style={{ whiteSpace: 'pre-line', lineHeight: 1.8, color: '#444', fontSize: '1rem' }}>
                Leader in the development of academic programs that are nationally and internationally recognized because of the impact of the innovative researches on health policy and interventions in Ethiopia by 2027/28.
              </p>
            )}
          </section>

        </div>
      </div>
    </div>
  );
}
