import { useState, useEffect, type JSX } from 'react';
import { apiService, type AcademicStaffMember } from '../services/api';
import '../school-of-medicine/Staffs.css';

const STORAGE = 'http://127.0.0.1:8000/storage';

function resolveImage(path: string | null): string | null {
  if (!path) return null;
  if (path.startsWith('http')) return path;
  return `${STORAGE}/${path}`;
}

interface Props {
  onBack: () => void;
  onViewProfile: (slug: string) => void;
}

export default function NursingStaffs({ onBack, onViewProfile }: Props): JSX.Element {
  const [staffs, setStaffs] = useState<AcademicStaffMember[]>([]);
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState('');

  useEffect(() => {
    apiService.getAcademicStaffs('nursing')
      .then(res => { if (res.success) setStaffs(res.data); })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  const filtered = staffs.filter(s =>
    s.full_name.toLowerCase().includes(search.toLowerCase()) ||
    (s.department ?? '').toLowerCase().includes(search.toLowerCase()) ||
    s.position.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="staffs-page">
      <div className="staffs-hero">
        <div className="staffs-container">
          <button className="back-btn" onClick={onBack}>← Back</button>
          <div className="staffs-hero-content">
            <span className="badge">School of Nursing</span>
            <h1>Our Academic Staff</h1>
            <p className="lead">Meet the dedicated faculty shaping the future of nursing at SPHMMC.</p>
          </div>
        </div>
      </div>

      <div className="staffs-container staffs-body">
        <div className="staffs-search-row">
          <input
            type="text"
            placeholder="Search by name, department or position..."
            value={search}
            onChange={e => setSearch(e.target.value)}
            className="staffs-search"
          />
        </div>

        {loading && (
          <div className="staffs-grid">
            {Array.from({ length: 6 }).map((_, i) => (
              <div key={i} className="staff-card staff-card--skeleton" />
            ))}
          </div>
        )}

        {!loading && filtered.length === 0 && (
          <div className="staffs-empty"><p>No staff members found.</p></div>
        )}

        {!loading && filtered.length > 0 && (
          <div className="staffs-grid">
            {filtered.map(staff => {
              const img = resolveImage(staff.profile_image);
              return (
                <div key={staff.id} className="staff-card">
                  <div className="staff-img-wrap">
                    {img ? (
                      <img src={img} alt={staff.full_name} className="staff-img"
                           onError={e => { (e.target as HTMLImageElement).style.display = 'none'; }} />
                    ) : (
                      <div className="staff-img-placeholder">
                        {staff.full_name.charAt(0).toUpperCase()}
                      </div>
                    )}
                  </div>
                  <div className="staff-info">
                    <h3 className="staff-name">{staff.full_name}</h3>
                    <p className="staff-position">{staff.position}</p>
                    {staff.department && <p className="staff-dept">{staff.department}</p>}
                    {staff.qualification && <p className="staff-qual">{staff.qualification}</p>}
                    {staff.biography && (
                      <p className="staff-bio">{staff.biography.slice(0, 100)}{staff.biography.length > 100 ? '…' : ''}</p>
                    )}
                    <button className="staff-profile-btn" onClick={() => onViewProfile(staff.slug)}>
                      View Profile →
                    </button>
                  </div>
                </div>
              );
            })}
          </div>
        )}
      </div>
    </div>
  );
}
