import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { apiService, type AcademicPageData } from '../../services/api';
import { containsHtml } from '../../services/content';
import { sanitizeHtml } from '../../utils/richText';
import './PublicHealthDepartments.css';

type DeptKey = 'epidemiology' | 'health_management' | 'program';

const DEPT_PAGE_TYPES: Record<DeptKey, string> = {
  epidemiology:       'dept_epidemiology',
  health_management:  'dept_health_management',
  program:            'dept_program',
};

const DEPT_DEFAULTS: Record<DeptKey, { title: string; content: string; icon: string }> = {
  epidemiology: {
    icon: '📊',
    title: 'Department of Epidemiology',
    content: '<p>The Department of Epidemiology is dedicated to understanding the distribution and determinants of health and disease conditions in defined populations.</p><p>We focus on teaching rigorous methodological skills and conducting cutting-edge epidemiological research. Our goal is to provide evidence-based insights to shape public health policies and interventions in Ethiopia and beyond.</p>',
  },
  health_management: {
    icon: '⚕️',
    title: 'Department of Health Management, Promotion, Reproductive Health and Nutrition',
    content: '<p>A multidisciplinary department focusing on health systems, reproductive health, and nutritional well-being.</p><p>This department plays a critical role in addressing the multidimensional health challenges of the community. We train leaders in health management, implement health promotion strategies, and conduct extensive research in reproductive health and community nutrition.</p>',
  },
  program: {
    icon: '🎓',
    title: 'Academic Programs',
    content: '<p>The School of Public Health offers graduate-level training programs, including Master of Public Health (MPH) degrees in General Public Health, Field Epidemiology, Epidemiology, Nutrition, and Health Communication and Promotion. The school also offers doctoral programs in public health.</p>',
  },
};

const DEPT_NAMES: Record<DeptKey, string | null> = {
  epidemiology:      'Department of Epidemiology',
  health_management: 'Department of Health Management, Promotion, Reproductive Health and Nutrition',
  program:           null,
};

const PublicHealthDepartments: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  const navigate = useNavigate();
  const [activeSection, setActiveSection] = useState<DeptKey>('epidemiology');
  const [pages, setPages] = useState<Partial<Record<DeptKey, AcademicPageData | null>>>({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const keys = Object.keys(DEPT_PAGE_TYPES) as DeptKey[];
    Promise.all(
      keys.map(key =>
        apiService.getAcademicPage('public_health', DEPT_PAGE_TYPES[key])
          .then(res => ({ key, data: res.success ? res.data : null }))
          .catch(() => ({ key, data: null }))
      )
    ).then(results => {
      const map: Partial<Record<DeptKey, AcademicPageData | null>> = {};
      results.forEach(r => { map[r.key] = r.data; });
      setPages(map);
      setLoading(false);
    });
  }, []);

  const getContent = (key: DeptKey) => {
    const page = pages[key];
    const def = DEPT_DEFAULTS[key];
    return {
      title:         page?.title         || def.title,
      content:       page?.content       || def.content,
      featured_image: page?.featured_image ?? null,
      icon:          def.icon,
    };
  };

  const activeDepartmentName = DEPT_NAMES[activeSection];

  const renderContent = () => {
    if (loading) return <div className="sph-department-card fade-in"><p style={{ color: '#888' }}>Loading…</p></div>;
    const { title, content, featured_image, icon } = getContent(activeSection);
    return (
      <div className="sph-department-card fade-in">
        <div className="card-icon-large">{icon}</div>
        <h2>{title}</h2>
        <div className="card-divider"></div>
        {containsHtml(content) ? (
          <div className="sph-primary-statement" dangerouslySetInnerHTML={{ __html: sanitizeHtml(content) }} />
        ) : (
          <p className="sph-primary-statement">{content}</p>
        )}
        {featured_image && (
          <div style={{ marginTop: '1.5rem' }}>
            <img
              src={featured_image}
              alt={title}
              style={{ width: '100%', maxHeight: '360px', objectFit: 'cover', borderRadius: '10px' }}
            />
          </div>
        )}
      </div>
    );
  };

  return (
    <div className="sph-departments-page">
      <div className="sph-departments-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Academics</button>
          <span className="school-label">School of Public Health</span>
          <h1>Departments & Programs</h1>
          <p>Explore our specialized academic departments and comprehensive training programs.</p>
          {activeDepartmentName && (
            <button
              type="button"
              className="back-link"
              style={{ marginTop: '1rem', display: 'inline-block', fontSize: '1rem', padding: '0.85rem 1.4rem' }}
              onClick={() => navigate(`/academics/public-health/department-staffs/${activeSection}`)}
            >
              View Staffs
            </button>
          )}
        </div>
      </div>

      <div className="sph-departments-container container">
        <div className="sph-sidebar-nav">
          <h3>Browse By</h3>
          <ul className="sph-nav-list">
            {(Object.keys(DEPT_DEFAULTS) as DeptKey[]).map(key => (
              <li key={key}>
                <button
                  className={`sph-nav-btn ${activeSection === key ? 'active' : ''}`}
                  onClick={() => setActiveSection(key)}
                >
                  <span className="icon">{DEPT_DEFAULTS[key].icon}</span>
                  {pages[key]?.title || DEPT_DEFAULTS[key].title}
                </button>
              </li>
            ))}
          </ul>
        </div>

        <div className="sph-content-area">
          {renderContent()}
        </div>
      </div>
    </div>
  );
};

export default PublicHealthDepartments;
