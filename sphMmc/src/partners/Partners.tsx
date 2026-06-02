import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './Partners.css'
import { sanitizeHtml } from '../utils/richText'
import PartnershipApplicationForm from './PartnershipApplicationForm'

const API_BASE = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api'

interface Partner {
  id: number
  name: string
  short_description?: string
  full_description?: string
  logo_image_url?: string
  website_url?: string
  partnership_year?: number
  collaboration_type?: string
  is_featured: boolean
  category?: { name: string; slug: string }
}

interface PartnershipStatistic {
  id: number
  title: string
  value: string
  icon_class?: string
}

interface PartnershipArea {
  id: number
  title: string
  description?: string
  icon_class?: string
}

interface SuccessStory {
  id: number
  title: string
  image_url?: string
  summary?: string
  content?: string
}

interface PartnersPage {
  hero_title: string
  hero_subtitle: string
  hero_banner_image_url?: string
  overview_content?: string
}

interface PartnershipDocument {
  id: number
  title: string
  file_url: string
  document_category?: string
  description?: string
}

interface PartnershipContactInfo {
  office_name?: string
  email?: string
  phone?: string
  address?: string
  office_hours?: string
  website_url?: string
}

async function fetchJson<T>(url: string): Promise<T | null> {
  try {
    const res = await fetch(url)
    if (!res.ok) return null
    return (await res.json()) as T
  } catch {
    return null
  }
}

