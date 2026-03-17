import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './FunctionsOfIRB.css'

function FunctionsOfIRB(): JSX.Element {
  const navigate = useNavigate()

  const [scrolled, setScrolled] = useState(false)

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 10)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const irbMembers = [
    {
      category: 'Medical and Healthcare Professionals',
      description: 'Clinical experts with extensive experience in medical research and patient care'
    },
    {
      category: 'Legal Experts',
      description: 'Lawyers specializing in healthcare law and research ethics'
    },
    {
      category: 'Social Scientists',
      description: 'Experts in social sciences, ethics, and community impact assessment'
    },
    {
      category: 'Community Representatives',
      description: 'Patient advocates and community stakeholders representing public interests'
    },
    {
      category: 'Ethicists',
      description: 'Specialists in bioethics and research methodology'
    },
    {
      category: 'Laypersons',
      description: 'Community members providing non-technical perspective on research ethics'
    }
  ]

  return (
    <div className="functions-irb-page">
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
              <h1>Functions of IRB</h1>
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
                  <span className="badge-icon">⚖️</span>
                  <span className="badge-text">Ethical Oversight</span>
                </div>
                <h2 className="hero-title">Ensuring Research Integrity & Participant Protection</h2>
                <p className="hero-description">
                  The Institutional Review Board serves as the guardian of ethical standards in research, 
                  ensuring all studies protect human subjects while advancing scientific knowledge.
                </p>
              </div>
            </section>

            {/* Legal and Regulatory Framework */}
            <section className="framework-section">
              <div className="section-header">
                <div className="section-icon">⚖️</div>
                <h2>Legal and Regulatory Framework</h2>
                <div className="section-underline"></div>
              </div>
              <div className="framework-content">
                <div className="framework-card">
                  <div className="card-header">
                    <div className="card-icon">🏛️</div>
                    <h3>Regulatory Authorities</h3>
                  </div>
                  <div className="card-content">
                    <p>
                      Obtained from <strong>National Health Research Ethics Review Committee (NHRERC)</strong>, 
                      the IRB plays a supervisory role to all human subject studies conducted at SPHMMC.
                    </p>
                    <div className="authority-details">
                      <div className="authority-item">
                        <div className="authority-icon">📋</div>
                        <div className="authority-text">
                          <h4>National Oversight</h4>
                          <p>Direct supervision by national ethics committee</p>
                        </div>
                      </div>
                      <div className="authority-item">
                        <div className="authority-icon">🔍</div>
                        <div className="authority-text">
                          <h4>Compliance Monitoring</h4>
                          <p>Regular review and audit of research protocols</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div className="framework-card">
                  <div className="card-header">
                    <div className="card-icon">📜</div>
                    <h3>National Guidelines</h3>
                  </div>
                  <div className="card-content">
                    <p>
                      SPHMMC has adopted <strong>National Health Research Ethics Guidelines</strong>, 
                      which align with international standards such as:
                    </p>
                    <div className="guidelines-list">
                      <div className="guideline-item">
                        <div className="guideline-icon">🌍</div>
                        <div className="guideline-content">
                          <h4>Declaration of Helsinki</h4>
                          <p>International ethical principles for medical research</p>
                        </div>
                      </div>
                      <div className="guideline-item">
                        <div className="guideline-icon">📊</div>
                        <div className="guideline-content">
                          <h4>Belmont Report</h4>
                          <p>Ethical principles for human subject protection</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div className="framework-card">
                  <div className="card-header">
                    <div className="card-icon">🏢</div>
                    <h3>Institutional Mandate</h3>
                  </div>
                  <div className="card-content">
                    <p>
                      SPHMMC established an IRB, which operates under the oversight of the institution 
                      but in compliance with national guidelines that is <strong>independent in its aspect</strong>.
                    </p>
                    <div className="mandate-features">
                      <div className="feature-item">
                        <div className="feature-icon">🔒</div>
                        <h4>Independence</h4>
                        <p>Autonomous decision-making authority</p>
                      </div>
                      <div className="feature-item">
                        <div className="feature-icon">⚖️</div>
                        <h4>Compliance</h4>
                        <p>Adherence to national and international standards</p>
                      </div>
                      <div className="feature-item">
                        <div className="feature-icon">🛡️</div>
                        <h4>Oversight</h4>
                        <p>Comprehensive review of all research activities</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Structure of IRBs */}
            <section className="structure-section">
              <div className="section-header">
                <div className="section-icon">👥</div>
                <h2>Structure of IRBs in Medical Institutions</h2>
                <div className="section-underline"></div>
              </div>
              <div className="structure-content">
                <div className="structure-intro">
                  <p>
                    As per national guideline which typically consist of a multidisciplinary panel of experts, 
                    SPHMMC IRB has <strong>15 members</strong> that includes:
                  </p>
                </div>

                <div className="composition-grid">
                  {irbMembers.map((member, index) => (
                    <div key={index} className="member-card" style={{ animationDelay: `${index * 0.1}s` }}>
                      <div className="member-header">
                        <div className="member-icon">
                          {member.category === 'Medical and Healthcare Professionals' && '👨‍⚕️'}
                          {member.category === 'Legal Experts' && '⚖️'}
                          {member.category === 'Social Scientists' && '👥‍🔬'}
                          {member.category === 'Community Representatives' && '👥‍🌍'}
                          {member.category === 'Ethicists' && '🤝‍⚖️'}
                          {member.category === 'Laypersons' && '👥'}
                        </div>
                        <h3>{member.category}</h3>
                      </div>
                      <div className="member-description">
                        <p>{member.description}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </section>

            {/* Appointment and Training */}
            <section className="appointment-section">
              <div className="section-header">
                <div className="section-icon">📅</div>
                <h2>Appointment and Training</h2>
                <div className="section-underline"></div>
              </div>
              <div className="appointment-content">
                <div className="appointment-grid">
                  <div className="appointment-card">
                    <div className="card-header">
                      <div className="card-icon">📋</div>
                      <h3>Appointment Process</h3>
                    </div>
                    <div className="card-content">
                      <p>
                        Members were appointed by <strong>Academic and Vice Provost</strong> and undergo regular 
                        ethics and scientific integrity training to stay updated on global and national 
                        research ethics standards.
                      </p>
                      <div className="process-steps">
                        <div className="step-item">
                          <div className="step-number">1</div>
                          <div className="step-text">
                            <h4>Selection</h4>
                            <p>Based on expertise and ethical standing</p>
                          </div>
                        </div>
                        <div className="step-item">
                          <div className="step-number">2</div>
                          <div className="step-text">
                            <h4>Appointment</h4>
                            <p>Formal appointment by institutional leadership</p>
                          </div>
                        </div>
                        <div className="step-item">
                          <div className="step-number">3</div>
                          <div className="step-text">
                            <h4>Training</h4>
                            <p>Regular ethics and integrity education</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="appointment-card">
                    <div className="card-header">
                      <div className="card-icon">🎓</div>
                      <h3>Training Program</h3>
                    </div>
                    <div className="card-content">
                      <p>
                        Comprehensive training program ensures members are certified by <strong>national Research 
                        Ethics committee under the MOE</strong>.
                      </p>
                      <div className="training-areas">
                        <div className="training-item">
                          <div className="training-icon">🌍</div>
                          <h4>Global Standards</h4>
                          <p>International research ethics guidelines</p>
                        </div>
                        <div className="training-item">
                          <div className="training-icon">🇪🇹</div>
                          <h4>National Standards</h4>
                          <p>Ethiopian research ethics regulations</p>
                        </div>
                        <div className="training-item">
                          <div className="training-icon">🔬</div>
                          <h4>Scientific Integrity</h4>
                          <p>Research methodology and ethics</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Core Functions */}
            <section className="functions-section">
              <div className="section-header">
                <div className="section-icon">⚙️</div>
                <h2>Core Functions of IRB</h2>
                <div className="section-underline"></div>
              </div>
              <div className="functions-content">
                <div className="functions-grid">
                  <div className="function-card">
                    <div className="function-icon">🔍</div>
                    <h3>Protocol Review</h3>
                    <p>Comprehensive review of research proposals and methodologies</p>
                  </div>
                  <div className="function-card">
                    <div className="function-icon">🛡️</div>
                    <h3>Risk Assessment</h3>
                    <p>Evaluation of potential risks and mitigation strategies</p>
                  </div>
                  <div className="function-card">
                    <div className="function-icon">📋</div>
                    <h3>Approval Process</h3>
                    <p>Ethical clearance and authorization of research studies</p>
                  </div>
                  <div className="function-card">
                    <div className="function-icon">👁️</div>
                    <h3>Monitoring</h3>
                    <p>Ongoing oversight of approved research activities</p>
                  </div>
                  <div className="function-card">
                    <div className="function-icon">📊</div>
                    <h3>Compliance Audit</h3>
                    <p>Regular audits to ensure adherence to ethical standards</p>
                  </div>
                  <div className="function-card">
                    <div className="function-icon">🤝</div>
                    <h3>Education & Training</h3>
                    <p>Training researchers on ethical conduct and standards</p>
                  </div>
                </div>
              </div>
            </section>

            {/* Certification */}
            <section className="certification-section">
              <div className="section-header">
                <div className="section-icon">🏆</div>
                <h2>National Certification</h2>
                <div className="section-underline"></div>
              </div>
              <div className="certification-content">
                <div className="certification-card">
                  <div className="cert-badge">
                    <div className="badge-icon">✅</div>
                    <span className="badge-text">NHRERC Certified</span>
                  </div>
                  <div className="cert-details">
                    <h3>Commitment to Excellence</h3>
                    <p>
                      SPHMMC IRB maintains certification through continuous improvement, 
                      regular training, and strict adherence to national and international 
                      research ethics standards.
                    </p>
                    <div className="cert-features">
                      <div className="cert-feature">
                        <div className="feature-icon">🔄</div>
                        <h4>Continuous Review</h4>
                        <p>Regular assessment and improvement of processes</p>
                      </div>
                      <div className="cert-feature">
                        <div className="feature-icon">📈</div>
                        <h4>Quality Assurance</h4>
                        <p>Maintaining high standards in all operations</p>
                      </div>
                      <div className="cert-feature">
                        <div className="feature-icon">🌍</div>
                        <h4>International Alignment</h4>
                        <p>Compliance with global best practices</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Contact Section */}
            <section className="contact-section">
              <div className="section-header">
                <div className="section-icon">📞</div>
                <h2>Contact IRB Office</h2>
                <div className="section-underline"></div>
              </div>
              <div className="contact-content">
                <div className="contact-grid">
                  <div className="contact-card">
                    <div className="contact-icon">📧</div>
                    <h3>Email</h3>
                    <p>irb@sphmmc.edu.et</p>
                  </div>
                  <div className="contact-card">
                    <div className="contact-icon">📞</div>
                    <h3>Phone</h3>
                    <p>+251-XXX-XXXX</p>
                  </div>
                  <div className="contact-card">
                    <div className="contact-icon">📍</div>
                    <h3>Office Location</h3>
                    <p>Research Administration Building, SPHMMC</p>
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

export default FunctionsOfIRB
