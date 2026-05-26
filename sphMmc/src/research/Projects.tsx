import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './Projects.css'
import { sanitizeHtml } from '../utils/richText'

interface ResearchProject {
  id: number;
  project_type: string;
  title: string;
  content: string;
  image?: string;
  status: string;
  legal_framework_content?: {
    cards: Array<{
      icon: string;
      title: string;
      content: string;
      items: string[];
    }>;
  };
  irb_structure_content?: {
    intro_text: string;
    members: Array<{
      icon: string;
      title: string;
      desc: string;
    }>;
  };
  appointment_training_content?: {
    cards: Array<{
      icon: string;
      title: string;
      content: string;
      steps?: Array<{
        num: string;
        text: string;
      }>;
      items?: string[];
    }>;
  };
}

// IRB members will be loaded from backend

function ResearchProjects(): JSX.Element {
  const navigate = useNavigate()
  const [scrolled, setScrolled] = useState(false)
  const [activeTab, setActiveTab] = useState<'irb' | 'idream' | 'hdss'>('irb')
  const [irb, setIrb] = useState<ResearchProject | null>(null)
  const [idream, setIdream] = useState<ResearchProject | null>(null)
  const [hdss, setHdss] = useState<ResearchProject | null>(null)
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    const h = () => setScrolled(window.scrollY > 10)
    window.addEventListener('scroll', h)
    return () => window.removeEventListener('scroll', h)
  }, [])

  const resolveResearchImage = (path?: string | null): string | undefined => {
    if (!path) return undefined
    if (path.startsWith('http://') || path.startsWith('https://')) return path

    const apiUrl = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api'
    const storageBase = apiUrl.replace(/\/+$/, '').replace(/\/api$/, '') + '/storage'
    const normalized = path.replace(/^\/+/, '').replace(/^storage\/+/, '')
    return `${storageBase}/${normalized}`
  }

  useEffect(() => {
    const fetchData = async () => {
      setLoading(true)
      try {
        let endpoint = ''
        switch (activeTab) {
          case 'irb':
            endpoint = '/api/research/projects/irb'
            break
          case 'idream':
            endpoint = '/api/research/projects/idream'
            break
          case 'hdss':
            endpoint = '/api/research/projects/hdss'
            break
        }

        const response = await fetch(endpoint)
        const result = await response.json()
        
        if (result.success) {
          switch (activeTab) {
            case 'irb':
              setIrb(result.data)
              break
            case 'idream':
              setIdream(result.data)
              break
            case 'hdss':
              setHdss(result.data)
              break
          }
        }
      } catch (error) {
        console.error('Error fetching research project data:', error)
      } finally {
        setLoading(false)
      }
    }

    fetchData()
  }, [activeTab])

  const handleBack = () => {
    navigate('/')
  }

  const renderIRBContent = () => {
    const project = irb
    const legalFramework = project?.legal_framework_content
    const irbStructure = project?.irb_structure_content
    const appointmentTraining = project?.appointment_training_content
    
    return (
      <>
        <div className="rp-hero">
          <div className="rp-badge"><span>⚖️</span><span>Ethical Oversight</span></div>
          <h2 className="rp-hero-title">{project?.title || 'Ensuring Research Integrity & Participant Protection'}</h2>
          <div
            className="rp-hero-desc"
            dangerouslySetInnerHTML={{ __html: sanitizeHtml(project?.content || 'The Institutional Review Board serves as the guardian of ethical standards in research, ensuring all studies protect human subjects while advancing scientific knowledge.') }}
          />
        </div>

        {/* Legal Framework */}
        <section className="rp-section rp-section--white">
          <div className="rp-sec-header">
            <span className="rp-sec-icon">🏛️</span>
            <h2 className="rp-sec-title">Legal & Regulatory Framework</h2>
            <div className="rp-underline"></div>
          </div>
          <div className="rp-card-grid">
            {legalFramework?.cards?.map((card: any, i: number) => (
              <div key={i} className="rp-card">
                <div className="rp-card-head">
                  <div className="rp-card-icon">{card.icon}</div>
                  <h3>{card.title}</h3>
                </div>
                <p dangerouslySetInnerHTML={{ __html: sanitizeHtml(card.content) }}></p>
                {card.items && (
                  <ul className="rp-items-list">
                    {card.items.map((item: any, j: number) => (
                      <li key={j}>{item}</li>
                    ))}
                  </ul>
                )}
              </div>
            ))}
          </div>
        </section>

        {/* IRB Structure */}
        <section className="rp-section rp-section--light">
          <div className="rp-sec-header">
            <span className="rp-sec-icon">👥</span>
            <h2 className="rp-sec-title">Structure of IRB</h2>
            <div className="rp-underline"></div>
          </div>
          <p className="rp-intro-text" dangerouslySetInnerHTML={{ __html: sanitizeHtml(irbStructure?.intro_text ?? '') }}></p>
          <div className="rp-card-grid">
            {irbStructure?.members?.map((member: any, i: number) => (
              <div key={i} className="rp-card">
                <div className="rp-card-head">
                  <div className="rp-card-icon">{member.icon}</div>
                  <h3>{member.title}</h3>
                </div>
                <div dangerouslySetInnerHTML={{ __html: sanitizeHtml(member.desc) }} />
              </div>
            ))}
          </div>
        </section>

        {/* Appointment */}
        <section className="rp-section rp-section--white">
          <div className="rp-sec-header">
            <span className="rp-sec-icon">📅</span>
            <h2 className="rp-sec-title">Appointment & Training</h2>
            <div className="rp-underline"></div>
          </div>
          <div className="rp-grid-2">
            {appointmentTraining?.cards?.map((card: any, i: number) => (
              <div key={i} className="rp-card">
                <div className="rp-card-head">
                  <div className="rp-card-icon">{card.icon}</div>
                  <h3>{card.title}</h3>
                </div>
                <p dangerouslySetInnerHTML={{ __html: sanitizeHtml(card.content) }}></p>
                {card.steps && (
                  <div className="rp-step-list">
                    {card.steps.map((step: any, j: number) => (
                      <div key={j} className="rp-step">
                        <span className="rp-step-num">{step.num}</span>
                        <span>{step.text}</span>
                      </div>
                    ))}
                  </div>
                )}
                {card.items && (
                  <ul className="rp-items-list">
                    {card.items.map((item: any, j: number) => (
                      <li key={j}>{item}</li>
                    ))}
                  </ul>
                )}
              </div>
            ))}
          </div>
        </section>
      </>
    )
  }

  const renderIDreamContent = () => {
    const project = idream
    return (
      <>
        <div className="rp-hero">
          <div className="rp-badge"><span>🔬</span><span>Innovation Hub</span></div>
          <h2 className="rp-hero-title">{project?.title || 'iDream Laboratory'}</h2>
          <div
            className="rp-hero-desc"
            dangerouslySetInnerHTML={{ __html: sanitizeHtml(project?.content || 'The iDream Laboratory serves as an innovation hub for cutting-edge research and development in medical sciences, fostering collaboration between researchers and industry partners.') }}
          />
          {project?.image && <img src={resolveResearchImage(project.image)} alt={project.title} className="rp-hero-image" />}
        </div>

        <section className="rp-section rp-section--white">
          <div className="rp-sec-header">
            <span className="rp-sec-icon">🔬</span>
            <h2 className="rp-sec-title">Research Focus Areas</h2>
            <div className="rp-underline"></div>
          </div>
          <div className="rp-card-grid">
            <div className="rp-card">
              <div className="rp-card-head"><div className="rp-card-icon">💊</div><h3>Drug Discovery</h3></div>
              <p>Advanced research in pharmaceutical development and drug discovery processes.</p>
              <ul className="rp-items-list"><li>Medicinal chemistry</li><li>Preclinical testing</li><li>Clinical trials support</li></ul>
            </div>
            <div className="rp-card">
              <div className="rp-card-head"><div className="rp-card-icon">🧬</div><h3>Genomics Research</h3></div>
              <p>Exploring genetic factors in disease and personalized medicine approaches.</p>
              <ul className="rp-items-list"><li>Genetic sequencing</li><li>Biomarker discovery</li><li>Precision medicine</li></ul>
            </div>
            <div className="rp-card">
              <div className="rp-card-head"><div className="rp-card-icon">🤖</div><h3>Medical Technology</h3></div>
              <p>Developing innovative medical devices and healthcare technologies.</p>
              <ul className="rp-items-list"><li>Medical device innovation</li><li>Healthcare AI applications</li><li>Telemedicine solutions</li></ul>
            </div>
          </div>
        </section>
      </>
    )
  }

  const renderHDSSContent = () => {
    const project = hdss
    return (
      <>
        <div className="rp-hero">
          <div className="rp-badge"><span>📊</span><span>Health Surveillance</span></div>
          <h2 className="rp-hero-title">{project?.title || 'Health and Demographic Surveillance System'}</h2>
          <div
            className="rp-hero-desc"
            dangerouslySetInnerHTML={{ __html: sanitizeHtml(project?.content || 'The HDSS provides comprehensive health and demographic data collection and analysis to support public health research and policy development.') }}
          />
          {project?.image && <img src={resolveResearchImage(project.image)} alt={project.title} className="rp-hero-image" />}
        </div>

        <section className="rp-section rp-section--white">
          <div className="rp-sec-header">
            <span className="rp-sec-icon">📊</span>
            <h2 className="rp-sec-title">Surveillance Activities</h2>
            <div className="rp-underline"></div>
          </div>
          <div className="rp-card-grid">
            <div className="rp-card">
              <div className="rp-card-head"><div className="rp-card-icon">👥</div><h3>Population Monitoring</h3></div>
              <p>Continuous monitoring of demographic changes and population dynamics.</p>
              <ul className="rp-items-list"><li>Birth and death registration</li><li>Migration tracking</li><li>Household surveys</li></ul>
            </div>
            <div className="rp-card">
              <div className="rp-card-head"><div className="rp-card-icon">🏥</div><h3>Health Data Collection</h3></div>
              <p>Comprehensive health data collection from various sources.</p>
              <ul className="rp-items-list"><li>Disease surveillance</li><li>Health service utilization</li><li>Risk factor monitoring</li></ul>
            </div>
            <div className="rp-card">
              <div className="rp-card-head"><div className="rp-card-icon">📈</div><h3>Data Analysis</h3></div>
              <p>Advanced statistical analysis and reporting of health trends.</p>
              <ul className="rp-items-list"><li>Trend analysis</li><li>Risk assessment</li><li>Policy recommendations</li></ul>
            </div>
          </div>
        </section>
      </>
    )
  }

  return (
    <div className="rp-page">
      <header className={`rp-header${scrolled ? ' scrolled' : ''}`}>
        <div className="rp-header-inner">
          <button className="rp-back" onClick={handleBack}>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Home
          </button>
          <h1 className="rp-header-title">Research Projects</h1>
        </div>
      </header>

      {/* Tabs Navigation */}
      <div className="rp-tabs-container">
        <div className="rp-tabs">
          <button 
            className={`rp-tab ${activeTab === 'irb' ? 'active' : ''}`}
            onClick={() => setActiveTab('irb')}
          >
            <span className="rp-tab-icon">⚖️</span>
            Function of IRB
          </button>
          <button 
            className={`rp-tab ${activeTab === 'idream' ? 'active' : ''}`}
            onClick={() => setActiveTab('idream')}
          >
            <span className="rp-tab-icon">🔬</span>
            iDream Lab
          </button>
          <button 
            className={`rp-tab ${activeTab === 'hdss' ? 'active' : ''}`}
            onClick={() => setActiveTab('hdss')}
          >
            <span className="rp-tab-icon">📊</span>
            HDSS
          </button>
        </div>
      </div>

      <main className="rp-main">
        <div className="rp-content">
          {loading ? (
            <div className="rp-loading">
              <div className="rp-spinner"></div>
              <p>Loading content...</p>
            </div>
          ) : (
            <>
              {activeTab === 'irb' && renderIRBContent()}
              {activeTab === 'idream' && renderIDreamContent()}
              {activeTab === 'hdss' && renderHDSSContent()}
            </>
          )}
        </div>
      </main>
    </div>
  )
}

export default ResearchProjects
