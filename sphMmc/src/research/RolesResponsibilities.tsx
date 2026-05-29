import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import DOMPurify from 'dompurify'
import './RolesResponsibilities.css'

interface HeroData {
  id?: number
  title?: string
  subtitle?: string
  content?: string
  image?: string
  cta_button_text?: string
  cta_button_link?: string
}

interface Category {
  id: number
  title: string
  icon?: string
  image?: string
  summary: string
  detailed_content: string
}

interface Process {
  id: number
  title: string
  description: string
  step_number: number
  icon?: string
}

interface Policy {
  id: number
  title: string
  description?: string
  file_path: string
  file_url: string
  file_type: string
  category?: string
}

interface FAQ {
  id: number
  question: string
  answer: string
}

interface Statistic {
  id: number
  label: string
  value: string
  icon?: string
  description?: string
}

interface Contact {
  id?: number
  office_name: string
  office_location?: string
  email?: string
  phone?: string
  office_hours?: string
  website?: string
  additional_info?: string
}

function RolesResponsibilities(): JSX.Element {
  const navigate = useNavigate()
  const [scrolled, setScrolled] = useState(false)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  
  const [hero, setHero] = useState<HeroData | null>(null)
  const [overview, setOverview] = useState<HeroData | null>(null)
  const [categories, setCategories] = useState<Category[]>([])
  const [processes, setProcesses] = useState<Process[]>([])
  const [policies, setPolicies] = useState<Policy[]>([])
  const [faqs, setFaqs] = useState<FAQ[]>([])
  const [statistics, setStatistics] = useState<Statistic[]>([])
  const [contact, setContact] = useState<Contact | null>(null)
  const [expandedFaq, setExpandedFaq] = useState<number | null>(null)

  useEffect(() => {
    const h = () => setScrolled(window.scrollY > 10)
    window.addEventListener('scroll', h)
    return () => window.removeEventListener('scroll', h)
  }, [])

  useEffect(() => {
    fetchData()
  }, [])

  const fetchData = async () => {
    try {
      setLoading(true)
      const response = await fetch('/api/research/roles-responsibility/all')
      
      if (!response.ok) {
        throw new Error('Failed to fetch data')
      }
      
      const result = await response.json()
      
      if (result.success && result.data) {
        setHero(result.data.hero)
        setOverview(result.data.overview)
        setCategories(result.data.categories || [])
        setProcesses(result.data.processes || [])
        setPolicies(result.data.policies || [])
        setFaqs(result.data.faqs || [])
        setStatistics(result.data.statistics || [])
        setContact(result.data.contact)
      }
    } catch (err) {
      console.error('Error fetching data:', err)
      setError('Failed to load page content')
    } finally {
      setLoading(false)
    }
  }

  if (loading) {
    return (
      <div className="rp-page">
        <div style={{ padding: '4rem 2rem', textAlign: 'center', color: '#666' }}>
          Loading...
        </div>
      </div>
    )
  }

  if (error) {
    return (
      <div className="rp-page">
        <div style={{ padding: '4rem 2rem', textAlign: 'center', color: '#dc3545' }}>
          {error}
        </div>
      </div>
    )
  }

  return (
    <div className="rp-page">
      <header className={`rp-header${scrolled ? ' scrolled' : ''}`}>
        <div className="rp-header-inner">
          <button className="rp-back" onClick={() => navigate('/')}>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Research
          </button>
          <h1 className="rp-header-title">{hero?.title || 'Roles & Responsibilities'}</h1>
        </div>
      </header>

      <main className="rp-main">
        <div className="rp-content">

          {/* Hero Section */}
          {hero && (
            <div className="rp-hero" style={hero.image ? { backgroundImage: `url(${hero.image})`, backgroundSize: 'cover', backgroundPosition: 'center' } : {}}>
              <div className="rp-hero-overlay"></div>
              <div className="rp-hero-inner">
                <h2 className="rp-hero-title">{hero.subtitle || hero.title}</h2>
                {hero.content && (
                  <p className="rp-hero-desc" dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(hero.content) }}></p>
                )}
                {hero.cta_button_text && hero.cta_button_link && (
                  <button className="rp-btn-primary" onClick={() => navigate(hero.cta_button_link || '/')}>
                    {hero.cta_button_text}
                  </button>
                )}
              </div>
            </div>
          )}

          {/* Overview Section */}
          {overview?.content && (
            <section className="rp-section rp-section--light">
              <div className="rp-sec-header">
                <h2 className="rp-sec-title">Overview</h2>
                <div className="rp-underline"></div>
              </div>
              <div className="rp-overview-content" dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(overview.content) }}></div>
            </section>
          )}

          {/* Categories Section */}
          {categories.length > 0 && (
            <section className="rp-section rp-section--white">
              <div className="rp-sec-header">
                <h2 className="rp-sec-title">Responsibility Categories</h2>
                <div className="rp-underline"></div>
              </div>
              <div className="rp-card-grid">
                {categories.map((category) => (
                  <div key={category.id} className="rp-card">
                    <div className="rp-card-head">
                      {category.icon && <div className="rp-card-icon">{category.icon}</div>}
                      <h3>{category.title}</h3>
                    </div>
                    <p>{category.summary}</p>
                    {category.detailed_content && (
                      <div className="rp-card-details" dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(category.detailed_content) }}></div>
                    )}
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Process Timeline */}
          {processes.length > 0 && (
            <section className="rp-section rp-section--light">
              <div className="rp-sec-header">
                <h2 className="rp-sec-title">Workflow & Process</h2>
                <div className="rp-underline"></div>
              </div>
              <div className="rp-timeline">
                {processes.map((proc, idx) => (
                  <div key={proc.id} className="rp-timeline-item">
                    <div className="rp-timeline-marker">{proc.icon || `${proc.step_number}`}</div>
                    <div className="rp-timeline-content">
                      <h4>{proc.title}</h4>
                      <p dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(proc.description) }}></p>
                    </div>
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Policies Section */}
          {policies.length > 0 && (
            <section className="rp-section rp-section--white">
              <div className="rp-sec-header">
                <h2 className="rp-sec-title">Policies & Guidelines</h2>
                <div className="rp-underline"></div>
              </div>
              <div className="rp-policies-grid">
                {policies.map((policy) => (
                  <div key={policy.id} className="rp-policy-card">
                    <div className="rp-policy-icon">📄</div>
                    <h4>{policy.title}</h4>
                    {policy.description && <p>{policy.description}</p>}
                    <a href={policy.file_url} target="_blank" rel="noopener noreferrer" className="rp-btn-secondary">
                      Download ({policy.file_type.toUpperCase()})
                    </a>
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Statistics Section */}
          {statistics.length > 0 && (
            <section className="rp-section rp-section--light">
              <div className="rp-sec-header">
                <h2 className="rp-sec-title">Key Statistics</h2>
                <div className="rp-underline"></div>
              </div>
              <div className="rp-grid-4">
                {statistics.map((stat) => (
                  <div key={stat.id} className="rp-stat-card">
                    {stat.icon && <span className="rp-stat-icon">{stat.icon}</span>}
                    <div className="rp-stat-num">{stat.value}</div>
                    <div className="rp-stat-label">{stat.label}</div>
                    {stat.description && <p className="rp-stat-desc">{stat.description}</p>}
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* FAQ Section */}
          {faqs.length > 0 && (
            <section className="rp-section rp-section--white">
              <div className="rp-sec-header">
                <h2 className="rp-sec-title">Frequently Asked Questions</h2>
                <div className="rp-underline"></div>
              </div>
              <div className="rp-accordion">
                {faqs.map((faq) => (
                  <div key={faq.id} className="rp-accordion-item">
                    <button
                      className="rp-accordion-trigger"
                      onClick={() => setExpandedFaq(expandedFaq === faq.id ? null : faq.id)}
                    >
                      <span>{faq.question}</span>
                      <span className={`rp-accordion-icon ${expandedFaq === faq.id ? 'open' : ''}`}>▼</span>
                    </button>
                    {expandedFaq === faq.id && (
                      <div className="rp-accordion-content" dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(faq.answer) }}></div>
                    )}
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Contact Section */}
          {contact && (
            <section className="rp-section rp-section--light">
              <div className="rp-sec-header">
                <h2 className="rp-sec-title">Contact Information</h2>
                <div className="rp-underline"></div>
              </div>
              <div className="rp-contact-card">
                <h3>{contact.office_name}</h3>
                {contact.office_location && <p><strong>Location:</strong> {contact.office_location}</p>}
                {contact.email && <p><strong>Email:</strong> <a href={`mailto:${contact.email}`}>{contact.email}</a></p>}
                {contact.phone && <p><strong>Phone:</strong> <a href={`tel:${contact.phone}`}>{contact.phone}</a></p>}
                {contact.office_hours && <p><strong>Office Hours:</strong> {contact.office_hours}</p>}
                {contact.website && <p><strong>Website:</strong> <a href={contact.website} target="_blank" rel="noopener noreferrer">{contact.website}</a></p>}
                {contact.additional_info && (
                  <div className="rp-additional-info" dangerouslySetInnerHTML={{ __html: DOMPurify.sanitize(contact.additional_info) }}></div>
                )}
              </div>
            </section>
          )}

        </div>
      </main>
    </div>
  )
}

export default RolesResponsibilities
