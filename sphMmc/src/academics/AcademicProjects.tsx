import { useEffect, useState } from 'react';
import { apiService, type ResearchPublicationItem } from '../services/api';
import './AcademicProjects.css';

const PAGE_SIZE = 9;

const SCHOOL_OPTIONS = ['All', 'Medicine', 'Nursing', 'Public Health'] as const;

type SchoolFilter = (typeof SCHOOL_OPTIONS)[number];

function schoolTypeValue(filter: SchoolFilter): string | undefined {
  switch (filter) {
    case 'Medicine':
      return 'medicine';
    case 'Nursing':
      return 'nursing';
    case 'Public Health':
      return 'public_health';
    default:
      return undefined;
  }
}

function schoolBadgeLabel(schoolType: string): string {
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

function formatDate(value: string | null): string {
  if (!value) {
    return 'Date unavailable';
  }

  return new Date(value).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  });
}

function stripHtml(value: string | null): string {
  if (!value) {
    return 'No abstract available.';
  }

  const plainText = value.replace(/<[^>]+>/g, ' ').replace(/\s+/g, ' ').trim();
  return plainText.length > 165 ? `${plainText.slice(0, 165)}…` : plainText;
}

interface Props {
  onBack: () => void;
  onViewProject: (slug: string) => void;
}

export default function AcademicProjects({ onBack, onViewProject }: Props) {
  const [records, setRecords] = useState<ResearchPublicationItem[]>([]);
  const [publicationTypes, setPublicationTypes] = useState<string[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [search, setSearch] = useState('');
  const [schoolFilter, setSchoolFilter] = useState<SchoolFilter>('All');
  const [publicationType, setPublicationType] = useState('All');
  const [page, setPage] = useState(1);

  useEffect(() => {
    const fetchResearch = async () => {
      try {
        setLoading(true);
        setError(null);

        const response = await apiService.getAcademicResearch({
          page: 1,
          per_page: 1000,
          school_type: schoolTypeValue(schoolFilter),
          publication_type: publicationType === 'All' ? undefined : publicationType,
          search: search.trim() || undefined,
        });

        if (response.success) {
          setRecords(response.data);
          setPublicationTypes(response.meta.publication_types || []);
          setPage(1);
        }
      } catch (err) {
        console.error('Academic research fetch failed', err);
        setError('Unable to load academic research right now.');
      } finally {
        setLoading(false);
      }
    };

    void fetchResearch();
  }, [schoolFilter, publicationType, search]);

  const totalPages = Math.max(1, Math.ceil(records.length / PAGE_SIZE));
  const visibleRecords = records.slice((page - 1) * PAGE_SIZE, page * PAGE_SIZE);

  return (
    <div className="ap-page">
      <div className="ap-hero">
        <div className="ap-container">
          <button className="ap-back-btn" onClick={onBack}>← Back</button>
          <span className="ap-badge">SPHMMC · Academics</span>
          <h1 className="ap-hero-title">Academic Research</h1>
          <p className="ap-hero-sub">
            Browse the latest research and publications across the School of Medicine, School of Nursing, and School of Public Health.
          </p>
        </div>
      </div>

      <div className="ap-container ap-body">
        <div className="ap-toolbar">
          <label className="ap-search-field">
            <span>Search</span>
            <input
              type="search"
              placeholder="Search by title, authors, keywords, or journal"
              value={search}
              onChange={(event) => setSearch(event.target.value)}
            />
          </label>

          <label className="ap-filter-field">
            <span>School</span>
            <select value={schoolFilter} onChange={(event) => setSchoolFilter(event.target.value as SchoolFilter)}>
              {SCHOOL_OPTIONS.map((option) => (
                <option key={option} value={option}>{option}</option>
              ))}
            </select>
          </label>

          <label className="ap-filter-field">
            <span>Publication Type</span>
            <select value={publicationType} onChange={(event) => setPublicationType(event.target.value)}>
              <option value="All">All Types</option>
              {publicationTypes.map((type) => (
                <option key={type} value={type}>{type}</option>
              ))}
            </select>
          </label>
        </div>

        {loading && (
          <div className="ap-grid">
            {Array.from({ length: 6 }).map((_, index) => (
              <div key={index} className="ap-card ap-card--skeleton" />
            ))}
          </div>
        )}

        {!loading && error && <div className="ap-empty">{error}</div>}

        {!loading && !error && visibleRecords.length === 0 && (
          <div className="ap-empty">
            <p>No research or publications match your current filters.</p>
          </div>
        )}

        {!loading && !error && visibleRecords.length > 0 && (
          <>
            <div className="ap-grid">
              {visibleRecords.map((record) => (
                <article key={record.id} className="ap-card">
                  <div className="ap-card-img-wrap">
                    {record.cover_image ? (
                      <img
                        src={record.cover_image}
                        alt={record.title}
                        className="ap-card-img"
                        loading="lazy"
                        onError={(event) => {
                          (event.target as HTMLImageElement).style.display = 'none';
                        }}
                      />
                    ) : (
                      <div className="ap-card-img-placeholder">🔬</div>
                    )}
                    <span className="ap-card-badge">{schoolBadgeLabel(record.school_type)}</span>
                  </div>

                  <div className="ap-card-body">
                    <span className="ap-card-pill">{record.publication_type || 'Publication'}</span>
                    <h3 className="ap-card-title">{record.title}</h3>
                    <p className="ap-card-excerpt">{stripHtml(record.abstract)}</p>

                    <div className="ap-card-meta">
                      <span>{record.authors || 'Author unavailable'}</span>
                      <span>{formatDate(record.publication_date)}</span>
                    </div>

                    <div className="ap-card-actions">
                      <button type="button" className="ap-view-btn" onClick={() => onViewProject(record.slug)}>
                        Read More →
                      </button>
                      {record.pdf_file && (
                        <a href={record.pdf_file} target="_blank" rel="noreferrer" className="ap-resource-btn ap-resource-btn--outline">
                          Download PDF
                        </a>
                      )}
                    </div>
                  </div>
                </article>
              ))}
            </div>

            {totalPages > 1 && (
              <div className="ap-pagination">
                <button className="ap-page-btn" disabled={page === 1} onClick={() => setPage((current) => Math.max(1, current - 1))}>
                  ← Prev
                </button>
                <span className="ap-page-info">Page {page} of {totalPages}</span>
                <button className="ap-page-btn" disabled={page === totalPages} onClick={() => setPage((current) => Math.min(totalPages, current + 1))}>
                  Next →
                </button>
              </div>
            )}
          </>
        )}
      </div>
    </div>
  );
}
