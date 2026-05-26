import { useState, useEffect, type JSX } from 'react';
import { apiService, type AcademicPageData } from '../services/api';
import { containsHtml } from '../services/content';
import { sanitizeHtml } from '../utils/richText';
import './about.css';

interface Props { onBack: () => void }

export default function NursingPartnership({ onBack }: Props): JSX.Element {
  const [page, setPage] = useState<AcademicPageData | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiService.getAcademicPage('nursing', 'partnership')
      .then(res => { if (res.success && res.data) setPage(res.data); })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  return (
    <div className="nursing-about">
      <section className="nursing-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">← Back</button>
            <h1>{page?.title || 'Partnership & Collaboration'}</h1>
            <p>Building bridges for excellence in nursing education</p>
          </div>
        </div>
      </section>

      <section className="nursing-content">
        <div className="container">
          {loading && <p style={{ padding: '2rem', color: '#888' }}>Loading…</p>}
          {!loading && page?.featured_image && (
            <div className="content-section">
              <img src={page.featured_image} alt="Partnership"
                   style={{ width: '100%', maxHeight: 360, objectFit: 'cover', borderRadius: 10, marginBottom: '1.5rem' }} />
            </div>
          )}

          <div className="content-section">
            <h2>{page?.title || 'Partnership & Collaboration'}</h2>
            {page?.content ? (
              containsHtml(page.content) ? (
                <div
                  style={{ lineHeight: 1.8, color: '#444', fontSize: '1rem' }}
                  dangerouslySetInnerHTML={{ __html: sanitizeHtml(page.content) }}
                />
              ) : (
                <p style={{ whiteSpace: 'pre-line', lineHeight: 1.8, color: '#444', fontSize: '1rem' }}>{page.content}</p>
              )
            ) : (
              <>
                <p>The School of Nursing at SPHMMC actively collaborates with national and international institutions to advance nursing education, research, and clinical practice.</p>
                <div className="programs-grid" style={{ marginTop: '1.5rem' }}>
                  <div className="program-card undergraduate">
                    <div className="program-header"><h3>National Partners</h3></div>
                    <ul className="program-list">
                      <li>Ethiopian Federal Ministry of Health</li>
                      <li>Ethiopian Nurses Association</li>
                      <li>St. Paul's Hospital Millennium Medical College</li>
                      <li>Regional Health Bureaus</li>
                    </ul>
                  </div>
                  <div className="program-card postgraduate">
                    <div className="program-header"><h3>International Partners</h3></div>
                    <ul className="program-list">
                      <li>Trauma Care Ethiopia</li>
                      <li>Children Burn Care Foundation</li>
                      <li>International Council of Nurses</li>
                      <li>WHO Ethiopia Country Office</li>
                    </ul>
                  </div>
                </div>
              </>
            )}
          </div>
        </div>
      </section>
    </div>
  );
}
