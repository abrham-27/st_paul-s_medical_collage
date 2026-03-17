import React from 'react';
import './PublicHealthAbout.css';

const PublicHealthAbout: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  return (
    <div className="sph-about-page">
      <div className="sph-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Academics</button>
          <span className="school-label">School of Public Health (SPH)</span>
          <h1>About Our School</h1>
        </div>
      </div>

      <div className="sph-content-wrapper container">
        <div className="sph-main-content fade-in">
          
          <section className="sph-section">
            <div className="section-icon">🏥</div>
            <h2>Background of School of Public Health</h2>
            <p className="lead-text">
              The School of Public Health (SPH) is one of the schools under Saint Paul’s Hospital Millennium Medical College (SPHMMC). SPH is one of the nation’s premier schools of public health, with a strong track record of outstanding research, teaching, and community service excellence and impact in a short period of time.
            </p>
            
            <div className="stats-banner">
              <div className="stat-item">
                <span className="stat-number">6</span>
                <span className="stat-label">Advanced Training Programs</span>
              </div>
              <div className="stat-item">
                <span className="stat-number">300+</span>
                <span className="stat-label">Graduates Across Disciplines</span>
              </div>
              <div className="stat-item">
                <span className="stat-number">350+</span>
                <span className="stat-label">Currently Enrolled Students</span>
              </div>
            </div>

            <p>
              Currently, the school runs five Master of Public Health training programs and one Ph.D. program. These include Master's degrees in Field Epidemiology, General Public Health, Nutrition, Epidemiology, and Health Communication and Promotion, alongside our Ph.D. program in Public Health.
            </p>
          </section>

          <section className="sph-section message-box alumni-message">
            <div className="message-header">
              <div className="section-icon">🎓</div>
              <h3>For Our Former Students</h3>
            </div>
            <p>
              Your thoughts and suggestions are truly helpful. Any comments regarding general or specific activities are much appreciated by the teaching staff. Our alumni’s continued involvement enriches the college in general and enhances our school's performance in particular.
            </p>
          </section>

          <section className="sph-section message-box new-students-message">
            <div className="message-header">
              <div className="section-icon">🌟</div>
              <h3>For Prospective & New Students</h3>
            </div>
            <p>
              In the 21st century, as the world faces long-term public health workforce challenges, there is no greater opportunity, responsibility, or commitment given to an individual than working as a public health professional.
            </p>
            <div className="highlight-quote">
              <p>
                "I promise that through our academic teaching programs combined with practical experience, research, and community service, SPHMMC School of Public Health will give you the knowledge and abilities you need to thrive in the rapidly changing global environment."
              </p>
            </div>
            <p className="browse-encouragement">
              To find out more about our School of Public Health, our highly qualified professors, our research activities, and our competitive degree programs, we encourage you to browse our website. If you would like to visit the office or if you have any additional questions, don’t hesitate to get in touch with us directly.
            </p>
          </section>

        </div>
        
        <div className="sph-sidebar fade-in-up">
          <div className="sidebar-widget">
            <h3>Quick Actions</h3>
            <ul className="action-links">
              <li><a href="#">Academic Calendar ↗</a></li>
              <li><a href="#">Apply for Admission ↗</a></li>
              <li><a href="#">Research Guidelines ↗</a></li>
              <li><a href="#">Student Handbook ↗</a></li>
            </ul>
          </div>
          
          <div className="sidebar-widget contact-widget">
            <h3>Contact Us</h3>
            <p>Need more information about SPH programs?</p>
            <button className="btn btn-primary-gold w-100">Get In Touch</button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default PublicHealthAbout;
