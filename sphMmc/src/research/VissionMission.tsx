import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './VissionMission.css'

function ResearchVissionMission(): JSX.Element {
  const navigate = useNavigate()
  const [scrolled, setScrolled] = useState(false)
  useEffect(() => {
    const h = () => setScrolled(window.scrollY > 10)
    window.addEventListener('scroll', h)
    return () => window.removeEventListener('scroll', h)
  }, [])

  return (
    <div className="rp-page">
      <header className={`rp-header${scrolled ? ' scrolled' : ''}`}>
        <div className="rp-header-inner">
          <button className="rp-back" onClick={() => navigate('/')}>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Home
          </button>
          <h1 className="rp-header-title">Vision &amp; Mission</h1>
        </div>
      </header>

      <main className="rp-main">
        <div className="rp-content">

          {/* Hero */}
          <div className="rp-hero">
            <div className="rp-badge">
              <span>🎯</span><span>Our Direction</span>
            </div>
            <h2 className="rp-hero-title">Shaping the Future of Healthcare in Africa</h2>
            <p className="rp-hero-desc">Guided by our vision and mission, we strive to transform healthcare delivery, medical education, and research excellence across the continent.</p>
          </div>

          {/* Vision */}
          <section className="rp-section rp-section--navy">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">👁️</span>
              <h2 className="rp-sec-title rp-sec-title--white">Our Vision</h2>
              <div className="rp-underline rp-underline--gold"></div>
            </div>
            <div className="rp-vision-card">
              <div className="rp-vision-year">2030 G.C.</div>
              <div className="rp-vision-text">
                <h3>To be a sought-after medical center and a prestigious academic and research center in Africa by 2030 G.C.</h3>
              </div>
              <div className="rp-vision-pillars">
                <div className="rp-pillar-item"><div className="rp-pillar-icon">🏥</div><div><div className="rp-pillar-h4">Sought-After Medical Center</div><p className="rp-pillar-p">Excellence in patient care and clinical services</p></div></div>
                <div className="rp-pillar-item"><div className="rp-pillar-icon">🎓</div><div><div className="rp-pillar-h4">Prestigious Academic Center</div><p className="rp-pillar-p">Leading medical education and training</p></div></div>
                <div className="rp-pillar-item"><div className="rp-pillar-icon">🔬</div><div><div className="rp-pillar-h4">Research Excellence</div><p className="rp-pillar-p">Innovative research driving healthcare advancement</p></div></div>
              </div>
            </div>
          </section>

          {/* Mission */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🎯</span>
              <h2 className="rp-sec-title">Our Mission</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-quote">
              <blockquote>"To provide quality and affordable curative, rehabilitative, preventive, and promotive healthcare services and train competent, compassionate and ethical health professionals using integrated and quality medical education, and to perform need-based research."</blockquote>
            </div>
            <div className="rp-sub-title">Core Mission Pillars</div>
            <div className="rp-pillars-grid">
              <div className="rp-pillar-card"><div className="rp-pillar-head"><div className="rp-pillar-head-icon">🏥</div><h4>Quality Healthcare Services</h4></div><ul className="rp-pillar-list"><li>Curative services</li><li>Rehabilitative care</li><li>Preventive medicine</li><li>Promotive healthcare</li><li>Affordable access for all</li></ul></div>
              <div className="rp-pillar-card"><div className="rp-pillar-head"><div className="rp-pillar-head-icon">👨‍⚕️</div><h4>Professional Training</h4></div><ul className="rp-pillar-list"><li>Competent healthcare professionals</li><li>Compassionate patient care</li><li>Ethical medical practice</li><li>Integrated medical education</li><li>Quality training programs</li></ul></div>
              <div className="rp-pillar-card"><div className="rp-pillar-head"><div className="rp-pillar-head-icon">🔬</div><h4>Research Excellence</h4></div><ul className="rp-pillar-list"><li>Need-based research focus</li><li>Clinical research integration</li><li>Evidence-based practice</li><li>Innovation in healthcare</li><li>Community health solutions</li></ul></div>
            </div>
            <div className="rp-sub-title">Our Impact Areas</div>
            <div className="rp-impact-grid">
              <div className="rp-impact-item"><div className="rp-impact-num">50K+</div><div className="rp-impact-label">Patients Served Annually</div></div>
              <div className="rp-impact-item"><div className="rp-impact-num">2000+</div><div className="rp-impact-label">Students Trained</div></div>
              <div className="rp-impact-item"><div className="rp-impact-num">150+</div><div className="rp-impact-label">Research Projects</div></div>
              <div className="rp-impact-item"><div className="rp-impact-num">37</div><div className="rp-impact-label">Medical Specialties</div></div>
            </div>
          </section>

          {/* Values */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">💎</span>
              <h2 className="rp-sec-title">Our Values</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-values-grid">
              <div className="rp-value-card"><div className="rp-value-icon">⭐</div><h3>Excellence</h3><p>Committed to the highest standards in healthcare, education, and research</p></div>
              <div className="rp-value-card"><div className="rp-value-icon">❤️</div><h3>Compassion</h3><p>Caring for patients with empathy, dignity, and respect</p></div>
              <div className="rp-value-card"><div className="rp-value-icon">⚖️</div><h3>Integrity</h3><p>Upholding ethical principles in all our endeavors</p></div>
              <div className="rp-value-card"><div className="rp-value-icon">🤝</div><h3>Collaboration</h3><p>Working together to achieve better health outcomes</p></div>
              <div className="rp-value-card"><div className="rp-value-icon">💡</div><h3>Innovation</h3><p>Embracing creativity and new approaches to healthcare challenges</p></div>
              <div className="rp-value-card"><div className="rp-value-icon">🌍</div><h3>Social Responsibility</h3><p>Serving our community and contributing to societal development</p></div>
            </div>
          </section>

          {/* Priorities */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🗺️</span>
              <h2 className="rp-sec-title">Strategic Priorities</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-priority-grid">
              <div className="rp-priority-item"><div className="rp-priority-icon">🏥</div><div><h3>Healthcare Excellence</h3><p>Enhance clinical services and patient care quality</p></div></div>
              <div className="rp-priority-item"><div className="rp-priority-icon">🎓</div><div><h3>Educational Innovation</h3><p>Modernize curriculum and teaching methodologies</p></div></div>
              <div className="rp-priority-item"><div className="rp-priority-icon">🔬</div><div><h3>Research Advancement</h3><p>Expand research capacity and output</p></div></div>
              <div className="rp-priority-item"><div className="rp-priority-icon">🌍</div><div><h3>Community Impact</h3><p>Strengthen community engagement and service</p></div></div>
            </div>
          </section>

          {/* CTA */}
          <section className="rp-section rp-section--cta">
            <div className="rp-cta-inner">
              <h2>Join Us in Our Mission</h2>
              <p>Together, we can transform healthcare and make a lasting impact on communities across Africa.</p>
              <div className="rp-cta-btns">
                <button className="rp-btn-primary">Partner With Us</button>
                <button className="rp-btn-secondary">Support Our Mission</button>
              </div>
            </div>
          </section>

        </div>
      </main>
    </div>
  )
}

export default ResearchVissionMission
