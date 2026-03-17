import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './Background.css'

function ResearchBackground(): JSX.Element {
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
    <div className="research-background-page">
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
              <h1>Research Background</h1>
            </div>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="research-main-content">
        <div className="container">
          <div className="research-content">
            {/* Introduction Section */}
            <section className="research-section">
              <div className="section-header">
                <h2>Our Mission & Vision</h2>
                <div className="section-underline"></div>
              </div>
              <div className="section-content">
                <p className="lead-text">
                  Established in alignment with the medical college's mission to provide quality and affordable curative, rehabilitative, preventive, and promote healthcare services and train competent, compassionate and ethical health professionals using integrated and quality medical education, and to perform need-based research.
                </p>
              </div>
            </section>

            {/* Research Infrastructure */}
            <section className="research-section">
              <div className="section-header">
                <h2>Research Infrastructure</h2>
                <div className="section-underline"></div>
              </div>
              <div className="section-content">
                <div className="research-stats">
                  <div className="stat-card">
                    <div className="stat-number">6</div>
                    <div className="stat-label">Full-time Researchers</div>
                    <div className="stat-detail">Biomedical and public health backgrounds</div>
                  </div>
                  <div className="stat-card">
                    <div className="stat-number">200+</div>
                    <div className="stat-label">Volunteer Reviewers</div>
                    <div className="stat-detail">From 37+ fields of specialty</div>
                  </div>
                  <div className="stat-card">
                    <div className="stat-number">15</div>
                    <div className="stat-label">IRB Members</div>
                    <div className="stat-detail">Two-year terms with robust grant management</div>
                  </div>
                  <div className="stat-card">
                    <div className="stat-number">$5M</div>
                    <div className="stat-label">Grant Management</div>
                    <div className="stat-detail">Canadian dollars capacity</div>
                  </div>
                </div>
              </div>
            </section>

            {/* Research Areas */}
            <section className="research-section">
              <div className="section-header">
                <h2>Research Priority Areas</h2>
                <div className="section-underline"></div>
              </div>
              <div className="section-content">
                <p>
                  SPHMMC undertakes operational researches which falls under various health priority themes in the country. Our research encompasses:
                </p>
                <div className="research-areas">
                  <div className="area-item">
                    <div className="area-icon">🦠</div>
                    <div className="area-content">
                      <h3>Infectious Diseases</h3>
                      <p>Comprehensive studies on prevalent and emerging infectious diseases</p>
                    </div>
                  </div>
                  <div className="area-item">
                    <div className="area-icon">❤️</div>
                    <div className="area-content">
                      <h3>Non-communicable Diseases</h3>
                      <p>Research on chronic conditions and their management</p>
                    </div>
                  </div>
                  <div className="area-item">
                    <div className="area-icon">👶</div>
                    <div className="area-content">
                      <h3>Reproductive & Adolescent Health</h3>
                      <p>Studies focusing on maternal and young adult health</p>
                    </div>
                  </div>
                  <div className="area-item">
                    <div className="area-icon">🥗</div>
                    <div className="area-content">
                      <h3>Nutrition</h3>
                    </div>
                  </div>
                  <div className="area-item">
                    <div className="area-icon">🏥</div>
                    <div className="area-content">
                      <h3>Healthcare Services</h3>
                    </div>
                  </div>
                  <div className="area-item">
                    <div className="area-icon">🎓</div>
                    <div className="area-content">
                      <h3>Medical Education & Training</h3>
                    </div>
                  </div>
                  <div className="area-item">
                    <div className="area-icon">🚑</div>
                    <div className="area-content">
                      <h3>Accidents & Emergencies</h3>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Research Community */}
            <section className="research-section">
              <div className="section-header">
                <h2>Research Community</h2>
                <div className="section-underline"></div>
              </div>
              <div className="section-content">
                <p>
                  Apart from its students and academic staff, investigators from other teaching institutions and organizations conduct health researches in the college, fostering a collaborative research environment.
                </p>
              </div>
            </section>

            {/* Institutional Review Board */}
            <section className="research-section">
              <div className="section-header">
                <h2>Institutional Review Board (IRB)</h2>
                <div className="section-underline"></div>
              </div>
              <div className="section-content">
                <div className="irb-content">
                  <div className="irb-description">
                    <p>
                      The Institutional Review Board (IRB) of St. Paul's Hospital Millennium Medical College (SPHMMC) in Addis Ababa, Ethiopia, plays a crucial role in overseeing ethical standards for research conducted at the institution. It ensures that studies comply with ethical guidelines such as the Declaration of Helsinki, ensuring participant confidentiality, informed consent, and the protection of the rights and welfare of human research subjects involved in research activities.
                    </p>
                    <p>
                      For example, ethical clearance is required for prospective and retrospective studies, where patient anonymity is maintained, as seen in several studies conducted at SPHMMC.
                    </p>
                  </div>
                  
                  <div className="irb-responsibilities">
                    <h3>IRB Responsibilities</h3>
                    <ul>
                      <li>Approving a wide range of research projects, including clinical trials and observational studies</li>
                      <li>Reviewing research proposals and ensuring alignment with both national and international ethical standards</li>
                      <li>Authority to approve, disapprove, exempt, monitor, and require modifications to all research activities</li>
                      <li>Protection of vulnerable populations and maintaining ethical integrity throughout the research process</li>
                    </ul>
                  </div>

                  <div className="irb-timeline">
                    <h3>IRB Development Timeline</h3>
                    <div className="timeline">
                      <div className="timeline-item">
                        <div className="timeline-year">2015</div>
                        <div className="timeline-event">IRB Established</div>
                      </div>
                      <div className="timeline-item">
                        <div className="timeline-year">2021</div>
                        <div className="timeline-event">IRB Restructured</div>
                      </div>
                      <div className="timeline-item">
                        <div className="timeline-year">2022</div>
                        <div className="timeline-event">27 SOPs Endorsed</div>
                      </div>
                      <div className="timeline-item">
                        <div className="timeline-year">2022</div>
                        <div className="timeline-event">Level A Recognition by Ministry of Education</div>
                      </div>
                    </div>
                  </div>

                  <div className="irb-accreditation">
                    <div className="accreditation-card">
                      <div className="accreditation-badge">🏆</div>
                      <div className="accreditation-content">
                        <h3>Nationally Accredited Level A IRB</h3>
                        <p>
                          Recognized by the national research ethics committee at the Ministry of Education with the privilege to review and approve human subject studies including clinical trials within certain precincts.
                        </p>
                      </div>
                    </div>
                  </div>

                  <div className="irb-process">
                    <h3>Research Approval Process</h3>
                    <p>
                      For each study, the IRB provides a reference number to track and monitor the ethical approval, such as PM xx/xxxx.
                    </p>
                  </div>
                </div>
              </div>
            </section>

            {/* Contact Section */}
            <section className="research-section">
              <div className="section-header">
                <h2>Get Involved</h2>
                <div className="section-underline"></div>
              </div>
              <div className="section-content">
                <div className="contact-options">
                  <div className="contact-card">
                    <h3>Submit Research Proposal</h3>
                    <p>Learn about our submission process and requirements</p>
                    <button className="contact-button">Submit Proposal</button>
                  </div>
                  <div className="contact-card">
                    <h3>IRB Application</h3>
                    <p>Apply for ethical clearance for your research study</p>
                    <button className="contact-button">Apply to IRB</button>
                  </div>
                  <div className="contact-card">
                    <h3>Collaborate With Us</h3>
                    <p>Partner with our research team on innovative projects</p>
                    <button className="contact-button">Contact Research Office</button>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>
    </div>
  )
}

export default ResearchBackground
