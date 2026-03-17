import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './VissionMission.css'

function ResearchVissionMission(): JSX.Element {
  const navigate = useNavigate()

  const [scrolled, setScrolled] = useState(false)

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 10)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  return (
    <div className="research-vission-mission-page">
      {/* Header */}
      <header className={`research-header ${scrolled ? 'scrolled' : ''}`}>
        <div className="container">
          <div className="header-content">
            <button 
              className="back-button"
              onClick={() => navigate('/')}
              aria-label="Back to Home"
            >
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
              </svg>
              Back to Home
            </button>
            <div className="header-title">
              <h1>Vision & Mission</h1>
            </div>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="research-main-content">
        <div className="container">
          <div className="research-content">
            {/* Hero Section */}
            <section className="hero-section">
              <div className="hero-content">
                <div className="hero-badge">
                  <span className="badge-icon">🎯</span>
                  <span className="badge-text">Our Direction</span>
                </div>
                <h2 className="hero-title">Shaping the Future of Healthcare in Africa</h2>
                <p className="hero-description">
                  Guided by our vision and mission, we strive to transform healthcare delivery, 
                  medical education, and research excellence across the continent.
                </p>
              </div>
            </section>

            {/* Vision Section */}
            <section className="vision-section">
              <div className="section-header">
                <div className="section-icon">👁️</div>
                <h2>Our Vision</h2>
                <div className="section-underline"></div>
              </div>
              <div className="vision-content">
                <div className="vision-card">
                  <div className="vision-year">2030 G.C.</div>
                  <div className="vision-text">
                    <h3>To be a sought-after medical center and a prestigious academic and research center in Africa by 2030.G.C.</h3>
                  </div>
                  <div className="vision-pillars">
                    <div className="pillar-item">
                      <div className="pillar-icon">🏥</div>
                      <div className="pillar-text">
                        <h4>Sought-After Medical Center</h4>
                        <p>Excellence in patient care and clinical services</p>
                      </div>
                    </div>
                    <div className="pillar-item">
                      <div className="pillar-icon">🎓</div>
                      <div className="pillar-text">
                        <h4>Prestigious Academic Center</h4>
                        <p>Leading medical education and training</p>
                      </div>
                    </div>
                    <div className="pillar-item">
                      <div className="pillar-icon">🔬</div>
                      <div className="pillar-text">
                        <h4>Research Excellence</h4>
                        <p>Innovative research driving healthcare advancement</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Mission Section */}
            <section className="mission-section">
              <div className="section-header">
                <div className="section-icon">🎯</div>
                <h2>Our Mission</h2>
                <div className="section-underline"></div>
              </div>
              <div className="mission-content">
                <div className="mission-statement">
                  <div className="mission-quote">
                    <blockquote>
                      "To provide quality and affordable curative, rehabilitative, preventive, and promotive healthcare services and train competent, compassionate and ethical health professionals using integrated and quality medical education, and to perform need-based research."
                    </blockquote>
                  </div>
                </div>

                <div className="mission-pillars">
                  <h3>Core Mission Pillars</h3>
                  <div className="pillars-grid">
                    <div className="pillar-card">
                      <div className="pillar-header">
                        <div className="pillar-icon">🏥</div>
                        <h4>Quality Healthcare Services</h4>
                      </div>
                      <ul className="pillar-list">
                        <li>Curative services</li>
                        <li>Rehabilitative care</li>
                        <li>Preventive medicine</li>
                        <li>Promotive healthcare</li>
                        <li>Affordable access for all</li>
                      </ul>
                    </div>

                    <div className="pillar-card">
                      <div className="pillar-header">
                        <div className="pillar-icon">👨‍⚕️</div>
                        <h4>Professional Training</h4>
                      </div>
                      <ul className="pillar-list">
                        <li>Competent healthcare professionals</li>
                        <li>Compassionate patient care</li>
                        <li>Ethical medical practice</li>
                        <li>Integrated medical education</li>
                        <li>Quality training programs</li>
                      </ul>
                    </div>

                    <div className="pillar-card">
                      <div className="pillar-header">
                        <div className="pillar-icon">🔬</div>
                        <h4>Research Excellence</h4>
                      </div>
                      <ul className="pillar-list">
                        <li>Need-based research focus</li>
                        <li>Clinical research integration</li>
                        <li>Evidence-based practice</li>
                        <li>Innovation in healthcare</li>
                        <li>Community health solutions</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div className="mission-impact">
                  <h3>Our Impact Areas</h3>
                  <div className="impact-grid">
                    <div className="impact-item">
                      <div className="impact-number">50K+</div>
                      <div className="impact-label">Patients Served Annually</div>
                    </div>
                    <div className="impact-item">
                      <div className="impact-number">2000+</div>
                      <div className="impact-label">Students Trained</div>
                    </div>
                    <div className="impact-item">
                      <div className="impact-number">150+</div>
                      <div className="impact-label">Research Projects</div>
                    </div>
                    <div className="impact-item">
                      <div className="impact-number">37</div>
                      <div className="impact-label">Medical Specialties</div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Values Section */}
            <section className="values-section">
              <div className="section-header">
                <div className="section-icon">💎</div>
                <h2>Our Values</h2>
                <div className="section-underline"></div>
              </div>
              <div className="values-content">
                <div className="values-grid">
                  <div className="value-card">
                    <div className="value-icon">⭐</div>
                    <h3>Excellence</h3>
                    <p>Committed to the highest standards in healthcare, education, and research</p>
                  </div>
                  <div className="value-card">
                    <div className="value-icon">❤️</div>
                    <h3>Compassion</h3>
                    <p>Caring for patients with empathy, dignity, and respect</p>
                  </div>
                  <div className="value-card">
                    <div className="value-icon">⚖️</div>
                    <h3>Integrity</h3>
                    <p>Upholding ethical principles in all our endeavors</p>
                  </div>
                  <div className="value-card">
                    <div className="value-icon">🤝</div>
                    <h3>Collaboration</h3>
                    <p>Working together to achieve better health outcomes</p>
                  </div>
                  <div className="value-card">
                    <div className="value-icon">💡</div>
                    <h3>Innovation</h3>
                    <p>Embracing creativity and new approaches to healthcare challenges</p>
                  </div>
                  <div className="value-card">
                    <div className="value-icon">🌍</div>
                    <h3>Social Responsibility</h3>
                    <p>Serving our community and contributing to societal development</p>
                  </div>
                </div>
              </div>
            </section>

            {/* Strategic Priorities */}
            <section className="priorities-section">
              <div className="section-header">
                <div className="section-icon">🎯</div>
                <h2>Strategic Priorities</h2>
                <div className="section-underline"></div>
              </div>
              <div className="priorities-content">
                <div className="priority-timeline">
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-icon">🏥</div>
                    </div>
                    <div className="timeline-content">
                      <h3>Healthcare Excellence</h3>
                      <p>Enhance clinical services and patient care quality</p>
                    </div>
                  </div>
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-icon">🎓</div>
                    </div>
                    <div className="timeline-content">
                      <h3>Educational Innovation</h3>
                      <p>Modernize curriculum and teaching methodologies</p>
                    </div>
                  </div>
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-icon">🔬</div>
                    </div>
                    <div className="timeline-content">
                      <h3>Research Advancement</h3>
                      <p>Expand research capacity and output</p>
                    </div>
                  </div>
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-icon">🌍</div>
                    </div>
                    <div className="timeline-content">
                      <h3>Community Impact</h3>
                      <p>Strengthen community engagement and service</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Call to Action */}
            <section className="cta-section">
              <div className="cta-content">
                <h2>Join Us in Our Mission</h2>
                <p>Together, we can transform healthcare and make a lasting impact on communities across Africa.</p>
                <div className="cta-buttons">
                  <button className="cta-button primary">Partner With Us</button>
                  <button className="cta-button secondary">Support Our Mission</button>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>
    </div>
  )
}

export default ResearchVissionMission
