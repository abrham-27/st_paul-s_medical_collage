import { type JSX, useEffect, useState } from 'react';
import { apiService, type ResearchPublicationItem } from '../services/api';
import { toExcerpt } from '../utils/richText';
import './ResearchPublications.css';

interface Props {
  school: 'medicine' | 'nursing' | 'public-health';
  title: string;
  onBack: () => void;
}

interface PaginatedResponse {
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

export default function ResearchPublications({ school, title, onBack }: Props): JSX.Element {
  const [items, setItems] = useState<ResearchPublicationItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [page, setPage] = useState(1);
  const [meta, setMeta] = useState<PaginatedResponse | null>(null);
  const [error, setError] = useState<string | null>(null);

  const fetchPublications = async (pageNumber = 1) => {
    try {
      setLoading(true);
      const schoolSlug = school === 'public-health' ? 'public-health' : school;
      const response = await apiService.getSchoolResearchPublications(schoolSlug, pageNumber);
      setItems(Array.isArray(response.data) ? response.data : []);
      setMeta(response.meta);
      setError(null);
    } catch (err) {
      console.error('Failed to load research publications', err);
      setError('Unable to load research publications.');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchPublications(page);
  }, [page, school]);

  const handlePageChange = (newPage: number) => {
    if (meta && newPage >= 1 && newPage <= meta.last_page) {
      setPage(newPage);
    }
  };

  return (
    <div className="research-publications-page">
      <div className="hero-section">
        <div className="container">
          <button className="back-btn" onClick={onBack}>← Back</button>
          <div className="hero-content">
            <span className="badge">Academics</span>
            <h1>{title} · Research & Publications</h1>
            <p>Browse the latest research, journals, and scholarly publications from {title}.</p>
          </div>
        </div>
      </div>

      <div className="container main-content">
        {loading && <div className="loading-state">Loading publications...</div>}
        {error && <div className="error-state">{error}</div>}

        {!loading && !error && (
          <>
            <div className="pub-grid">
              {items.length === 0 && (
                <div className="empty-state">No publications found yet.</div>
              )}
              {items.map((item) => (
                <article key={item.id} className="pub-card">
                  <div className="pub-card-media">
                    {item.cover_image ? (
                      <img src={item.cover_image} alt={item.title} />
                    ) : (
                      <div className="pub-card-placeholder">No image</div>
                    )}
                  </div>
                  <div className="pub-card-body">
                    <span className="pub-badge">{item.publication_type || 'Publication'}</span>
                    <h2>{item.title}</h2>
                    <p>{toExcerpt(item.abstract, 180)}</p>
                    <div className="pub-meta">
                      <span>{item.authors || 'Unknown author'}</span>
                      <span>{item.publication_date ? new Date(item.publication_date).toLocaleDateString() : 'No date'}</span>
                    </div>
                    <div className="pub-card-actions">
                      <a href={`/academics/${school}/research-publications/${item.slug}`} className="button button-primary">Read More</a>
                      {item.pdf_file && (
                        <a href={item.pdf_file} target="_blank" rel="noreferrer" className="button button-secondary">Download PDF</a>
                      )}
                    </div>
                  </div>
                </article>
              ))}
            </div>

            {meta && meta.last_page > 1 && (
              <div className="pagination-row">
                <button onClick={() => handlePageChange(page - 1)} disabled={page <= 1}>Previous</button>
                <span>Page {page} of {meta.last_page}</span>
                <button onClick={() => handlePageChange(page + 1)} disabled={page >= meta.last_page}>Next</button>
              </div>
            )}
          </>
        )}
      </div>
    </div>
  );
}