function Partners(): JSX.Element {
  const navigate = useNavigate()
  const [showApplicationForm, setShowApplicationForm] = useState(false)

  const [activeTab, setActiveTab] = useState<'local' | 'external'>('local')

  const [pageSettings, setPageSettings] = useState<PartnersPage | null>(null)
  const [localPartners, setLocalPartners] = useState<Partner[]>([])
  const [externalPartners, setExternalPartners] = useState<Partner[]>([])
  const [featuredPartners, setFeaturedPartners] = useState<Partner[]>([])
  const [statistics, setStatistics] = useState<PartnershipStatistic[]>([])
  const [areas, setAreas] = useState<PartnershipArea[]>([])
  const [stories, setStories] = useState<SuccessStory[]>([])
  const [documents, setDocuments] = useState<PartnershipDocument[]>([])
  const [contactInfo, setContactInfo] = useState<PartnershipContactInfo | null>(null)
  const [loading, setLoading] = useState(true)
  const [carouselIndex, setCarouselIndex] = useState(0)

  useEffect(() => {
    const load = async () => {
      const [
        pageData,
        localData,
        externalData,
        featuredData,
        statsData,
        areasData,
        storiesData,
        docsData,
        contactData,
      ] = await Promise.all([
        fetchJson<PartnersPage>(`${API_BASE}/partners/page`),
        fetchJson<{ data: Partner[] }>(`${API_BASE}/partners/local`),
        fetchJson<{ data: Partner[] }>(`${API_BASE}/partners/external`),
        fetchJson<{ data: Partner[] }>(`${API_BASE}/partners/featured`),
        fetchJson<{ data: PartnershipStatistic[] }>(`${API_BASE}/partnership-statistics`),
        fetchJson<{ data: PartnershipArea[] }>(`${API_BASE}/partnership-areas`),
        fetchJson<{ data: SuccessStory[] }>(`${API_BASE}/success-stories`),
        fetchJson<{ data: PartnershipDocument[] }>(`${API_BASE}/partnership-documents`),
        fetchJson<PartnershipContactInfo>(`${API_BASE}/partnership-contact`),
      ])

      if (pageData) setPageSettings(pageData)
      setLocalPartners(localData?.data ?? [])
      setExternalPartners(externalData?.data ?? [])
      setFeaturedPartners(featuredData?.data ?? [])
      setStatistics(statsData?.data ?? [])
      setAreas(areasData?.data ?? [])
      setStories(storiesData?.data ?? [])
      setDocuments(docsData?.data ?? [])
      if (contactData) setContactInfo(contactData)
      setLoading(false)
    }

    load()
  }, [])

  useEffect(() => {
    if (featuredPartners.length === 0) return
    const timer = setInterval(() => {
      setCarouselIndex((prev) => (prev + 1) % featuredPartners.length)
    }, 5000)
    return () => clearInterval(timer)
  }, [featuredPartners.length])

  const currentPartners = activeTab === 'local' ? localPartners : externalPartners

  const sectionNav = [
    { id: 'overview', label: 'Overview', show: Boolean(pageSettings?.overview_content) },
    { id: 'impact', label: 'Impact', show: true },
    { id: 'partners', label: 'Partners', show: true },
    { id: 'featured', label: 'Featured', show: true },
    { id: 'areas', label: 'Collaboration Areas', show: true },
    { id: 'stories', label: 'Success Stories', show: true },
    { id: 'documents', label: 'Documents', show: true },
    { id: 'contact', label: 'Contact', show: true },
  ].filter((s) => s.show)

  const scrollToSection = (id: string) => {
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }

  const SectionHead = ({ title }: { title: string }) => (
    <header className="partners-section__head">
      <h2>{title}</h2>
      <div className="partners-section__line" />
    </header>
  )

  const heroStyle = pageSettings?.hero_banner_image_url
    ? { backgroundImage: `linear-gradient(135deg, rgba(29, 45, 106, 0.92) 0%, rgba(0, 0, 128, 0.85) 100%), url(${pageSettings.hero_banner_image_url})` }
    : undefined

  if (loading) {
    return (
      <div className="partners-page">
        <div className="partners-loading">
          <div className="partners-loading__spinner" />
          <p>Loading partnerships…</p>
        </div>
      </div>
    )
  }

  return (
    <div className="partners-page">
      <div className="partners-page__toolbar">
        <button type="button" className="partners-back" onClick={() => navigate('/')}>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" aria-hidden>
            <path d="M19 12H5M12 19l-7-7 7-7" />
          </svg>
          Back to Home
        </button>
        <nav className="partners-breadcrumb" aria-label="Breadcrumb">
          <button type="button" onClick={() => navigate('/')}>Home</button>
          <span>/</span>
          <span aria-current="page">Partnerships</span>
        </nav>
      </div>

      <section className="partners-hero" style={heroStyle}>
        <div className="partners-hero__inner">
          <span className="partners-hero__badge">Global Collaboration</span>
          <h1 className="partners-hero__title">
            {pageSettings?.hero_title || 'Building Excellence Through Partnerships'}
          </h1>
          <p className="partners-hero__subtitle">
            {pageSettings?.hero_subtitle || 'Global Collaboration for Healthcare Excellence'}
          </p>
        </div>
      </section>

      <nav className="partners-section-nav" aria-label="Page sections">
        {sectionNav.map((item) => (
          <button key={item.id} type="button" onClick={() => scrollToSection(item.id)}>
            {item.label}
          </button>
        ))}
      </nav>

      <main className="partners-body">
        {pageSettings?.overview_content && (
          <section id="overview" className="partners-section">
            <SectionHead title="About Our Partnerships" />
            <div
              className="partners-overview partners-rich-text"
              dangerouslySetInnerHTML={{ __html: sanitizeHtml(pageSettings.overview_content) }}
            />
          </section>
        )}

        <section id="impact" className="partners-section">
          <SectionHead title="Our Impact" />
          {statistics.length > 0 ? (
            <div className="partners-stats">
              {statistics.map((stat, index) => (
                <article key={stat.id} className="partners-stat" style={{ animationDelay: `${index * 0.08}s` }}>
                  <span className="partners-stat__icon">{stat.icon_class || '📈'}</span>
                  <span className="partners-stat__value">{stat.value}</span>
                  <span className="partners-stat__label">{stat.title}</span>
                </article>
              ))}
            </div>
          ) : (
            <p className="partners-empty">Partnership statistics will appear here once added in the admin panel.</p>
          )}
        </section>

        <section id="partners" className="partners-section">
          <SectionHead title="Partner Institutions" />
          <div className="partners-tabs">
            <button
              type="button"
              className={`partners-tabs__btn ${activeTab === 'local' ? 'partners-tabs__btn--active' : ''}`}
              onClick={() => setActiveTab('local')}
            >
              Local Partners
            </button>
            <button
              type="button"
              className={`partners-tabs__btn ${activeTab === 'external' ? 'partners-tabs__btn--active' : ''}`}
              onClick={() => setActiveTab('external')}
            >
              International Partners
            </button>
          </div>

          {currentPartners.length > 0 ? (
            <div className="partners-grid">
              {currentPartners.map((partner, index) => (
                <article key={partner.id} className="partners-card" style={{ animationDelay: `${index * 0.05}s` }}>
                  {partner.logo_image_url && (
                    <img src={partner.logo_image_url} alt="" className="partners-card__logo" />
                  )}
                  <h3>{partner.name}</h3>
                  {partner.short_description && <p>{partner.short_description}</p>}
                  <div className="partners-card__meta">
                    {partner.partnership_year && <span>Since {partner.partnership_year}</span>}
                    {partner.collaboration_type && <span>{partner.collaboration_type}</span>}
                  </div>
                  {partner.website_url && (
                    <a href={partner.website_url} target="_blank" rel="noopener noreferrer" className="partners-card__link">
                      Visit website ↗
                    </a>
                  )}
                  {partner.is_featured && <span className="partners-card__featured">Featured</span>}
                </article>
              ))}
            </div>
          ) : (
            <p className="partners-empty">No {activeTab === 'local' ? 'local' : 'international'} partners listed yet.</p>
          )}
        </section>

        <section id="featured" className="partners-section partners-featured">
          <SectionHead title="Featured Partners" />
          {featuredPartners.length > 0 ? (
            <div className="partners-carousel">
              <div className="partners-carousel__slide">
                {featuredPartners[carouselIndex]?.logo_image_url && (
                  <img
                    src={featuredPartners[carouselIndex].logo_image_url}
                    alt={featuredPartners[carouselIndex].name}
                    className="partners-carousel__logo"
                  />
                )}
                <div>
                  <h3>{featuredPartners[carouselIndex]?.name}</h3>
                  <p>{featuredPartners[carouselIndex]?.short_description}</p>
                  {featuredPartners[carouselIndex]?.website_url && (
                    <a
                      href={featuredPartners[carouselIndex].website_url}
                      target="_blank"
                      rel="noopener noreferrer"
                    >
                      Learn more ↗
                    </a>
                  )}
                </div>
              </div>
              <div className="partners-carousel__nav">
                <button type="button" onClick={() => setCarouselIndex((p) => (p - 1 + featuredPartners.length) % featuredPartners.length)} aria-label="Previous">←</button>
                <div className="partners-carousel__dots">
                  {featuredPartners.map((_, idx) => (
                    <button
                      key={idx}
                      type="button"
                      className={idx === carouselIndex ? 'is-active' : ''}
                      onClick={() => setCarouselIndex(idx)}
                      aria-label={`Slide ${idx + 1}`}
                    />
                  ))}
                </div>
                <button type="button" onClick={() => setCarouselIndex((p) => (p + 1) % featuredPartners.length)} aria-label="Next">→</button>
              </div>
            </div>
          ) : (
            <p className="partners-empty">Featured partners will appear here once selected in the admin panel.</p>
          )}
        </section>

        <section id="areas" className="partners-section">
          <SectionHead title="Areas of Collaboration" />
          {areas.length > 0 ? (
            <div className="partners-areas">
              {areas.map((area, index) => (
                <article key={area.id} className="partners-area" style={{ animationDelay: `${index * 0.06}s` }}>
                  <span className="partners-area__icon">{area.icon_class || '✨'}</span>
                  <h3>{area.title}</h3>
                  {area.description && (
                    <div
                      className="partners-rich-text"
                      dangerouslySetInnerHTML={{ __html: sanitizeHtml(area.description) }}
                    />
                  )}
                </article>
              ))}
            </div>
          ) : (
            <p className="partners-empty">Collaboration areas will appear here once added in the admin panel.</p>
          )}
        </section>

        <section id="stories" className="partners-section">
          <SectionHead title="Success Stories" />
          {stories.length > 0 ? (
            <div className="partners-stories">
              {stories.map((story, index) => (
                <article key={story.id} className="partners-story" style={{ animationDelay: `${index * 0.06}s` }}>
                  {story.image_url && <img src={story.image_url} alt="" />}
                  <div>
                    <h3>{story.title}</h3>
                    {story.summary && <p>{story.summary}</p>}
                    {story.content && (
                      <div
                        className="partners-story__body partners-rich-text"
                        dangerouslySetInnerHTML={{ __html: sanitizeHtml(story.content) }}
                      />
                    )}
                  </div>
                </article>
              ))}
            </div>
          ) : (
            <p className="partners-empty">Success stories will appear here once published in the admin panel.</p>
          )}
        </section>

        <section id="documents" className="partners-section">
          <SectionHead title="Partnership Documents" />
          {documents.length > 0 ? (
            <div className="partners-docs">
              {documents.map((doc) => (
                <article key={doc.id} className="partners-doc">
                  <span className="partners-doc__icon">📄</span>
                  <h3>{doc.title}</h3>
                  {doc.description && (
                    <div
                      className="partners-rich-text"
                      dangerouslySetInnerHTML={{ __html: sanitizeHtml(doc.description) }}
                    />
                  )}
                  {doc.document_category && (
                    <span className="partners-doc__tag">{doc.document_category}</span>
                  )}
                  <a
                    href={doc.file_url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="partners-doc__download"
                  >
                    Open document ↗
                  </a>
                </article>
              ))}
            </div>
          ) : (
            <p className="partners-empty">MoUs, agreements, and reports will appear here once uploaded in the admin panel.</p>
          )}
        </section>

        <section id="contact" className="partners-section partners-contact">
          <SectionHead title="Get in Touch" />
          <div className="partners-contact__grid">
            {contactInfo && (
              <div className="partners-contact__card">
                <h3>{contactInfo.office_name || 'Partnership Office'}</h3>
                {contactInfo.email && (
                  <p>
                    <strong>Email:</strong>{' '}
                    <a href={`mailto:${contactInfo.email}`}>{contactInfo.email}</a>
                  </p>
                )}
                {contactInfo.phone && (
                  <p>
                    <strong>Phone:</strong>{' '}
                    <a href={`tel:${contactInfo.phone}`}>{contactInfo.phone}</a>
                  </p>
                )}
                {contactInfo.address && (
                  <p>
                    <strong>Address:</strong> {contactInfo.address}
                  </p>
                )}
                {contactInfo.office_hours && (
                  <p>
                    <strong>Hours:</strong> {contactInfo.office_hours}
                  </p>
                )}
              </div>
            )}
            <div className="partners-contact__cta">
              <h3>Interested in partnering?</h3>
              <p>We welcome collaborations that advance healthcare excellence and research innovation.</p>
              <button
                type="button"
                className="partners-contact__btn"
                onClick={() => setShowApplicationForm(true)}
              >
                Become a partner with SPHMMC
              </button>
              {contactInfo?.email && (
                <a href={`mailto:${contactInfo.email}`} className="partners-contact__link">
                  Or email the partnership office
                </a>
              )}
            </div>
          </div>
        </section>
      </main>

      <PartnershipApplicationForm
        isOpen={showApplicationForm}
        onClose={() => setShowApplicationForm(false)}
      />
    </div>
  )
}

export default Partners
