import React, { useState, useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import './MissionVisionValues.css';
import { sanitizeHtml } from '../utils/richText';

interface MissionVisionData {
  mission: { title: string; description: string } | null;
  vision: { title: string; description: string } | null;
  values: { id: number; title: string; description: string | null; icon: string | null; sort_order: number }[] | null;
}

const MissionVisionValues: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  const location = useLocation();
  const [activeTab, setActiveTab] = useState<'mission' | 'vision' | 'values'>('mission');
  const [openValue, setOpenValue] = useState<string | null>(null);
  const [data, setData] = useState<MissionVisionData | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const path = location.pathname;
    if (path.includes('mission')) setActiveTab('mission');
    else if (path.includes('vision')) setActiveTab('vision');
    else if (path.includes('values')) setActiveTab('values');
  }, [location.pathname]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        const response = await fetch('http://127.0.0.1:8000/api/mission-vision-values');
        const result = await response.json();
        if (result.success) {
          setData(result.data);
        } else {
          setError('Failed to load data');
        }
      } catch (err) {
        setError('Error fetching data');
        console.error('Error fetching mission vision values:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  const toggleValue = (name: string) => {
    setOpenValue(prev => (prev === name ? null : name));
  };

  const renderContent = () => {
    if (loading) {
      return (
        <div className="mvv-card fade-in">
          <p>Loading...</p>
        </div>
      );
    }

    if (error) {
      return (
        <div className="mvv-card fade-in">
          <p>Error: {error}</p>
        </div>
      );
    }

    switch (activeTab) {
      case 'mission':
        return (
          <div className="mvv-card fade-in">
            <div className="card-icon-large">🎯</div>
            <h2>{data?.mission?.title ?? 'Our Mission'}</h2>
            <div className="card-divider"></div>
            <div
              className="primary-statement"
              dangerouslySetInnerHTML={{ __html: sanitizeHtml(data?.mission?.description ?? 'No mission content available.') }}
            />
          </div>
        );
      case 'vision':
        return (
          <div className="mvv-card fade-in">
            <div className="card-icon-large">🔭</div>
            <h2>{data?.vision?.title ?? 'Our Vision'}</h2>
            <div className="card-divider"></div>
            <div
              className="primary-statement"
              dangerouslySetInnerHTML={{ __html: sanitizeHtml(data?.vision?.description ?? 'No vision content available.') }}
            />
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
                The faculty, staff, and students in the College of Health Professions at the SPHMMC embrace and commit to our core values.
              </p>
              <p className="sub-statement">Click a value to learn more.</p>
            </div>

            <div className="values-grid-wrapper">
              <div className="values-grid">
                {data?.values && data.values.length > 0 ? (
                  data.values.map((v) => {
                    const isOpen = openValue === v.title;
                    return (
                      <div key={v.id} className={`value-item${isOpen ? ' value-item--open' : ''}`}>
                        <button
                          className="value-trigger"
                          onClick={() => toggleValue(v.title)}
                          aria-expanded={isOpen}
                        >
                          <span className="value-icon">{v.icon ?? '⭐'}</span>
                          <span className="value-name">{v.title}</span>
                          <span className="value-chevron">{isOpen ? '▲' : '▼'}</span>
                        </button>
                        {isOpen && v.description && (
                          <div
                            className="value-list"
                            dangerouslySetInnerHTML={{ __html: sanitizeHtml(v.description) }}
                          />
                        )}
                      </div>
                    );
                  })
                ) : (
                  <p>No core values available.</p>
                )}
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
