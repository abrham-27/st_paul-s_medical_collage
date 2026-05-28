import { type JSX, useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import {
    apiService,
    type MedicineDepartmentDetail,
    type MedicineSubDepartment,
} from '../../services/api';
import './Departments.css';

interface DepartmentDetailProps {
    slug: string;
    onBack: () => void;
}

function normalizeSubDepartments(data: MedicineDepartmentDetail): MedicineSubDepartment[] {
    const subs = data.sub_departments ?? (data as { subDepartments?: MedicineSubDepartment[] }).subDepartments;
    return Array.isArray(subs) ? subs : [];
}

function DeptPageShell({
    onBack,
    children,
}: {
    onBack: () => void;
    children: React.ReactNode;
}): JSX.Element {
    return (
        <div className="dept-page">
            <div className="container">
                <button type="button" className="back-btn" onClick={onBack}>
                    ← Back to Departments
                </button>
                {children}
            </div>
        </div>
    );
}

export default function DepartmentDetail({ slug, onBack }: DepartmentDetailProps): JSX.Element {
    const [departmentData, setDepartmentData] = useState<MedicineDepartmentDetail | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const navigate = useNavigate();

    useEffect(() => {
        fetchDepartmentData();
    }, [slug]);

    const fetchDepartmentData = async () => {
        try {
            setLoading(true);
            setError(null);
            const response = await apiService.getMedicineDepartment(slug);
            
            if (response && response.id) {
                setDepartmentData(response);
            } else if (response && (response as { success?: boolean }).success) {
                setDepartmentData((response as { data: MedicineDepartmentDetail }).data);
            } else {
                setError('Failed to load department data');
            }
        } catch (err) {
            setError('Error fetching department data');
            console.error(err);
        } finally {
            setLoading(false);
        }
    };

    if (loading) {
        return (
            <DeptPageShell onBack={onBack}>
                    <div className="loading">Loading department data...</div>
            </DeptPageShell>
        );
    }

    if (error) {
        return (
            <DeptPageShell onBack={onBack}>
                    <div className="error">{error}</div>
            </DeptPageShell>
        );
    }

    if (!departmentData) {
        return (
            <DeptPageShell onBack={onBack}>
                    <div className="error">Department not found</div>
            </DeptPageShell>
        );
    }

    const subDepartments = normalizeSubDepartments(departmentData);

    return (
        <DeptPageShell onBack={onBack}>
                <header className="dept-header">
                    <span className="dept-tag">School of Medicine</span>
                    <h1>{departmentData.name}</h1>
                <p className="intro"
                   dangerouslySetInnerHTML={{ __html: departmentData.description || 'Department details and academic structure.' }}
                />
                <button
                    type="button"
                    className="back-btn"
                    onClick={() => navigate(`/academics/medicine/staffs`)}
                    style={{ marginTop: '1rem', fontSize: '1rem', padding: '0.85rem 1.4rem' }}
                >
                    View Department Staffs →
                </button>
                </header>
                
            <section className="sub-dept-section">
                <h2 className="sub-dept-section-title">Sub-Departments</h2>
                <p className="sub-dept-section-hint">
                    Select a sub-department to view its dedicated page and academic units.
                </p>

                <div className="sub-dept-links-list">
                    {subDepartments.map((subDept) => (
                        <Link
                            key={subDept.id}
                            to={`/academics/medicine/departments/${slug}/sub/${subDept.id}`}
                            className="sub-dept-link"
                        >
                            <span className="sub-dept-link-icon">{subDept.icon || '🔬'}</span>
                            <span className="sub-dept-link-text">
                                <span className="sub-dept-link-name">{subDept.name}</span>
                                {subDept.description && (
                                    <span
                                        className="sub-dept-link-desc"
                                        dangerouslySetInnerHTML={{ __html: subDept.description }}
                                    />
                                )}
                            </span>
                            <span className="sub-dept-link-arrow" aria-hidden="true">
                                →
                            </span>
                        </Link>
                    ))}
                </div>
            </section>
        </DeptPageShell>
    );
}
