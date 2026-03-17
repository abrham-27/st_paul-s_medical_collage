import React, { useState } from 'react';
import './AboutUs.css';

interface AboutUsProps {
  onBack: () => void;
}

const AboutUs: React.FC<AboutUsProps> = ({ onBack }) => {
  const [showWhy, setShowWhy] = useState(false);

  const specializedCenters = [
    {
      title: "Transplant Surgery",
      desc: "Home to Ethiopia's first and leading organ transplant center, performing life-saving kidney and liver transplants.",
      icon: "🫀"
    },
    {
      title: "Cardiac Center",
      desc: "Advanced cardiovascular care with state-of-the-art diagnostic and interventional services.",
      icon: "❤️"
    },
    {
      title: "Oncology Services",
      desc: "Comprehensive cancer care, including radiotherapy and chemotherapy with a focus on patient-centered outcomes.",
      icon: "🎗️"
    },
    {
      title: "Trauma & Emergency",
      desc: "A high-capacity trauma center providing 24/7 critical care to the most vulnerable patients.",
      icon: "🚑"
    }
  ];

  return (
    <div className="about-us-page">
      <div className="about-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Home</button>
          <h1>About SPHMMC</h1>
        </div>
      </div>

      <section className="about-content-section">
        <div className="container">
          <div className="welcome-banner modern-card">
            <div className="banner-content">
              <span className="section-label">Welcome</span>
              <h2>Excellence in Healthcare & Education</h2>
              <p className="welcome-text">
                Welcome to St. Paul’s Hospital Millennium Medical College (SPHMMC), a beacon of hope and innovation in healthcare and medical education in Ethiopia. Established to meet the nation’s growing demand for skilled medical professionals and advanced healthcare, SPHMMC is now a cornerstone of excellence in education, research, and specialized clinical services.
              </p>
              
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
                    <div className="why-item">
                      <h4>Unparalleled History</h4>
                      <p>From its origins as a referral hospital to its status as a premier teaching institution, SPHMMC embodies resilience and progress.</p>
                    </div>
                    <div className="why-item">
                      <h4>Advanced Facilities</h4>
                      <p>Equipped with the latest medical technologies, we address Ethiopia’s most complex healthcare challenges.</p>
                    </div>
                    <div className="why-item">
                      <h4>Impactful Research</h4>
                      <p>Focused on community needs, our research drives innovation and shapes policy.</p>
                    </div>
                    <div className="why-item">
                      <h4>Community-Centered Approach</h4>
                      <p>Our outreach programs ensure equitable healthcare access, particularly for underserved populations.</p>
                    </div>
                  </div>
                  <div className="closing-statement">
                    <p>At SPHMMC, we are not just shaping the future of healthcare in Ethiopia; we are setting a benchmark for excellence and equity. Join us as a student, partner, or supporter in our journey to transform lives and inspire change.</p>
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </section>

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

      <section className="vision-mission-simple">
        <div className="container">
          <div className="dual-cards">
            <div className="simple-card">
              <h3>Our Vision</h3>
              <p>To be the premier medical college and hospital in East Africa by 2030, recognized for excellence in patient care, teaching, and research.</p>
            </div>
            <div className="simple-card">
              <h3>Our Mission</h3>
              <p>To provide high-quality medical education, clinical services, and research that improves the health status of the Ethiopian people and beyond.</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default AboutUs;
