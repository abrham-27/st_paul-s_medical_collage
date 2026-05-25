import React, { useState, useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import './Leaders.css';
import { apiService, type Leader } from '../services/api';

const Leaders: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  const location = useLocation();
  const [activeTab, setActiveTab] = useState<number | null>(null);
  const [, setExpandedInitiative] = useState<number | null>(null);
  const [, setShowOfficeDropdown] = useState<boolean>(false);
  const [leaders, setLeaders] = useState<Leader[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiService.getLeaders()
      .then(res => {
        setLeaders(res.data);
        if (res.data.length > 0) setActiveTab(res.data[0].id);
      })
      .catch(() => setLeaders([]))
      .finally(() => setLoading(false));
  }, []);

  // Sync tab from URL path (optional — keeps URL-based navigation working)
  useEffect(() => {
    if (leaders.length === 0) return;
    const path = location.pathname;
    const match = leaders.find(l =>
      path.toLowerCase().includes(l.full_name.split(' ')[0].toLowerCase())
    );
    if (match) setActiveTab(match.id);
  }, [location.pathname, leaders]);

  const activeLeader = leaders.find(l => l.id === activeTab) ?? leaders[0] ?? null;

  if (loading) {
    return (
      <div className="leaders-page">
        <div className="leaders-header">
          <div className="container">
            <button className="back-link" onClick={onBack}>← Back to About</button>
            <h1>Institutional Leadership</h1>
          </div>
        </div>
        <div style={{ textAlign: 'center', padding: '4rem', color: '#64748b' }}>
          Loading leaders...
        </div>
      </div>
    );
  }

  return (
    <div className="leaders-page">
      <div className="leaders-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to About</button>
          <h1>Institutional Leadership</h1>
          <p>Meet the visionary leaders steering SPHMMC towards a future of healthcare excellence.</p>
        </div>
      </div>

      <div className="leaders-nav-bar">
        <div className="container">
          <div className="nav-tabs">
            {leaders.map(leader => (
              <button
                key={leader.id}
                className={`tab-btn ${activeTab === leader.id ? 'active' : ''}`}
                onClick={() => {
                  setActiveTab(leader.id);
                  setExpandedInitiative(null);
                  setShowOfficeDropdown(false);
                }}
              >
                {leader.full_name.split(' ').slice(-1)}
                <span className="full-name">{leader.full_name}</span>
              </button>
            ))}
          </div>
        </div>
      </div>

      {activeLeader && (
        <section className="leader-profile-section container">
          <div className="profile-grid">
            {/* Image card */}
            <div className="profile-image-card fade-in">
              <div className="image-wrapper shadow-premium">
                {activeLeader.profile_image_url ? (
                  <img src={activeLeader.profile_image_url} alt={activeLeader.full_name} />
                ) : (
                  <div style={{
                    width: '100%', height: '100%', minHeight: '320px',
                    background: 'linear-gradient(135deg, #1e3a5f, #0ea5e9)',
                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                    fontSize: '5rem', color: 'white',
                  }}>
                    {activeLeader.full_name.charAt(0)}
                  </div>
                )}
                <div className="image-overlay"></div>
              </div>
              <div className="profile-meta">
                <span className="leader-prefix">
                  {activeLeader.qualification?.startsWith('MD') || activeLeader.qualification?.startsWith('PhD') ? 'Dr.' : 'Mr./Ms.'}
                </span>
                <h2 className="leader-name">{activeLeader.full_name}</h2>
                <p className="leader-title-sub">{activeLeader.position}</p>
                {activeLeader.qualification && (
                  <p style={{ fontSize: '0.85rem', color: '#94a3b8', marginTop: '0.25rem' }}>
                    {activeLeader.qualification}
                  </p>
                )}
              </div>
            </div>

            {/* Details card */}
            <div className="profile-details-card fade-in-up">
              <div className="bio-content">
                <h3>Biography</h3>
                <div className="bio-text">
                  {(activeLeader.biography ?? '').split('\n\n').map((para, i) => (
                    <p key={i}>{para.trim()}</p>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </section>
      )}

      <div className="leadership-footer-note container">
        <p>These leaders reflect a comprehensive approach to institutional development at SPHMMC, focusing on improving healthcare delivery, fostering academic growth, and enhancing professional excellence.</p>
      </div>
    </div>
  );
};

export default Leaders;
