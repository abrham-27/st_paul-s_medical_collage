import React, { useState } from 'react';
import './PublicHealthDepartments.css';

const PublicHealthDepartments: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  const [activeSection, setActiveSection] = useState<string>('epidemiology');

  const renderContent = () => {
    switch(activeSection) {
      case 'epidemiology':
         return (
           <div className="sph-department-card fade-in">
             <div className="card-icon-large">📊</div>
             <h2>Department of Epidemiology</h2>
             <div className="card-divider"></div>
             <p className="sph-primary-statement">
               The Department of Epidemiology is dedicated to understanding the distribution and determinants of health and disease conditions in defined populations. 
             </p>
             <div className="sph-department-details">
                <p>We focus on teaching rigorous methodological skills and conducting cutting-edge epidemiological research. Our goal is to provide evidence-based insights to shape public health policies and interventions in Ethiopia and beyond.</p>
             </div>
           </div>
         );
      case 'health_management_nutrition':
        return (
          <div className="sph-department-card fade-in">
             <div className="card-icon-large">⚕️</div>
             <h2>Department of Health Management, Promotion, Reproductive Health and Nutrition</h2>
             <div className="card-divider"></div>
             <p className="sph-primary-statement">
               A multidisciplinary department focusing on health systems, reproductive health, and nutritional well-being.
             </p>
             <div className="sph-department-details">
                <p>This department plays a critical role in addressing the multidimensional health challenges of the community. We train leaders in health management, implement health promotion strategies, and conduct extensive research in reproductive health and community nutrition.</p>
             </div>
           </div>
        );
      case 'program':
        return (
           <div className="sph-department-card fade-in">
             <div className="card-icon-large">🎓</div>
             <h2>Academic Programs</h2>
             <div className="card-divider"></div>
             <p className="sph-primary-statement">
               The School of Public Health offers graduate-level training programs, including Master of Public Health (MPH) degrees in General Public Health, Field Epidemiology, Epidemiology, Nutrition, and Health Communication and Promotion. The school also offers doctoral programs in public health.
             </p>
             <div className="sph-program-tags">
                <span className="program-tag">MPH in General Public Health</span>
                <span className="program-tag">MPH in Field Epidemiology</span>
                <span className="program-tag">MPH in Epidemiology</span>
                <span className="program-tag">MPH in Nutrition</span>
                <span className="program-tag">MPH in Health Communication and Promotion</span>
                <span className="program-tag highlight">PhD in Public Health</span>
             </div>
           </div>
        );
      default: return null;
    }
  }

  return (
    <div className="sph-departments-page">
      <div className="sph-departments-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Academics</button>
          <span className="school-label">School of Public Health</span>
          <h1>Departments & Programs</h1>
          <p>Explore our specialized academic departments and comprehensive training programs.</p>
        </div>
      </div>

      <div className="sph-departments-container container">
        <div className="sph-sidebar-nav">
          <h3>Browse By</h3>
          <ul className="sph-nav-list">
            <li>
              <button 
                className={`sph-nav-btn ${activeSection === 'epidemiology' ? 'active' : ''}`}
                onClick={() => setActiveSection('epidemiology')}
              >
                <span className="icon">📊</span> Department of Epidemiology
              </button>
            </li>
            <li>
              <button 
                className={`sph-nav-btn ${activeSection === 'health_management_nutrition' ? 'active' : ''}`}
                onClick={() => setActiveSection('health_management_nutrition')}
              >
                <span className="icon">⚕️</span> Department of Health Management, Promotion, Reproductive Health and Nutrition
              </button>
            </li>
            <li>
              <button 
                className={`sph-nav-btn ${activeSection === 'program' ? 'active' : ''}`}
                onClick={() => setActiveSection('program')}
              >
                <span className="icon">🎓</span> Academic Programs
              </button>
            </li>
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
