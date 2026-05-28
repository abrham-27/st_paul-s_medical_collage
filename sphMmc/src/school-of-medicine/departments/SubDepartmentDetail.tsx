import { type JSX, useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import {
    apiService,
    type MedicineSubDepartmentDetail,
    type AcademicUnit,
} from '../../services/api';
import './Departments.css';

interface SubDepartmentDetailProps {
    onBack: (deptSlug: string) => void;
}

function normalizeAcademicUnits(
    fromSubDept: MedicineSubDepartmentDetail | null,
    fromUnitsEndpoint: AcademicUnit[]
): AcademicUnit[] {
    if (fromUnitsEndpoint.length > 0) return fromUnitsEndpoint;

    if (!fromSubDept) return [];

    const units =
        fromSubDept.academic_units ??
        (fromSubDept as { academicUnits?: AcademicUnit[] }).academicUnits;
    return Array.isArray(units) ? units : [];
}

export default function SubDepartmentDetail({ onBack }: SubDepartmentDetailProps): JSX.Element {
    const { deptSlug = '', subDeptId = '' } = useParams<{ deptSlug: string; subDeptId: string }>();
    const subDepartmentId = Number(subDeptId);

    const [subDepartment, setSubDepartment] = useState<MedicineSubDepartmentDetail | null>(null);
    const [academicUnits, setAcademicUnits] = useState<AcademicUnit[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        if (!subDepartmentId || Number.isNaN(subDepartmentId)) {
            setError('Invalid sub-department.');
            setLoading(false);
            return;
        }

        const fetchData = async () => {
            try {
                setLoading(true);
                setError(null);

                const [subDeptResponse, unitsResponse] = await Promise.all([
                    apiService.getMedicineSubDepartment(subDepartmentId),
                    apiService.getMedicineAcademicUnits(subDepartmentId),
                ]);

                setSubDepartment(subDeptResponse);
                setAcademicUnits(normalizeAcademicUnits(subDeptResponse, unitsResponse));
            } catch (err) {
                setError('Unable to load sub-department data.');
                console.error(err);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [subDepartmentId]);

    return (
        <div className="dept-page">
            <div className="container">
                <button type="button" className="back-btn" onClick={() => onBack(deptSlug)}>
                    ← Back to Department
                </button>

                {loading && <div className="loading">Loading sub-department...</div>}
                {error && <div className="error">{error}</div>}

                {!loading && !error && subDepartment && (
                    <>
                        <header className="dept-header sub-dept-page-header">
                            <span className="dept-tag">School of Medicine</span>
                            <h1>{subDepartment.name}</h1>
                            <p className="intro"
                               dangerouslySetInnerHTML={{ __html: subDepartment.description || 'Academic units and programs within this sub-department.' }}
                            />
                        </header>

                        <section className="academic-units-page-section">
                            <div className="academic-units-page-intro">
                                <h2>Academic Units</h2>
                                <p>
                                    Academic units under {subDepartment.name}, as registered in the
                                    School of Medicine structure.
                                </p>
                            </div>

                            {academicUnits.length === 0 ? (
                                <div className="academic-units-empty">
                                    No academic units are listed for this sub-department yet.
                                </div>
                            ) : (
                                <div className="academic-units-grid academic-units-page-grid">
                                    {academicUnits.map((unit) => (
                                        <article key={unit.id} className="academic-unit-card">
                                            <div className="academic-unit-card-accent" />
                                            <h4>{unit.name}</h4>
                                            <div
                                                dangerouslySetInnerHTML={{ __html: unit.description || 'Academic unit within this sub-department.' }}
                                            />
                                        </article>
                                    ))}
                                </div>
                            )}
                        </section>
                    </>
                )}
            </div>
        </div>
    );
}
