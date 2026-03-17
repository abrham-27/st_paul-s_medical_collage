import React, { useState, useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import './MissionVisionValues.css';

const MissionVisionValues: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  const location = useLocation();
  const [activeTab, setActiveTab] = useState<'mission' | 'vision' | 'values'>('mission');

  useEffect(() => {
    const path = location.pathname;
    if (path.includes('mission')) setActiveTab('mission');
    else if (path.includes('vision')) setActiveTab('vision');
    else if (path.includes('values')) setActiveTab('values');
  }, [location.pathname]);

  const renderContent = () => {
    switch (activeTab) {
      case 'mission':
        return (
          <div className="mvv-card fade-in">
            <div className="card-icon-large">🎯</div>
            <h2>Our Mission</h2>
            <div className="card-divider"></div>
            <p className="primary-statement">
              The College’s mission is to provide comprehensive healthcare services, teach high quality medical and health sciences education, conduct problem solving research of public health significance and meet the needs of the communities.
            </p>
          </div>
        );
      case 'vision':
        return (
          <div className="mvv-card fade-in">
            <div className="card-icon-large">🔭</div>
            <h2>Our Vision</h2>
            <div className="card-divider"></div>
            <p className="primary-statement">
              To be a center of excellence in specialized healthcare, postgraduate education, and high level evidence generating research undertaking.
            </p>
            
            <div className="goal-section">
              <h3>Goal</h3>
              <p>
                The goal of this strategic plan is to have doable strategies which finally result in quality health service delivery, quality health education, problem solving research undertaking and focused community service provision.
              </p>
            </div>
          </div>
        );
      case 'values':
        return (
          <div className="mvv-card values-layout fade-in">
            <div className="values-header">
              <div className="card-icon-large">⭐</div>
              <h2>Core Values</h2>
              <div className="card-divider"></div>
              <p className="primary-statement">
                The faculty, staff, and students in the College of Health Professions at the SPHMMC embrace and commit to the 5 core values of collaboration, creativity, diversity, excellence, and integrity.
              </p>
              <p className="sub-statement">
                The following represents sample expected behaviors that demonstrate adherence to each core value.
              </p>
            </div>

            <div className="values-grid">
              <div className="value-item">
                <div className="value-icon">🤝</div>
                <h3>Collaboration</h3>
                <ul>
                  <li>Cultivate relationships built on trust and respect.</li>
                  <li>Recognize and value the skills and qualities of others.</li>
                  <li>Engage in interprofessional education, research, service, and clinical practice.</li>
                  <li>Involve stakeholders in our local and global communities to achieve shared objectives.</li>
                </ul>
              </div>

              <div className="value-item">
                <div className="value-icon">💡</div>
                <h3>Creativity</h3>
                <ul>
                  <li>Encourage and support innovation, ingenuity, and resourcefulness.</li>
                  <li>Apply new ideas and technology to improve education, research, and clinical practice.</li>
                  <li>Manage the risk associated with innovation.</li>
                  <li>Embrace and drive change that results from innovation and creativity.</li>
                </ul>
              </div>

              <div className="value-item">
                <div className="value-icon">🌍</div>
                <h3>Diversity</h3>
                <ul>
                  <li>Recognize the value of different perspectives and backgrounds.</li>
                  <li>Foster cultural awareness and empathy.</li>
                  <li>Create an environment that is welcoming to all.</li>
                  <li>Provide equal opportunities and services to all individuals.</li>
                </ul>
              </div>

              <div className="value-item">
                <div className="value-icon">🏆</div>
                <h3>Excellence</h3>
                <ul>
                  <li>Achieve the highest standards of performance and outcomes in education, research, service, and clinical practice.</li>
                  <li>Validate excellence through continuous quality improvement.</li>
                  <li>Accept personal responsibility to advance towards excellence.</li>
                  <li>Empower faculty, staff, and students to foster excellence.</li>
                </ul>
              </div>

              <div className="value-item">
                <div className="value-icon">⚖️</div>
                <h3>Integrity</h3>
                <ul>
                  <li>Adhere to the standards of conduct, policies, and procedures of the organization.</li>
                  <li>Acknowledge and accept responsibility for one’s actions.</li>
                  <li>Demonstrate honesty and transparency.</li>
                  <li>Use influence judiciously and treat people equitably.</li>
                </ul>
              </div>
            </div>
          </div>
        );
      default:
        return null;
    }
  };

  return (
    <div className="mvv-page">
      <div className="mvv-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to About</button>
          <h1>Mission, Vision & Values</h1>
          <p>The guiding principles that shape the future of SPHMMC</p>
        </div>
      </div>

      <div className="mvv-nav-bar">
        <div className="container">
          <div className="nav-tabs">
            <button 
              className={`tab-btn ${activeTab === 'mission' ? 'active' : ''}`}
              onClick={() => setActiveTab('mission')}
            >
              Mission
              <span className="full-name">Our Purpose</span>
            </button>
            <button 
              className={`tab-btn ${activeTab === 'vision' ? 'active' : ''}`}
              onClick={() => setActiveTab('vision')}
            >
              Vision
              <span className="full-name">Our Future</span>
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

      <section className="mvv-content-section container">
        {renderContent()}
      </section>
    </div>
  );
};

export default MissionVisionValues;
