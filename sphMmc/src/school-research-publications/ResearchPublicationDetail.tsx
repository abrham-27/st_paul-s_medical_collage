import { type JSX, useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { apiService, type ResearchPublicationItem } from '../services/api';
import './ResearchPublications.css';

interface Props {
  school: 'medicine' | 'nursing' | 'public-health';
  title: string;
  onBack: () => void;
}

export default function ResearchPublicationDetail({ school, title, onBack }: Props): JSX.Element {
  const { slug } = useParams<{ slug: string }>();
  const [item, setItem] = useState<ResearchPublicationItem | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchDetail = async () => {
      if (!slug) return;
      try {
        setLoading(true);
        const schoolSlug = school === 'public-health' ? 'public-health' : school;
        const response = await apiService.getSchoolResearchPublication(schoolSlug, slug);
        setItem(response.data);
        setError(null);
      } catch (err) {
        console.error('Publication fetch failed', err);
        setError('Publication not found.');
      } finally {
        setLoading(false);
      }
    };
    void fetchDetail();
  }, [slug, school]);

  return (
    <div className="research-publications-page">
      <div className="hero-section">
        <div className="container">
          <button className="back-btn" onClick={onBack}>← Back</button>
          <div className="hero-content">
            <span className="badge">Academics</span>
            <h1>{title} · Research Publication</h1>
            <p>Detailed research record for {title}.</p>
          </div>
        </div>
      </div>

      <div className="container main-content">
        {loading && <div className="loading-state">Loading publication details...</div>}
        {error && <div className="error-state">{error}</div>}

        {item && !loading && !error && (
          <article className="detail-card">
            {item.cover_image && <img src={item.cover_image} alt={item.title} className="detail-cover" />}
            <div className="detail-header">
              <span className="pub-badge">{item.publication_type || 'Publication'}</span>
              <h2>{item.title}</h2>
              {item.subtitle && <p className="subtitle">{item.subtitle}</p>}
              <div className="pub-meta detail-meta">
                <span>{item.authors || 'Unknown author'}</span>
                <span>{item.publication_date ? new Date(item.publication_date).toLocaleDateString() : 'No date'}</span>
              </div>
            </div>

            <div className="detail-content">
              <h3>Abstract</h3>
              <div dangerouslySetInnerHTML={{ __html: item.abstract || '<p>No abstract provided.</p>' }} />

              <div className="detail-grid">
                <div>
                  <h4>Journal</h4>
                  <p>{item.journal_name || 'Not specified'}</p>
                </div>
                <div>
                  <h4>DOI</h4>
                  <p>{item.doi_link ? <a href={item.doi_link} target="_blank" rel="noreferrer" className="link">{item.doi_link}</a> : 'Not provided'}</p>
                </div>
                <div>
                  <h4>External Link</h4>
                  <p>{item.external_link ? <a href={item.external_link} target="_blank" rel="noreferrer" className="link">Open resource</a> : 'Not provided'}</p>
                </div>
                <div>
                  <h4>Keywords</h4>
                  <p>{item.keywords || 'None'}</p>
                </div>
              </div>

              <div className="detail-actions">
                {item.pdf_file && (
                  <a href={item.pdf_file} target="_blank" rel="noreferrer" className="button button-primary">Download PDF</a>
                )}
                <a href={`/academics/${school}/research-publications`} className="button button-secondary">Back to list</a>
              </div>
            </div>
          </article>
        )}
      </div>
    </div>
  );
}
