import React, { useState, useEffect } from 'react';
import './AboutUs.css';
import { apiService, type AboutPage } from '../services/api';
import { sanitizeHtml } from '../utils/richText';

interface WhyItem { title: string; desc: string; }
interface SpecializedCenter { title: string; desc: string; icon: string; }
interface AdditionalContent {
  why_items?: WhyItem[];
  specialized_centers?: SpecializedCenter[];
}

interface AboutUsProps {
  onBack: () => void;
}

const AboutUs: React.FC<AboutUsProps> = ({ onBack }) => {
  const [showWhy, setShowWhy] = useState(true); // Show by default since we have content
  const [about, setAbout] = useState<AboutPage | null>(null);
  const [mission, setMission] = useState<string>('');
  const [vision, setVision] = useState<string>('');
  const [additional, setAdditional] = useState<AdditionalContent>({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [aboutRes, mvRes] = await Promise.allSettled([
          apiService.getAboutPage(),
          apiService.getMissionVisionValues(),
        ]);
        
        if (aboutRes.status === 'fulfilled' && aboutRes.value?.success) {
          const data = aboutRes.value.data;
          setAbout(data);
          
          if (data?.additional_content) {
            try {
              // If it's already an object (parsed by backend), use it directly
              // If it's still a string, parse it
              let parsed;
              if (typeof data.additional_content === 'object') {
                parsed = data.additional_content;
              } else {
                parsed = JSON.parse(data.additional_content);
              }
              setAdditional(parsed || {});
            } catch (e) { 
              console.warn('Failed to parse additional_content:', e);
              setAdditional({}); 
            }
          }
        } else {
          console.error('Failed to fetch about page:', aboutRes);
        }
        
        if (mvRes.status === 'fulfilled' && mvRes.value?.success) {
          const mvData = mvRes.value.data;
          if (mvData?.mission?.description) setMission(mvData.mission.description);
          if (mvData?.vision?.description) setVision(mvData.vision.description);
        } else {
          console.error('Failed to fetch mission/vision:', mvRes);
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      } finally {
        setLoading(false);
      }
    };
    
    fetchData();
  }, []);

  if (loading) {
    return (
      <div className="about-us-page">
        <div className="about-header">
          <div className="container">
            <button className="back-link" onClick={onBack}>← Back to Home</button>
            <h1>About SPHMMC</h1>
          </div>
        </div>
        <div style={{ padding: '4rem', textAlign: 'center', color: '#888' }}>Loading…</div>
      </div>
    );
  }

  const whyItems: WhyItem[] = additional.why_items ?? [];
  const specializedCenters: SpecializedCenter[] = additional.specialized_centers ?? [];

  return (
    <div className="about-us-page">
      <div className="about-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Home</button>
          <h1>{about?.page_title}</h1>
        </div>
      </div>

      <section className="about-content-section">
        <div className="container">
          <div className="welcome-banner modern-card">
            <div className="banner-content">
              <span className="section-label">Welcome</span>
              <h2>{about?.subtitle}</h2>
              {about?.featured_image_url && (
                <div style={{ margin: '1.5rem 0' }}>
                  <img src={about.featured_image_url} alt="About SPHMMC"
                       style={{ width: '100%', maxHeight: '400px', objectFit: 'cover', borderRadius: '12px' }} />
                </div>
              )}
              {about?.main_description && (
                <div
                  className="welcome-text"
                  dangerouslySetInnerHTML={{ __html: sanitizeHtml(about.main_description) }}
                />
              )}
              
              {about?.history_text && (
                <div
                  className="history-text"
                  style={{ marginTop: '1.5rem' }}
                  dangerouslySetInnerHTML={{ __html: sanitizeHtml(about.history_text) }}
                />
              )}

              {whyItems.length > 0 && (
                <>
                  <div className="action-link-container">
                    <button
                      className={`why-link ${showWhy ? 'active' : ''}`}
                      onClick={() => setShowWhy(!showWhy)}
                    >
                      Why SPHMMC? {showWhy ? '▾' : '▸'}
                    </button>
                  </div>

                  {showWhy && (
                    <div className="why-content-expanded fade-in">
                      <div className="why-grid">
                        {whyItems.map((item, i) => (
                          <div key={i} className="why-item">
                            <h4>{item.title}</h4>
                            <p>{item.desc}</p>
                          </div>
                        ))}
                      </div>
                    </div>
                  )}
                </>
              )}
            </div>
          </div>
        </div>
      </section>

      {specializedCenters.length > 0 && (
        <section className="specialized-spaces">
          <div className="container">
            <div className="section-title">
              <span className="label">Our Expertise</span>
              <h2>Specialized Centers of Excellence</h2>
              <p>We take pride in our highly specialized clinical departments that lead the nation in medical innovation.</p>
            </div>

            <div className="specialized-grid">
              {specializedCenters.map((center, index) => (
                <div key={index} className="specialized-card">
                  <div className="card-icon">{center.icon}</div>
                  <h3>{center.title}</h3>
                  <p>{center.desc}</p>
                  <div className="card-footer">
                    <span className="status-badge">National Leader</span>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </section>
      )}

      {(vision || mission) && (
        <section className="vision-mission-simple">
          <div className="container">
            <div className="dual-cards">
              {vision && (
                <div className="simple-card">
                  <h3>Our Vision</h3>
                  <p>{vision}</p>
                </div>
              )}
              {mission && (
                <div className="simple-card">
                  <h3>Our Mission</h3>
                  <p>{mission}</p>
                </div>
              )}
            </div>
          </div>
        </section>
      )}
    </div>
  );
};

export default AboutUs;
