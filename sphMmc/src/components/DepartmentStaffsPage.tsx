import { useEffect, useMemo, useState, type JSX } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { apiService, type AcademicStaffMember } from '../services/api';
import '../school-of-medicine/Staffs.css';
import './DepartmentStaffsPage.css';

const STORAGE = 'http://127.0.0.1:8000/storage';

const PUBLIC_HEALTH_DEPARTMENTS: Record<string, string> = {
  epidemiology: 'Department of Epidemiology',
  health_management_nutrition: 'Department of Health Management, Promotion, Reproductive Health and Nutrition',
};

function resolveImage(path: string | null): string | null {
  if (!path) return null;
  if (path.startsWith('http')) return path;
  return `${STORAGE}/${path}`;
}

function formatSchoolParam(school: string): string {
  return school === 'public-health' ? 'public_health' : school;
}

export default function DepartmentStaffsPage(): JSX.Element {
  const navigate = useNavigate();
  const { school = '', departmentKey = '' } = useParams<{ school: string; departmentKey: string }>();
  const [staffs, setStaffs] = useState<AcademicStaffMember[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [departmentName, setDepartmentName] = useState<string>(departmentKey.replace(/-/g, ' '));
  const [search, setSearch] = useState('');

  useEffect(() => {
    let cancelled = false;
    async function loadDepartmentStaff() {
      setLoading(true);
      setError(null);
      setSearch('');

      const apiSchool = formatSchoolParam(school);
      let resolvedName = departmentKey.replace(/-/g, ' ');

      try {
        if (apiSchool === 'medicine') {
          const response = await apiService.getMedicineDepartment(departmentKey);
          resolvedName = response?.name ?? resolvedName;
        } else if (apiSchool === 'nursing') {
          const response = await apiService.getNursingDepartment(departmentKey);
          resolvedName = response?.page_title ?? response?.title ?? resolvedName;
        } else if (apiSchool === 'public_health') {
          resolvedName = PUBLIC_HEALTH_DEPARTMENTS[departmentKey] ?? resolvedName;
        }

        if (!cancelled) {
          setDepartmentName(resolvedName);
          const staffResponse = await apiService.getAcademicStaffs(apiSchool, resolvedName);
          if (!cancelled) {
            setStaffs(staffResponse.success ? staffResponse.data : []);
          }
        }
      } catch (err) {
        if (!cancelled) {
          console.error(err);
          setError('Unable to load department staff at this time.');
        }
      } finally {
        if (!cancelled) {
          setLoading(false);
        }
      }
    }

    loadDepartmentStaff();
    return () => { cancelled = true; };
  }, [school, departmentKey]);

  const filteredStaffs = useMemo(() => {
    const normalizedSearch = search.trim().toLowerCase();
    if (!normalizedSearch) return staffs;
    return staffs.filter((staff) =>
      staff.full_name.toLowerCase().includes(normalizedSearch) ||
      staff.position.toLowerCase().includes(normalizedSearch) ||
      (staff.department ?? '').toLowerCase().includes(normalizedSearch)
    );
  }, [search, staffs]);

  const backTarget = school === 'public-health'
    ? '/academics/public-health/departments'
    : school === 'nursing'
      ? '/academics/nursing/departments'
      : '/academics/medicine/departments';

  return (
    <div className="department-staffs-page">
      <section className="department-staffs-hero">
        <div className="department-staffs-hero-inner container">
          <button className="dept-page-back" onClick={() => navigate(backTarget)}>← Back to Departments</button>
          <div>
            <span className="dept-page-badge">Department Staff</span>
            <h1>{departmentName}</h1>
            <p>Search and explore all academic staff uploaded for this department.</p>
          </div>
        </div>
      </section>

      <div className="department-staffs-content container">
        <div className="staffs-search-row">
          <div className="staffs-search-control">
            <label htmlFor="staff-search">Search department staff</label>
            <input
              id="staff-search"
              type="text"
              placeholder="Search by name, position, department..."
              value={search}
              onChange={(event) => setSearch(event.target.value)}
            />
          </div>
          <div className="staffs-summary">
            <span>{loading ? 'Loading...' : `${filteredStaffs.length} staff member${filteredStaffs.length === 1 ? '' : 's'}`}</span>
          </div>
        </div>

        {error && <div className="staffs-empty staffs-error">{error}</div>}

        {loading ? (
          <div className="staffs-grid">
            {Array.from({ length: 6 }).map((_, index) => (
              <div key={index} className="staff-card staff-card--skeleton" />
            ))}
          </div>
        ) : filteredStaffs.length === 0 ? (
          <div className="staffs-empty">No staff members found for this department.</div>
        ) : (
          <div className="staffs-grid">
            {filteredStaffs.map((staff) => {
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
                      <div className="staff-img-placeholder">{staff.full_name.charAt(0).toUpperCase()}</div>
                    )}
                  </div>
                  <div className="staff-info">
                    <h3 className="staff-name">{staff.full_name}</h3>
                    <p className="staff-position">{staff.position}</p>
                    {staff.department && <p className="staff-dept">{staff.department}</p>}
                    {staff.qualification && <p className="staff-qual">{staff.qualification}</p>}
                    {staff.biography && (
                      <p className="staff-bio">{staff.biography.slice(0, 120)}{staff.biography.length > 120 ? '…' : ''}</p>
                    )}
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
