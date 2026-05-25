import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './Partners.css'

function Partners(): JSX.Element {
  const navigate = useNavigate()

  const [scrolled, setScrolled] = useState(false)
  const [activeTab, setActiveTab] = useState<'local' | 'international'>('local')
  const [expandedPartners, setExpandedPartners] = useState<Record<string, boolean>>({})

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 10)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const togglePartner = (partner: string) => {
    setExpandedPartners(prev => ({
      ...prev,
      [partner]: !prev[partner]
    }))
  }

  const localPartners = [
    'Addis Ababa University',
    'Ethiopian Public Health Institution',
    'Ras Desta Hospital',
    'Yekatit 12 Hospital',
    'Amanuel Hospital',
    'Armaur Hansen Research Institute',
    'Jimma University',
    'Various Health Centers in Addis Ababa',
    'Worabe Hospital'
  ]

  const internationalPartners = [
    {
      name: 'University of Michigan',
      description: 'The partnership with the University of Michigan has led to the establishment of a competency-based Ob/Gyn residency program.',
      programs: [
        {
          title: 'Technical Assistance and Training',
          description: 'Faculty from the University of Michigan visit St. Paul to train local faculty and teach residents and students. Conversely, St. Paul faculty also visit Michigan for training and observation.'
        },
        {
          title: 'Strategic Interventions',
          description: 'Collaborating with local staff, we design interventions to increase capacity, improve organization, and enhance the overall services and management of the Ob/Gyn department. Recently, this partnership expanded to include the establishment of residency programs in Surgery and Internal Medicine, as well as the development of Ethiopia\'s first Kidney Transplant program.'
        }
      ]
    },
    {
      name: 'Tulane University',
      description: 'Through our partnership with Tulane University, St. Paul has received support in various areas, particularly for undergraduate medical education.',
      programs: [
        {
          title: 'Educational Infrastructure',
          description: 'ICT infrastructure development, library resources (computers and books), financial support for staff development programs abroad, and the provision of transportation for students.'
        },
        {
          title: 'Healthcare Technology',
          description: 'Their assistance has been pivotal in implementing electronic medical records (EMR) systems.'
        }
      ]
    },
    {
      name: 'Harvard School of Public Health',
      description: 'We are currently involved in a two-year Health Facility Networking project with the Maternal Health Task Force.',
      programs: [
        {
          title: 'Maternal Health Initiative',
          description: 'Aimed at improving maternal health through implementation research.'
        }
      ]
    },
    {
      name: 'University of Alberta',
      description: 'St. Paul is also initiating a five-year project with the University of Alberta, supported by a CIDA grant.',
      programs: [
        {
          title: 'Maternal and Neonatal Health',
          description: 'A comprehensive five-year project to improve maternal and neonatal health outcomes.'
        }
      ]
    },
    {
      name: 'University of Bergen',
      description: 'Our partnership with the University of Bergen, Trauma Care Ethiopia, and the Children Burn Foundation.',
      programs: [
        {
          title: 'Nursing Education Programs',
          description: 'Establishment of bachelor\'s programs in Critical Care Nursing and Operation Theater Nursing, with faculty from Norway teaching in these programs.'
        }
      ]
    },
    {
      name: 'Teaching Institutions and Ministry of Health of Egypt',
      description: 'We maintain a strong collaboration with the Egyptian Ministry of Health and teaching institutions.',
      programs: [
        {
          title: 'Healthcare Services',
          description: 'Recently resulted in the opening of a Hemodialysis Center. This partnership has also strengthened the GI/Endoscopy unit, expanding it into a Hepatology Unit, and continues to support the development of Endo-urology services.'
        }
      ]
    },
    {
      name: 'ENAHPA (Ethiopian North Americans Health Professionals Association)',
      description: 'In collaboration with ENHAPA, we are enhancing Emergency and ICU care.',
      programs: [
        {
          title: 'Emergency Care Enhancement',
          description: 'Staff training, as well as supplying books and medical equipment.'
        },
        {
          title: 'GI/Endoscopy Support',
          description: 'Support our GI/Endoscopy unit through training and equipment provision.'
        }
      ]
    },
    {
      name: 'JHU TSEHAI (Johns Hopkins University)',
      description: 'HIV care at St. Paul began over ten years ago with the support of JHU TSEHAI.',
      programs: [
        {
          title: 'HIV Care Infrastructure',
          description: 'Constructing and furnishing the Adult HIV Unit, renovating the lab, and providing lab testing equipment, ART medication, and technical assistance.'
        },
        {
          title: 'Expanded HIV Services',
          description: 'This collaboration has since expanded to include pediatric ART, PMTCT, PICT, and support groups for mothers.'
        }
      ]
    },
    {
      name: 'Engender Health',
      description: 'Partnership focused on healthcare capacity building and service improvement.',
      programs: [
        {
          title: 'Healthcare Capacity Building',
          description: 'Enhancing healthcare delivery systems and service quality.'
        }
      ]
    }
  ]

  return (
    <div className="partners-page">
      {/* Header */}
      <header className={`partners-header ${scrolled ? 'scrolled' : ''}`}>
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
              <h1>Partners</h1>
            </div>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="partners-main-content">
        <div className="container">
          <div className="partners-content">
            {/* Hero Section */}
            <section className="hero-section">
              <div className="hero-content">
                <div className="hero-badge">
                  <span className="badge-icon">🤝</span>
                  <span className="badge-text">Global Collaboration</span>
                </div>
                <h2 className="hero-title">Building Excellence Through Partnerships</h2>
                <p className="hero-description">
                  In our journey to expand and enhance our services with the aim of becoming 
                  a Center of Excellence, we have established invaluable partnerships both 
                  domestically and internationally.
                </p>
              </div>
            </section>

            {/* Tab Navigation */}
            <section className="tab-navigation">
              <div className="tab-buttons">
                <button 
                  className={`tab-button ${activeTab === 'local' ? 'active' : ''}`}
                  onClick={() => setActiveTab('local')}
                >
                  <div className="tab-icon">🇪🇹</div>
                  <span>Local Partners</span>
                </button>
                <button 
                  className={`tab-button ${activeTab === 'international' ? 'active' : ''}`}
                  onClick={() => setActiveTab('international')}
                >
                  <div className="tab-icon">🌍</div>
                  <span>International Partners</span>
                </button>
              </div>
            </section>

            {/* Local Partners Section */}
            {activeTab === 'local' && (
              <section className="local-partners-section">
                <div className="section-header">
                  <div className="section-icon">🇪🇹</div>
                  <h2>Local Partners in Ethiopia</h2>
                  <div className="section-underline"></div>
                </div>
                <div className="local-description">
                  <p>
                    Within Ethiopia, these collaborations not only elevate our own standards of care 
                    but also uplift those of our colleagues across the nation. Here's a list of our 
                    esteemed local partners in Ethiopia:
                  </p>
                </div>
                <div className="partners-grid">
                  {localPartners.map((partner, index) => (
                    <div key={index} className="partner-card" style={{ animationDelay: `${index * 0.1}s` }}>
                      <div className="partner-content">
                        <div className="partner-icon">🏥</div>
                        <h3>{partner}</h3>
                        <div className="partner-badge">Local Partner</div>
                      </div>
                    </div>
                  ))}
                </div>
              </section>
            )}

            {/* International Partners Section */}
            {activeTab === 'international' && (
              <section className="international-partners-section">
                <div className="section-header">
                  <div className="section-icon">🌍</div>
                  <h2>International Partners</h2>
                  <div className="section-underline"></div>
                </div>
                <div className="international-description">
                  <p>
                    Our international partnerships span the globe, facilitating the exchange of expertise 
                    across various sectors. We believe that sharing knowledge and experience is crucial, 
                    and we are committed to creating platforms for engagement in these collaborations.
                  </p>
                </div>
                <div className="international-partners-list">
                  {internationalPartners.map((partner, index) => (
                    <div key={index} className="international-partner-card">
                      <button 
                        className="partner-header"
                        onClick={() => togglePartner(partner.name)}
                      >
                        <div className="partner-info">
                          <div className="partner-logo">
                            {partner.name.includes('Michigan') && '🏫'}
                            {partner.name.includes('Tulane') && '🎓'}
                            {partner.name.includes('Harvard') && '📚'}
                            {partner.name.includes('Alberta') && '🍁'}
                            {partner.name.includes('Bergen') && '⛵'}
                            {partner.name.includes('Egypt') && '🏺'}
                            {partner.name.includes('ENAHPA') && '🏥'}
                            {partner.name.includes('JHU') && '🔬'}
                            {partner.name.includes('Engender') && '⚕️'}
                          </div>
                          <div className="partner-details">
                            <h3>{partner.name}</h3>
                            <p>{partner.description}</p>
                          </div>
                        </div>
                        <div className={`expand-icon ${expandedPartners[partner.name] ? 'expanded' : ''}`}>
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M19 9l-7 7-7-7"/>
                          </svg>
                        </div>
                      </button>
                      <div className={`partner-details-content ${expandedPartners[partner.name] ? 'expanded' : ''}`}>
                        <div className="programs-list">
                          {partner.programs.map((program, programIndex) => (
                            <div key={programIndex} className="program-card">
                              <div className="program-header">
                                <div className="program-icon">
                                  {program.title.includes('Technical') && '🛠️'}
                                  {program.title.includes('Strategic') && '🎯'}
                                  {program.title.includes('Educational') && '📚'}
                                  {program.title.includes('Healthcare') && '💻'}
                                  {program.title.includes('Maternal') && '🤱'}
                                  {program.title.includes('Nursing') && '👩‍⚕️'}
                                  {program.title.includes('Healthcare') && '🏥'}
                                  {program.title.includes('Emergency') && '🚑'}
                                  {program.title.includes('HIV') && '🔬'}
                                  {program.title.includes('Healthcare') && '⚕️'}
                                </div>
                                <h4>{program.title}</h4>
                              </div>
                              <div className="program-description">
                                <p>{program.description}</p>
                              </div>
                            </div>
                          ))}
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </section>
            )}

            {/* Impact Statistics */}
            <section className="impact-section">
              <div className="section-header">
                <div className="section-icon">📊</div>
                <h2>Partnership Impact</h2>
                <div className="section-underline"></div>
              </div>
              <div className="impact-grid">
                <div className="impact-card">
                  <div className="impact-icon">🤝</div>
                  <div className="impact-number">20+</div>
                  <div className="impact-label">Partner Institutions</div>
                </div>
                <div className="impact-card">
                  <div className="impact-icon">🎓</div>
                  <div className="impact-number">15+</div>
                  <div className="impact-label">Academic Programs</div>
                </div>
                <div className="impact-card">
                  <div className="impact-icon">🏥</div>
                  <div className="impact-number">10+</div>
                  <div className="impact-label">Healthcare Facilities</div>
                </div>
                <div className="impact-card">
                  <div className="impact-icon">🌍</div>
                  <div className="impact-number">8</div>
                  <div className="impact-label">Countries</div>
                </div>
              </div>
            </section>

            {/* Call to Action */}
            <section className="cta-section">
              <div className="cta-content">
                <h2>Partner With Us</h2>
                <p>
                  Join us in our mission to become a Center of Excellence through meaningful 
                  collaborations and knowledge exchange.
                </p>
                <div className="cta-buttons">
                  <button className="cta-button primary">Become a Partner</button>
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

export default Partners
