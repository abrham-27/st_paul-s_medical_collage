import { type JSX, useState, useEffect } from 'react';
import { apiService, type MedicineDepartment } from '../services/api';
import './DepartmentsLanding.css';

export default function DepartmentsLanding({ onBack, onSelect }: { onBack: () => void, onSelect: (id: string) => void }): JSX.Element {
    const [departments, setDepartments] = useState<MedicineDepartment[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        fetchDepartments();
    }, []);

    const fetchDepartments = async () => {
        try {
            setLoading(true);
            setError(null);
            const response = await apiService.getMedicineDepartments();
            if (Array.isArray(response)) {
                setDepartments(response);
            } else if (response && (response as any).success) {
                setDepartments((response as any).data);
            } else {
                setError('Failed to load departments');
            }
        } catch (err) {
            setError('Error fetching departments');
            console.error(err);
        } finally {
            setLoading(false);
        }
    };

    if (loading) {
        return (
            <div className="dept-landing-page">
                <div className="container">
                    <button className="back-btn" onClick={onBack}>← Back to Home</button>
                    <div className="loading">Loading departments...</div>
                </div>
            </div>
        );
    }

    if (error) {
        return (
            <div className="dept-landing-page">
                <div className="container">
                    <button className="back-btn" onClick={onBack}>← Back to Home</button>
                    <div className="error">{error}</div>
                </div>
            </div>
        );
    }

    return (
        <div className="dept-landing-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Home</button>
                <header className="header">
                    <h1>Medical College Departments</h1>
                    <p>Our academic structure is built upon these core pillars of medical knowledge and practice.</p>
                </header>

                <div className="categories-grid">
                    {departments.map(dept => (
                        <button key={dept.id} className="cat-card" onClick={() => onSelect(dept.slug)}>
                            <div className="icon">
                                {dept.icon && (dept.icon.includes('/') || dept.icon.includes('.')) ? (
                                    <img src={dept.icon.startsWith('http') ? dept.icon : `${import.meta.env.VITE_STORAGE_URL || 'http://127.0.0.1:8000/storage'}/${dept.icon}`} alt="" />
                                ) : (
                                    dept.icon || '🏥'
                                )}
                            </div>
                            <div className="info">
                                <h3>{dept.name}</h3>
                                <p>{dept.description || 'Department details'}</p>
                            </div>
                            <div className="arrow">↗</div>
                        </button>
                    ))}
                </div>
            </div>
        </div>
    );
}
