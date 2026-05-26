import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { apiService, type ResearchPublicationItem } from '../services/api';
import { sanitizeHtml } from '../utils/richText';
import './AcademicProjects.css';

interface Props {
  onBack: () => void;
}

function schoolDisplayName(schoolType: string): string {
  switch (schoolType) {
    case 'medicine':
      return 'Medicine';
    case 'nursing':
      return 'Nursing';
    case 'public_health':
      return 'Public Health';
    default:
      return schoolType || 'Research';
  }
}

function formatPublicationDate(date: string | null): string {
  if (!date) {
    return 'Date unavailable';
  }

  return new Date(date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  });
}

export default function AcademicResearchDetail({ onBack }: Props) {
  const { slug = '' } = useParams<{ slug: string }>();
  const [item, setItem] = useState<ResearchPublicationItem | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchDetail = async () => {
      if (!slug) {
        return;
      }

      try {
        setLoading(true);
        const response = await apiService.getAcademicResearchPublication(slug);
        setItem(response.data);
        setError(null);
      } catch (err) {
        console.error('Academic research detail fetch failed', err);
        setError('The requested research record could not be found.');
      } finally {
        setLoading(false);
      }
    };

    void fetchDetail();
  }, [slug]);

  return (
    <div className="ap-page">
      <div className="ap-hero">
        <div className="ap-container">
          <button className="ap-back-btn" onClick={onBack}>← Back to Academic Research</button>
          <span className="ap-badge">SPHMMC · Academics</span>
          <h1 className="ap-hero-title">Academic Research</h1>
          <p className="ap-hero-sub">Explore the full details for this combined research and publication record.</p>
        </div>
      </div>

      <div className="ap-container ap-body">
        {loading && <div className="ap-empty">Loading details...</div>}
        {error && <div className="ap-empty">{error}</div>}

        {item && (
          <div className="ap-detail-layout">
            <div>
              {item.cover_image && (
                <img src={item.cover_image} alt={item.title} className="ap-detail-cover" />
              )}

              <div className="ap-card-body" style={{ paddingLeft: 0, paddingRight: 0 }}>
                <span className="ap-card-badge">{schoolDisplayName(item.school_type)}</span>
                <h2 style={{ marginTop: '1rem', fontSize: '1.8rem' }}>{item.title}</h2>
                {item.subtitle && <p className="ap-card-excerpt" style={{ fontSize: '1rem' }}>{item.subtitle}</p>}

                <div className="ap-detail-meta">
                  <span>{item.publication_type || 'Publication'}</span>
                  <span>{item.authors || 'Author unavailable'}</span>
                  <span>{formatPublicationDate(item.publication_date)}</span>
                </div>

                <div className="ap-detail-excerpt" dangerouslySetInnerHTML={{ __html: sanitizeHtml(item.abstract || '<p>No abstract is currently available for this record.</p>') }} />

                <div className="ap-detail-content">
                  <h2>Publication Details</h2>
                  <p><strong>Journal:</strong> {item.journal_name || 'Not specified'}</p>
                  <p><strong>Keywords:</strong> {item.keywords || 'Not specified'}</p>
                  {item.doi_link && (
                    <p><strong>DOI:</strong> <a href={item.doi_link} target="_blank" rel="noreferrer">{item.doi_link}</a></p>
                  )}
                  {item.external_link && (
                    <p><strong>External Link:</strong> <a href={item.external_link} target="_blank" rel="noreferrer">Open resource</a></p>
                  )}
                </div>

                <div className="ap-card-actions" style={{ display: 'flex', flexWrap: 'wrap', gap: '0.75rem', marginTop: '1rem' }}>
                  {item.pdf_file ? (
                    <a href={item.pdf_file} target="_blank" rel="noreferrer" className="ap-resource-btn" style={{ maxWidth: '220px' }}>
                      Download PDF
                    </a>
                  ) : (
                    <span className="ap-resource-btn ap-resource-btn--outline" style={{ maxWidth: '220px', cursor: 'default', opacity: 0.8 }}>
                      PDF Not Available
                    </span>
                  )}
                  <button className="ap-resource-btn ap-resource-btn--outline" style={{ maxWidth: '220px' }} onClick={onBack}>Back to list</button>
                </div>
              </div>
            </div>

            <aside>
              <div className="ap-sidebar-card">
                <h3>Record Summary</h3>
                <div className="ap-sidebar-row">
                  <span className="ap-sidebar-label">School</span>
                  <span className="ap-sidebar-value">{schoolDisplayName(item.school_type)}</span>
                </div>
                <div className="ap-sidebar-row">
                  <span className="ap-sidebar-label">Publication Type</span>
                  <span className="ap-sidebar-value">{item.publication_type || 'Publication'}</span>
                </div>
                <div className="ap-sidebar-row">
                  <span className="ap-sidebar-label">Authors</span>
                  <span className="ap-sidebar-value">{item.authors || 'Author unavailable'}</span>
                </div>
                <div className="ap-sidebar-row">
                  <span className="ap-sidebar-label">Published</span>
                  <span className="ap-sidebar-value">{formatPublicationDate(item.publication_date)}</span>
                </div>
              </div>
            </aside>
          </div>
        )}
      </div>
    </div>
  );
}
