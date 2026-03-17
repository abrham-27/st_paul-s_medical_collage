import React, { useState } from 'react';
import './PublicHealthMissionVision.css';

const PublicHealthMissionVision: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  const [activeTab, setActiveTab] = useState<'mission' | 'vision' | 'values'>('mission');

  const renderContent = () => {
    switch (activeTab) {
      case 'mission':
        return (
          <div className="sph-mvv-card fade-in">
            <div className="card-icon-large">🎯</div>
            <h2>Mission</h2>
            <div className="card-divider"></div>
            <p className="sph-primary-statement">
              To advance the health of the people by developing and implementing innovative Public Health Education, research and community services through proposing interventions and health policies based on scientific knowledge and evidence.
            </p>
          </div>
        );
      case 'vision':
        return (
          <div className="sph-mvv-card fade-in">
            <div className="card-icon-large">🔭</div>
            <h2>Vision</h2>
            <div className="card-divider"></div>
            <p className="sph-primary-statement">
              Leader in the development of academic programs that are nationally and internationally recognized because of the impact of the innovative researches on health policy and interventions in Ethiopia by 2027/28.
            </p>
          </div>
        );
      case 'values':
        return (
          <div className="sph-mvv-card fade-in">
            <div className="card-icon-large">⭐</div>
            <h2>Values</h2>
            <div className="card-divider"></div>
            <div className="sph-values-list">
              <div className="sph-value-item">
                <span className="sph-value-icon">✓</span>
                <span>Quality first</span>
              </div>
              <div className="sph-value-item">
                <span className="sph-value-icon">🤝</span>
                <span>Customer driven</span>
              </div>
              <div className="sph-value-item">
                <span className="sph-value-icon">💡</span>
                <span>Innovation</span>
              </div>
              <div className="sph-value-item">
                <span className="sph-value-icon">⚖️</span>
                <span>Integrity</span>
              </div>
              <div className="sph-value-item">
                <span className="sph-value-icon">🌱</span>
                <span>Sustainability</span>
              </div>
              <div className="sph-value-item">
                <span className="sph-value-icon">📋</span>
                <span>Accountability</span>
              </div>
              <div className="sph-value-item">
                <span className="sph-value-icon">🔗</span>
                <span>Partnership</span>
              </div>
            </div>
          </div>
        );
      default:
        return null;
    }
  };

  return (
    <div className="sph-mvv-page">
      <div className="sph-mvv-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Academics</button>
          <span className="school-label">School of Public Health</span>
          <h1>Vision, Mission and Values</h1>
          <p>The guiding principles that shape the future of SPH</p>
        </div>
      </div>

      <div className="sph-mvv-nav-bar">
        <div className="container">
          <div className="nav-tabs">
            <button 
              className={`tab-btn ${activeTab === 'mission' ? 'active' : ''}`}
              onClick={() => setActiveTab('mission')}
            >
              Mission
              <span className="full-name">Our Core Purpose</span>
            </button>
            <button 
              className={`tab-btn ${activeTab === 'vision' ? 'active' : ''}`}
              onClick={() => setActiveTab('vision')}
            >
              Vision
              <span className="full-name">Our Future Direction</span>
            </button>
            <button 
              className={`tab-btn ${activeTab === 'values' ? 'active' : ''}`}
              onClick={() => setActiveTab('values')}
            >
              Values
              <span className="full-name">Our Principles</span>
            </button>
          </div>
        </div>
      </div>

      <section className="sph-mvv-content-section container">
        {renderContent()}
      </section>
    </div>
  );
};

export default PublicHealthMissionVision;
