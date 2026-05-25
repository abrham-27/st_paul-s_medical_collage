import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './Background.css'

function ResearchBackground(): JSX.Element {
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
          <h1 className="rp-header-title">Research Background</h1>
        </div>
      </header>

      <main className="rp-main">
        <div className="rp-content">

          <div className="rp-hero">
            <div className="rp-badge">Research &amp; Innovation</div>
            <h2 className="rp-hero-title">Research at SPHMMC</h2>
            <p className="rp-hero-desc">Advancing medical knowledge through rigorous, ethical, and impactful research that addresses Ethiopia's most pressing health challenges.</p>
          </div>

          {/* Mission & Vision */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🎯</span>
              <h2 className="rp-sec-title">Our Mission &amp; Vision</h2>
              <div className="rp-underline"></div>
            </div>
            <p className="rp-lead">Established in alignment with the medical college's mission to provide quality and affordable curative, rehabilitative, preventive, and promotive healthcare services and train competent, compassionate and ethical health professionals using integrated and quality medical education, and to perform need-based research.</p>
          </section>

          {/* Infrastructure */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🏗️</span>
              <h2 className="rp-sec-title">Research Infrastructure</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-stats-grid">
              <div className="rp-stat-card"><div className="rp-stat-num">6</div><div className="rp-stat-label">Full-time Researchers</div><div className="rp-stat-detail">Biomedical and public health backgrounds</div></div>
              <div className="rp-stat-card"><div className="rp-stat-num">200+</div><div className="rp-stat-label">Volunteer Reviewers</div><div className="rp-stat-detail">From 37+ fields of specialty</div></div>
              <div className="rp-stat-card"><div className="rp-stat-num">15</div><div className="rp-stat-label">IRB Members</div><div className="rp-stat-detail">Two-year terms with robust grant management</div></div>
              <div className="rp-stat-card"><div className="rp-stat-num">$5M</div><div className="rp-stat-label">Grant Management</div><div className="rp-stat-detail">Canadian dollars capacity</div></div>
            </div>
          </section>

          {/* Priority Areas */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🔬</span>
              <h2 className="rp-sec-title">Research Priority Areas</h2>
              <div className="rp-underline"></div>
            </div>
            <p style={{color:'#1e3a5f',marginBottom:'1.5rem'}}>SPHMMC undertakes operational researches which falls under various health priority themes in the country.</p>
            <div className="rp-areas-grid">
              <div className="rp-area-item"><div className="rp-area-icon">🦠</div><div><div className="rp-area-title">Infectious Diseases</div><p className="rp-area-desc">Comprehensive studies on prevalent and emerging infectious diseases</p></div></div>
              <div className="rp-area-item"><div className="rp-area-icon">❤️</div><div><div className="rp-area-title">Non-communicable Diseases</div><p className="rp-area-desc">Research on chronic conditions and their management</p></div></div>
              <div className="rp-area-item"><div className="rp-area-icon">👶</div><div><div className="rp-area-title">Reproductive &amp; Adolescent Health</div><p className="rp-area-desc">Studies focusing on maternal and young adult health</p></div></div>
              <div className="rp-area-item"><div className="rp-area-icon">🥗</div><div><div className="rp-area-title">Nutrition</div><p className="rp-area-desc">Nutritional research and intervention studies</p></div></div>
              <div className="rp-area-item"><div className="rp-area-icon">🏥</div><div><div className="rp-area-title">Healthcare Services</div><p className="rp-area-desc">Health systems and service delivery research</p></div></div>
              <div className="rp-area-item"><div className="rp-area-icon">🎓</div><div><div className="rp-area-title">Medical Education &amp; Training</div><p className="rp-area-desc">Improving medical education quality and outcomes</p></div></div>
              <div className="rp-area-item"><div className="rp-area-icon">🚑</div><div><div className="rp-area-title">Accidents &amp; Emergencies</div><p className="rp-area-desc">Emergency medicine and trauma research</p></div></div>
            </div>
          </section>

          {/* Research Community */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🤝</span>
              <h2 className="rp-sec-title">Research Community</h2>
              <div className="rp-underline"></div>
            </div>
            <p className="rp-lead">Apart from its students and academic staff, investigators from other teaching institutions and organizations conduct health researches in the college, fostering a collaborative research environment.</p>
          </section>

          {/* IRB */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">⚖️</span>
              <h2 className="rp-sec-title">Institutional Review Board (IRB)</h2>
              <div className="rp-underline"></div>
            </div>
            <p style={{color:'#1e3a5f',marginBottom:'2rem',fontSize:'1.05rem',lineHeight:'1.8'}}>The IRB of SPHMMC plays a crucial role in overseeing ethical standards for research, ensuring studies comply with the Declaration of Helsinki, participant confidentiality, informed consent, and protection of human research subjects.</p>

            <div className="rp-card">
              <div className="rp-card-title">IRB Responsibilities</div>
              <ul>
                <li>Approving a wide range of research projects, including clinical trials and observational studies</li>
                <li>Reviewing research proposals and ensuring alignment with national and international ethical standards</li>
                <li>Authority to approve, disapprove, exempt, monitor, and require modifications to all research activities</li>
                <li>Protection of vulnerable populations and maintaining ethical integrity throughout the research process</li>
              </ul>
            </div>

            <div className="rp-card">
              <div className="rp-card-title">IRB Development Timeline</div>
              <div className="rp-timeline">
                <div className="rp-tl-item"><div className="rp-tl-year">2015</div><div className="rp-tl-event">IRB Established</div></div>
                <div className="rp-tl-item"><div className="rp-tl-year">2021</div><div className="rp-tl-event">IRB Restructured</div></div>
                <div className="rp-tl-item"><div className="rp-tl-year">2022</div><div className="rp-tl-event">27 SOPs Endorsed</div></div>
                <div className="rp-tl-item"><div className="rp-tl-year">2022</div><div className="rp-tl-event">Level A Recognition by Ministry of Education</div></div>
              </div>
            </div>

            <div className="rp-accred">
              <div className="rp-accred-badge">🏆</div>
              <div>
                <div className="rp-accred-title">Nationally Accredited Level A IRB</div>
                <p className="rp-accred-desc">Recognized by the national research ethics committee at the Ministry of Education with the privilege to review and approve human subject studies including clinical trials.</p>
              </div>
            </div>
          </section>

          {/* Get Involved */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">📬</span>
              <h2 className="rp-sec-title">Get Involved</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-contact-grid">
              <div className="rp-contact-card"><h3>Submit Research Proposal</h3><p>Learn about our submission process and requirements</p><button className="rp-contact-btn">Submit Proposal</button></div>
              <div className="rp-contact-card"><h3>IRB Application</h3><p>Apply for ethical clearance for your research study</p><button className="rp-contact-btn">Apply to IRB</button></div>
              <div className="rp-contact-card"><h3>Collaborate With Us</h3><p>Partner with our research team on innovative projects</p><button className="rp-contact-btn">Contact Research Office</button></div>
            </div>
          </section>

        </div>
      </main>
    </div>
  )
}

export default ResearchBackground
