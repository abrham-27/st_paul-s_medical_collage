import { useState, useEffect, type JSX } from 'react';
import { apiService, type AcademicPageData } from '../services/api';
import { containsHtml } from '../services/content';
import { getNursingOverviewContent } from './overviewContent';
import './about.css';

interface Props {
  onBack: () => void;
}

export default function NursingOverview({ onBack }: Props): JSX.Element {
  const [page, setPage] = useState<AcademicPageData | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchPage = async () => {
      try {
        setLoading(true);
        setError(null);
        const res = await apiService.getAcademicPage('nursing', 'overview');
        if (res.success && res.data) {
          setPage(res.data);
        }
      } catch (err) {
        setError('Unable to load overview content.');
        console.error(err);
      } finally {
        setLoading(false);
      }
    };

    fetchPage();
  }, []);

  const overview = getNursingOverviewContent(page);

  return (
    <div className="nursing-about">
      <section className="nursing-hero">
        <div className="hero-overlay">
          <div className="container">
            <button type="button" onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>School of Nursing</h1>
            {overview.hero_subtitle && <p>{overview.hero_subtitle}</p>}
          </div>
        </div>
      </section>

      <section className="nursing-content">
        <div className="container">
          {loading && (
            <p style={{ padding: '2rem', color: '#888' }}>Loading overview…</p>
          )}

          {error && (
            <p style={{ padding: '2rem', color: '#b91c1c' }}>{error}</p>
          )}

          {!loading && !error && (
            <>
              <div className="content-section">
                <h2>{page?.title || 'About School of Nursing'}</h2>

                {overview.timeline.length > 0 ? (
                  <div className="history-timeline">
                    {overview.timeline.map((item, index) => (
                      <div key={`${item.year}-${index}`} className="timeline-item">
                        <div className="timeline-year">{item.year}</div>
                        <div className="timeline-content">
                          <h3>{item.title}</h3>
                          <p>{item.description}</p>
                        </div>
                      </div>
                    ))}
                  </div>
                ) : null}

                {overview.about_text && (
                  containsHtml(overview.about_text) ? (
                    <div
                      style={{
                        lineHeight: 1.75,
                        color: '#444',
                        marginTop: overview.timeline.length ? '1.5rem' : 0,
                      }}
                      dangerouslySetInnerHTML={{ __html: overview.about_text }}
                    />
                  ) : (
                    <p
                      style={{
                        whiteSpace: 'pre-line',
                        lineHeight: 1.75,
                        color: '#444',
                        marginTop: overview.timeline.length ? '1.5rem' : 0,
                      }}
                    >
                      {overview.about_text}
                    </p>
                  )
                )}
              </div>

              {(page?.secondary_title || page?.secondary_content) && (
                <div
                  className="content-section"
                  style={{
                    background: '#f8faff',
                    borderRadius: 12,
                    padding: '2rem',
                    marginBottom: '2rem',
                  }}
                >
                  <h2 style={{ color: '#000080' }}>
                    {page?.secondary_title || 'Our Mission'}
                  </h2>
                  {page?.secondary_content && (
                    containsHtml(page.secondary_content) ? (
                      <div
                        style={{
                          lineHeight: 1.75,
                          color: '#444',
                          fontSize: '1rem',
                        }}
                        dangerouslySetInnerHTML={{ __html: page.secondary_content }}
                      />
                    ) : (
                      <p
                        style={{
                          whiteSpace: 'pre-line',
                          lineHeight: 1.75,
                          color: '#444',
                          fontSize: '1rem',
                        }}
                      >
                        {page.secondary_content}
                      </p>
                    )
                  )}
                </div>
              )}

              {(page?.tertiary_title || page?.tertiary_content) && (
                <div
                  className="content-section"
                  style={{ background: '#fff8f0', borderRadius: 12, padding: '2rem' }}
                >
                  <h2 style={{ color: '#000080' }}>
                    {page?.tertiary_title || 'Our Vision'}
                  </h2>
                  {page?.tertiary_content && (
                    containsHtml(page.tertiary_content) ? (
                      <div
                        style={{
                          lineHeight: 1.75,
                          color: '#444',
                          fontSize: '1rem',
                        }}
                        dangerouslySetInnerHTML={{ __html: page.tertiary_content }}
                      />
                    ) : (
                      <p
                        style={{
                          whiteSpace: 'pre-line',
                          lineHeight: 1.75,
                          color: '#444',
                          fontSize: '1rem',
                        }}
                      >
                        {page.tertiary_content}
                      </p>
                    )
                  )}
                </div>
              )}

              <div
                className="content-section"
                style={{ background: '#eef6ff', borderRadius: 18, padding: '2rem', marginTop: '1.5rem' }}
              >
                <h2 style={{ marginBottom: '1rem' }}>Research & Publications</h2>
                <p style={{ marginBottom: '1.25rem', color: '#334155' }}>
                  Visit the School of Nursing research page to view current publications, projects, and academic outputs.
                </p>
                <a
                  href="/academics/nursing/research-publications"
                  style={{ display: 'inline-block', padding: '0.85rem 1.5rem', borderRadius: 999, background: '#2563eb', color: '#fff', textDecoration: 'none', fontWeight: 700 }}
                >
                  Go to Research Publications
                </a>
              </div>
            </>
          )}
        </div>
      </section>
    </div>
  );
}
