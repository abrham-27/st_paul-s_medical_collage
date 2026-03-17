import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './RolesResponsibilities.css'

function RolesResponsibilities(): JSX.Element {
  const navigate = useNavigate()

  const [scrolled, setScrolled] = useState(false)
  const [expandedSections, setExpandedSections] = useState<Record<string, boolean>>({})

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 10)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const toggleSection = (section: string) => {
    setExpandedSections(prev => ({
      ...prev,
      [section]: !prev[section]
    }))
  }

  const researchStats = [
    { label: 'Annual Proposals', value: '1,400', icon: '📋' },
    { label: 'Student Research', value: '80%', icon: '👨‍🎓' },
    { label: 'Faculty Research', value: '15%', icon: '👨‍🏫' },
    { label: 'External Research', value: '5%', icon: '🤝' }
  ]

  const collaborationAreas = [
    {
      title: 'Capacity Building',
      icon: '🎓',
      description: 'Continued training for IRB members in advanced ethical review processes.'
    },
    {
      title: 'Infrastructure Improvement',
      icon: '🏗️',
      description: 'Providing IRBs with better resources to handle growing research demands, including but not limited to digitalizing the review and application process so that applicants can follow the status of their protocol approval online.'
    },
    {
      title: 'Strengthen Human Power',
      icon: '👥',
      description: 'To monitoring and oversight of approved research activities and data recording.'
    },
    {
      title: 'Public Awareness',
      icon: '📢',
      description: 'Increasing awareness among researchers about the importance of ethical research practices and the role of IRBs.'
    }
  ]

  return (
    <div className="roles-responsibilities-page">
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
              <h1>Roles & Responsibilities</h1>
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
                  <span className="badge-text">IRB Governance</span>
                </div>
                <h2 className="hero-title">Ensuring Ethical Excellence in Research</h2>
                <p className="hero-description">
                  The Institutional Review Board plays a critical role in safeguarding human subjects 
                  while promoting scientific integrity and ethical research practices.
                </p>
              </div>
            </section>

            {/* Overview Section */}
            <section className="overview-section">
              <div className="section-header">
                <div className="section-icon">📋</div>
                <h2>IRB Core Responsibilities</h2>
                <div className="section-underline"></div>
              </div>
              <div className="overview-content">
                <p className="overview-text">
                  The IRB serves as the guardian of research ethics, ensuring that all studies involving 
                  human subjects meet the highest standards of scientific integrity and participant protection.
                </p>
                <div className="responsibility-grid">
                  <div className="responsibility-card">
                    <div className="card-icon">🔍</div>
                    <h3>Review & Approve</h3>
                    <p>Evaluate research proposals for ethical compliance</p>
                  </div>
                  <div className="responsibility-card">
                    <div className="card-icon">👁️</div>
                    <h3>Monitor & Supervise</h3>
                    <p>Oversight of ongoing research activities</p>
                  </div>
                  <div className="responsibility-card">
                    <div className="card-icon">📊</div>
                    <h3>Evaluate & Report</h3>
                    <p>Assess research outcomes and compliance</p>
                  </div>
                  <div className="responsibility-card">
                    <div className="card-icon">🎓</div>
                    <h3>Educate & Train</h3>
                    <p>Guide researchers on ethical practices</p>
                  </div>
                </div>
              </div>
            </section>

            {/* Review of Research Proposals */}
            <section className="proposals-section">
              <div className="section-header">
                <div className="section-icon">📋</div>
                <h2>Review of Research Proposals</h2>
                <div className="section-underline"></div>
              </div>
              <div className="proposals-content">
                <div className="collapsible-section">
                  <button 
                    className="collapsible-header"
                    onClick={() => toggleSection('proposals')}
                  >
                    <div className="header-content">
                      <div className="header-icon">📋</div>
                      <h3>Primary Responsibilities</h3>
                    </div>
                    <div className={`expand-icon ${expandedSections.proposals ? 'expanded' : ''}`}>
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <path d="M19 9l-7 7-7-7"/>
                      </svg>
                    </div>
                  </button>
                  <div className={`collapsible-content ${expandedSections.proposals ? 'expanded' : ''}`}>
                    <div className="content-wrapper">
                      <p className="section-description">
                        The primary responsibility of IRBs is to review and approve research proposals 
                        involving human subjects. This involves assessing:
                      </p>
                      <div className="assessment-grid">
                        <div className="assessment-item">
                          <div className="assessment-icon">⚖️</div>
                          <h4>Risk-Benefit Analysis</h4>
                          <p>The potential risks and benefits to participants</p>
                        </div>
                        <div className="assessment-item">
                          <div className="assessment-icon">📝</div>
                          <h4>Informed Consent</h4>
                          <p>The written informed consent process</p>
                        </div>
                        <div className="assessment-item">
                          <div className="assessment-icon">🔒</div>
                          <h4>Data Protection</h4>
                          <p>Confidentiality and data protection measures</p>
                        </div>
                        <div className="assessment-item">
                          <div className="assessment-icon">⚖️</div>
                          <h4>Equitable Recruitment</h4>
                          <p>Equitable participant recruitment practices</p>
                        </div>
                        <div className="assessment-item">
                          <div className="assessment-icon">🔬</div>
                          <h4>Scientific Integrity</h4>
                          <p>The proposed research Scientific integrity to the highest standard</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {/* Research Statistics */}
                <div className="stats-section">
                  <h3>Research Approval Statistics</h3>
                  <div className="stats-grid">
                    {researchStats.map((stat, index) => (
                      <div key={index} className="stat-card">
                        <div className="stat-icon">{stat.icon}</div>
                        <div className="stat-value">{stat.value}</div>
                        <div className="stat-label">{stat.label}</div>
                      </div>
                    ))}
                  </div>
                  <div className="stats-note">
                    <p>
                      Starting from 2020 G.C the IRB has approved an average of 1,400 proposals annually. 
                      Student researches account the higher proportion accounting for about 80% followed by 
                      faculty and external applicants and collaborators.
                    </p>
                  </div>
                </div>

                {/* Compliance Limitations */}
                <div className="limitations-section">
                  <div className="limitations-header">
                    <div className="limitations-icon">⚠️</div>
                    <h3>Compliance Limitations</h3>
                  </div>
                  <div className="limitations-content">
                    <p>
                      However, the following were series limitations related to compliance:
                    </p>
                    <div className="limitations-list">
                      <div className="limitation-item">
                        <div className="limitation-icon">📊</div>
                        <div className="limitation-text">
                          <h4>Limited Monitoring Capacity</h4>
                          <p>Insufficient resources for ongoing oversight</p>
                        </div>
                      </div>
                      <div className="limitation-item">
                        <div className="limitation-icon">📝</div>
                        <div className="limitation-text">
                          <h4>Documentation Gaps</h4>
                          <p>Incomplete record-keeping and compliance tracking</p>
                        </div>
                      </div>
                      <div className="limitation-item">
                        <div className="limitation-icon">👥</div>
                        <div className="limitation-text">
                          <h4>Staff Shortages</h4>
                          <p>Limited full-time staff for comprehensive monitoring</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Monitoring Ongoing Research */}
            <section className="monitoring-section">
              <div className="section-header">
                <div className="section-icon">👁️</div>
                <h2>Monitoring Ongoing Research</h2>
                <div className="section-underline"></div>
              </div>
              <div className="monitoring-content">
                <div className="collapsible-section">
                  <button 
                    className="collapsible-header"
                    onClick={() => toggleSection('monitoring')}
                  >
                    <div className="header-content">
                      <div className="header-icon">👁️</div>
                      <h3>Oversight Challenges</h3>
                    </div>
                    <div className={`expand-icon ${expandedSections.monitoring ? 'expanded' : ''}`}>
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <path d="M19 9l-7 7-7-7"/>
                      </svg>
                    </div>
                  </button>
                  <div className={`collapsible-content ${expandedSections.monitoring ? 'expanded' : ''}`}>
                    <div className="content-wrapper">
                      <div className="monitoring-challenges">
                        <div className="challenge-highlight">
                          <div className="challenge-icon">⚠️</div>
                          <div className="challenge-text">
                            <h4>Limited Monitoring Resources</h4>
                            <p>
                              The IRB rarely monitor approved studies because of limited number of full time 
                              staff to ensure they adhere to the approved protocol and ethical guidelines.
                            </p>
                          </div>
                        </div>
                        
                        <div className="monitoring-abilities">
                          <h4>Available Oversight Actions</h4>
                          <div className="abilities-grid">
                            <div className="ability-item">
                              <div className="ability-icon">⏸️</div>
                              <h5>Study Suspension</h5>
                              <p>Can suspend studies if violations identified</p>
                            </div>
                            <div className="ability-item">
                              <div className="ability-icon">🛑</div>
                              <h5>Study Termination</h5>
                              <p>Can terminate studies for ethical violations</p>
                            </div>
                            <div className="ability-item">
                              <div className="ability-icon">📋</div>
                              <h5>Protocol Review</h5>
                              <p>Review adherence to approved protocols</p>
                            </div>
                          </div>
                        </div>

                        <div className="documentation-gap">
                          <div className="gap-header">
                            <div className="gap-icon">📂</div>
                            <h4>Documentation Gap</h4>
                          </div>
                          <p>
                            No single documented record was obtained up to the reporters search from IRB archives.
                          </p>
                          <div className="gap-impact">
                            <div className="impact-item">
                              <div className="impact-icon">📊</div>
                              <span>Limited tracking of ongoing studies</span>
                            </div>
                            <div className="impact-item">
                              <div className="impact-icon">📝</div>
                              <span>Incomplete compliance documentation</span>
                            </div>
                            <div className="impact-item">
                              <div className="impact-icon">🔍</div>
                              <span>Difficulty in audit trail creation</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Post-Research Review */}
            <section className="post-research-section">
              <div className="section-header">
                <div className="section-icon">📊</div>
                <h2>Post-Research Review</h2>
                <div className="section-underline"></div>
              </div>
              <div className="post-research-content">
                <div className="collapsible-section">
                  <button 
                    className="collapsible-header"
                    onClick={() => toggleSection('post-research')}
                  >
                    <div className="header-content">
                      <div className="header-icon">📊</div>
                      <h3>Completion Assessment Challenges</h3>
                    </div>
                    <div className={`expand-icon ${expandedSections['post-research'] ? 'expanded' : ''}`}>
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <path d="M19 9l-7 7-7-7"/>
                      </svg>
                    </div>
                  </button>
                  <div className={`collapsible-content ${expandedSections['post-research'] ? 'expanded' : ''}`}>
                    <div className="content-wrapper">
                      <div className="post-research-challenges">
                        <div className="challenge-highlight">
                          <div className="challenge-icon">⚠️</div>
                          <div className="challenge-text">
                            <h4>IRB Review Limitations</h4>
                            <p>
                              After research completion, SPHMMC IRBs fails to review findings to ensure that 
                              the study was conducted ethically and that data handling meets the ethical standards.
                            </p>
                          </div>
                        </div>

                        <div className="current-practice">
                          <h4>Current Practice</h4>
                          <div className="practice-item">
                            <div className="practice-icon">🎓</div>
                            <div className="practice-content">
                              <h5>Student Thesis Defense</h5>
                              <p>
                                Other than the student thesis defense at department levels that is not 
                                supported with appropriate documentation.
                              </p>
                            </div>
                          </div>
                        </div>

                        <div className="missing-elements">
                          <h4>Missing Post-Research Elements</h4>
                          <div className="missing-grid">
                            <div className="missing-item">
                              <div className="missing-icon">📋</div>
                              <h5>Ethical Compliance Review</h5>
                              <p>No systematic review of ethical conduct</p>
                            </div>
                            <div className="missing-item">
                              <div className="missing-icon">🔒</div>
                              <h5>Data Handling Assessment</h5>
                              <p>Limited evaluation of data protection</p>
                            </div>
                            <div className="missing-item">
                              <div className="missing-icon">📊</div>
                              <h5>Outcome Documentation</h5>
                              <p>Incomplete final study documentation</p>
                            </div>
                            <div className="missing-item">
                              <div className="missing-icon">📝</div>
                              <h5>Compliance Certification</h5>
                              <p>No formal compliance certification process</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Potentials of Collaboration */}
            <section className="collaboration-section">
              <div className="section-header">
                <div className="section-icon">🤝</div>
                <h2>Potentials of Collaboration on IRBs</h2>
                <div className="section-underline"></div>
              </div>
              <div className="collaboration-content">
                <div className="collaboration-intro">
                  <p>
                    Strategic collaboration opportunities exist to strengthen IRB operations and enhance 
                    research ethics governance across the institution.
                  </p>
                </div>

                <div className="collaboration-areas">
                  {collaborationAreas.map((area, index) => (
                    <div key={index} className="collapsible-section">
                      <button 
                        className="collapsible-header"
                        onClick={() => toggleSection(`collaboration-${index}`)}
                      >
                        <div className="header-content">
                          <div className="header-icon">{area.icon}</div>
                          <h3>{area.title}</h3>
                        </div>
                        <div className={`expand-icon ${expandedSections[`collaboration-${index}`] ? 'expanded' : ''}`}>
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M19 9l-7 7-7-7"/>
                          </svg>
                        </div>
                      </button>
                      <div className={`collapsible-content ${expandedSections[`collaboration-${index}`] ? 'expanded' : ''}`}>
                        <div className="content-wrapper">
                          <div className="collaboration-detail">
                            <div className="detail-icon">{area.icon}</div>
                            <div className="detail-content">
                              <h4>{area.title}</h4>
                              <p>{area.description}</p>
                              
                              {/* Specific content for each collaboration area */}
                              {area.title === 'Capacity Building' && (
                                <div className="specific-content">
                                  <div className="content-list">
                                    <div className="list-item">
                                      <div className="item-icon">🎓</div>
                                      <span>Advanced ethical review training</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">🌍</div>
                                      <span>International standards certification</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">📚</div>
                                      <span>Continuous professional development</span>
                                    </div>
                                  </div>
                                </div>
                              )}
                              
                              {area.title === 'Infrastructure Improvement' && (
                                <div className="specific-content">
                                  <div className="content-list">
                                    <div className="list-item">
                                      <div className="item-icon">💻</div>
                                      <span>Digital application and review systems</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">📱</div>
                                      <span>Online status tracking for applicants</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">🔐</div>
                                      <span>Secure document management</span>
                                    </div>
                                  </div>
                                </div>
                              )}
                              
                              {area.title === 'Strengthen Human Power' && (
                                <div className="specific-content">
                                  <div className="content-list">
                                    <div className="list-item">
                                      <div className="item-icon">👥</div>
                                      <span>Additional full-time staff</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">📊</div>
                                      <span>Enhanced monitoring capabilities</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">📝</div>
                                      <span>Improved data recording systems</span>
                                    </div>
                                  </div>
                                </div>
                              )}
                              
                              {area.title === 'Public Awareness' && (
                                <div className="specific-content">
                                  <div className="content-list">
                                    <div className="list-item">
                                      <div className="item-icon">📢</div>
                                      <span>Ethical research awareness campaigns</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">🎓</div>
                                      <span>Researcher training programs</span>
                                    </div>
                                    <div className="list-item">
                                      <div className="item-icon">🤝</div>
                                      <span>Community engagement initiatives</span>
                                    </div>
                                  </div>
                                </div>
                              )}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </section>

            {/* Call to Action */}
            <section className="cta-section">
              <div className="cta-content">
                <h2>Strengthening IRB Excellence</h2>
                <p>
                  Through strategic collaboration and capacity building, we can enhance our IRB's 
                  ability to protect research participants while promoting scientific innovation.
                </p>
                <div className="cta-buttons">
                  <button className="cta-button primary">Partner With IRB</button>
                  <button className="cta-button secondary">Learn More</button>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>
    </div>
  )
}

export default RolesResponsibilities
