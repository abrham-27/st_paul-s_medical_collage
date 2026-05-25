import { useEffect, useState, type JSX } from 'react';
import { apiService, type AcademicStaffMember } from '../services/api';
import '../school-of-medicine/Staffs.css';

const STORAGE = 'http://127.0.0.1:8000/storage';

function resolveImage(path: string | null): string | null {
  if (!path) return null;
  if (path.startsWith('http')) return path;
  return `${STORAGE}/${path}`;
}

interface DepartmentStaffsProps {
  school: string;
  departmentName: string;
  title: string;
  show: boolean;
}

export default function DepartmentStaffs({ school, departmentName, title, show }: DepartmentStaffsProps): JSX.Element | null {
  const [staffs, setStaffs] = useState<AcademicStaffMember[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    let cancelled = false;
    if (!show || !departmentName) {
      return () => { cancelled = true; };
    }

    setLoading(true);
    setError(null);
    apiService.getAcademicStaffs(school, departmentName)
      .then((res) => {
        if (!cancelled) {
          setStaffs(res.success ? res.data : []);
        }
      })
      .catch((err) => {
        if (!cancelled) {
          console.error(err);
          setError('Unable to load staff members for this department.');
        }
      })
      .finally(() => {
        if (!cancelled) {
          setLoading(false);
        }
      });

    return () => { cancelled = true; };
  }, [school, departmentName, show]);

  if (!show) {
    return null;
  }

  return (
    <section className="department-staffs">
      <div className="staffs-container" style={{ paddingTop: '2.5rem', paddingBottom: '3rem' }}>
        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', gap: '1rem', flexWrap: 'wrap', marginBottom: '1rem' }}>
          <div>
            <h2 style={{ margin: 0, fontSize: 'clamp(1.4rem, 2vw, 2rem)', color: '#000080' }}>
              Staff in {title}
            </h2>
            <p style={{ margin: '0.75rem 0 0', color: '#555', maxWidth: '760px' }}>
              Faculty and academic staff assigned to this department.
            </p>
          </div>
        </div>

        {loading && (
          <div className="staffs-grid">
            {Array.from({ length: 4 }).map((_, index) => (
              <div key={index} className="staff-card staff-card--skeleton" />
            ))}
          </div>
        )}

        {error && (
          <div className="staffs-empty" style={{ color: '#b91c1c' }}>{error}</div>
        )}

        {!loading && !error && staffs.length === 0 && (
          <div className="staffs-empty">No staff members were found for this department.</div>
        )}

        {!loading && !error && staffs.length > 0 && (
          <div className="staffs-grid">
            {staffs.map((staff) => {
              const img = resolveImage(staff.profile_image);
              return (
                <div key={staff.id} className="staff-card">
                  <div className="staff-img-wrap">
                    {img ? (
                      <img
                        src={img}
                        alt={staff.full_name}
                        className="staff-img"
                        onError={(event) => { (event.target as HTMLImageElement).style.display = 'none'; }}
                      />
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
                      <p className="staff-bio">
                        {staff.biography.slice(0, 110)}{staff.biography.length > 110 ? '…' : ''}
                      </p>
                    )}
                  </div>
                </div>
              );
            })}
          </div>
        )}
      </div>
    </section>
  );
}
