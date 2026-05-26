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
  slug: string;
  onBack: () => void;
}

export default function PublicHealthStaffProfile({ slug, onBack }: Props): JSX.Element {
  const [staff, setStaff] = useState<AcademicStaffMember | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiService.getAcademicStaff('public_health', slug)
      .then(res => { if (res.success) setStaff(res.data); })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, [slug]);

  if (loading) return <div className="staffs-page"><div className="staffs-container staffs-body"><p>Loading…</p></div></div>;
  if (!staff) return <div className="staffs-page"><div className="staffs-container staffs-body"><p>Staff member not found.</p><button onClick={onBack}>← Back</button></div></div>;

  const img = resolveImage(staff.profile_image);

  return (
    <div className="staffs-page">
      <div className="staffs-hero">
        <div className="staffs-container">
          <button className="back-btn" onClick={onBack}>← Back to Staff</button>
          <div className="staffs-hero-content">
            <span className="badge">School of Public Health · Staff Profile</span>
            <h1>{staff.full_name}</h1>
            <p className="lead">{staff.position}</p>
          </div>
        </div>
      </div>

      <div className="staffs-container staffs-body">
        <div className="profile-layout">
          <div className="profile-sidebar">
            <div className="profile-img-wrap">
              {img ? (
                <img src={img} alt={staff.full_name} className="profile-img"
                     onError={e => { (e.target as HTMLImageElement).style.display = 'none'; }} />
              ) : (
                <div className="profile-img-placeholder">
                  {staff.full_name.charAt(0).toUpperCase()}
                </div>
              )}
            </div>
            <div className="profile-meta">
              {staff.department && (
                <div className="meta-row">
                  <span className="meta-label">Department</span>
                  <span className="meta-value">{staff.department}</span>
                </div>
              )}
              {staff.qualification && (
                <div className="meta-row">
                  <span className="meta-label">Qualification</span>
                  <span className="meta-value">{staff.qualification}</span>
                </div>
              )}
              {staff.email && (
                <div className="meta-row">
                  <span className="meta-label">Email</span>
                  <a href={`mailto:${staff.email}`} className="meta-link">{staff.email}</a>
                </div>
              )}
              {staff.phone && (
                <div className="meta-row">
                  <span className="meta-label">Phone</span>
                  <a href={`tel:${staff.phone}`} className="meta-link">{staff.phone}</a>
                </div>
              )}
            </div>
          </div>

          <div className="profile-main">
            <h2>Biography</h2>
            {staff.biography ? (
              <p className="profile-bio">{staff.biography}</p>
            ) : (
              <p className="profile-bio-empty">No biography available.</p>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
