import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { sanitizeHtml } from '../utils/richText';
import './ResearchProjectsV2.css';

interface CTAButton {
  text: string;
  url: string;
  type: 'primary' | 'secondary';
}

interface ProjectFunction {
  id: number;
  title: string;
  description: string;
  icon?: string;
  features?: string[];
}

interface WorkflowStep {
  id: number;
  title: string;
  description: string;
  step_number: number;
  icon?: string;
  estimated_time?: string;
  requirements?: string[];
}

interface Resource {
  id: number;
  title: string;
  description?: string;
  file_url?: string;
  file_type?: string;
  file_size?: string;
  icon?: string;
}

interface Statistic {
  id: number;
  label: string;
  value: string;
  description?: string;
  icon?: string;
  color?: string;
}

interface TeamMember {
  id: number;
  name: string;
  role: string;
  bio?: string;
  image_url?: string;
  email?: string;
  phone?: string;
}

interface FAQ {
  id: number;
  question: string;
  answer: string;
}

interface ResearchProject {
  id: number;
  project_type: string;
  title: string;
  subtitle?: string;
  overview?: string;
  hero_image_url?: string;
  cta_buttons?: CTAButton[];
  contact_email?: string;
  contact_phone?: string;
  contact_address?: string;
  office_hours?: string;
  functions?: ProjectFunction[];
  workflows?: WorkflowStep[];
  resources?: Resource[];
  statistics?: Statistic[];
  teamMembers?: TeamMember[];
  faqs?: FAQ[];
}

const ResearchProjectsV2: React.FC = () => {
  const navigate = useNavigate();
  const [scrolled, setScrolled] = useState(false);
  const [activeTab, setActiveTab] = useState<'irb' | 'idream' | 'hdss'>('irb');
  const [projects, setProjects] = useState<{
    irb?: ResearchProject;
    idream?: ResearchProject;
    hdss?: ResearchProject;
  }>({});
  const [loading, setLoading] = useState(false);
  const [activeAccordion, setActiveAccordion] = useState<number | null>(null);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 10);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      setLoading(true)
      try {
        const response = await fetch(`/api/research/projects/${activeTab}`)
        const result = await response.json()
        
        if (result.success) {
          setProjects(prev => ({
            ...prev,
            [activeTab]: result.data
          }))
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
    navigate('/');
  };

  const currentProject = projects[activeTab];

  const renderHeroSection = () => {
    if (!currentProject) return null;

    return (
      <section className="rpv2-hero">
        <div className="rpv2-hero-bg">
          {currentProject.hero_image_url && (
            <img 
              src={currentProject.hero_image_url} 
              alt={currentProject.title}
              className="rpv2-hero-image"
            />
          )}
          <div className="rpv2-hero-overlay"></div>
        </div>
        <div className="rpv2-container">
          <div className="rpv2-hero-content">
            <div className="rpv2-hero-badge">
              <span className="rpv2-hero-badge-icon">
                {activeTab === 'irb' && '⚖️'}
                {activeTab === 'idream' && '🔬'}
                {activeTab === 'hdss' && '📊'}
              </span>
              <span className="rpv2-hero-badge-text">
                {activeTab === 'irb' && 'Ethical Research'}
                {activeTab === 'idream' && 'Innovation Lab'}
                {activeTab === 'hdss' && 'Health Surveillance'}
              </span>
            </div>
            <h1 className="rpv2-hero-title">{currentProject.title}</h1>
            {currentProject.subtitle && (
              <p className="rpv2-hero-subtitle">{currentProject.subtitle}</p>
            )}
            {currentProject.cta_buttons && currentProject.cta_buttons.length > 0 && (
              <div className="rpv2-hero-actions">
                {currentProject.cta_buttons.map((button, index) => (
                  <a
                    key={index}
                    href={button.url}
                    className={`rpv2-btn rpv2-btn-${button.type}`}
                  >
                    {button.text}
                  </a>
                ))}
              </div>
            )}
          </div>
        </div>
      </section>
    );
  };

  const renderOverviewSection = () => {
    if (!currentProject?.overview) return null;

    return (
      <section className="rpv2-section rpv2-overview">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Overview</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div 
            className="rpv2-overview-content"
            dangerouslySetInnerHTML={{ __html: sanitizeHtml(currentProject.overview) }}
          />
        </div>
      </section>
    );
  };

  const renderFunctionsSection = () => {
    if (!currentProject?.functions || currentProject.functions.length === 0) return null;

    return (
      <section className="rpv2-section rpv2-functions">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Key Functions & Services</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div className="rpv2-functions-grid">
            {currentProject.functions.map((func) => (
              <div key={func.id} className="rpv2-function-card">
                <div className="rpv2-function-icon">
                  {func.icon || '🔧'}
                </div>
                <h3 className="rpv2-function-title">{func.title}</h3>
                <p className="rpv2-function-description">{func.description}</p>
                {func.features && func.features.length > 0 && (
                  <ul className="rpv2-function-features">
                    {func.features.map((feature, index) => (
                      <li key={index}>{feature}</li>
                    ))}
                  </ul>
                )}
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  };

  const renderWorkflowSection = () => {
    if (!currentProject?.workflows || currentProject.workflows.length === 0) return null;

    const sortedWorkflows = [...currentProject.workflows].sort((a, b) => a.step_number - b.step_number);

    return (
      <section className="rpv2-section rpv2-workflow">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Process Workflow</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div className="rpv2-timeline">
            {sortedWorkflows.map((step, index) => (
              <div key={step.id} className="rpv2-timeline-item">
                <div className="rpv2-timeline-marker">
                  <div className="rpv2-timeline-number">{step.step_number}</div>
                  <div className="rpv2-timeline-icon">{step.icon || '📋'}</div>
                </div>
                <div className="rpv2-timeline-content">
                  <h3 className="rpv2-timeline-title">{step.title}</h3>
                  <div 
                    className="rpv2-timeline-description"
                    dangerouslySetInnerHTML={{ __html: sanitizeHtml(step.description) }}
                  />
                  {step.estimated_time && (
                    <div className="rpv2-timeline-time">
                      <span className="rpv2-timeline-time-icon">⏱️</span>
                      Estimated Time: {step.estimated_time}
                    </div>
                  )}
                  {step.requirements && step.requirements.length > 0 && (
                    <div className="rpv2-timeline-requirements">
                      <strong>Requirements:</strong>
                      <ul>
                        {step.requirements.map((req, reqIndex) => (
                          <li key={reqIndex}>{req}</li>
                        ))}
                      </ul>
                    </div>
                  )}
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  };

  const renderResourcesSection = () => {
    if (!currentProject?.resources || currentProject.resources.length === 0) return null;

    return (
      <section className="rpv2-section rpv2-resources">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Resources & Documents</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div className="rpv2-resources-grid">
            {currentProject.resources.map((resource) => (
              <div key={resource.id} className="rpv2-resource-card">
                <div className="rpv2-resource-icon">
                  {resource.icon || '📄'}
                </div>
                <div className="rpv2-resource-content">
                  <h3 className="rpv2-resource-title">{resource.title}</h3>
                  {resource.description && (
                    <p className="rpv2-resource-description">{resource.description}</p>
                  )}
                  {resource.file_size && (
                    <span className="rpv2-resource-size">{resource.file_size}</span>
                  )}
                </div>
                {resource.file_url && (
                  <a 
                    href={resource.file_url} 
                    className="rpv2-resource-download"
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <span>Download</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                      <polyline points="7,10 12,15 17,10"/>
                      <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                  </a>
                )}
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  };

  const renderStatisticsSection = () => {
    if (!currentProject?.statistics || currentProject.statistics.length === 0) return null;

    return (
      <section className="rpv2-section rpv2-statistics">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Key Statistics</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div className="rpv2-statistics-grid">
            {currentProject.statistics.map((stat) => (
              <div key={stat.id} className="rpv2-statistic-card">
                <div className="rpv2-statistic-icon" style={{ color: stat.color }}>
                  {stat.icon || '📊'}
                </div>
                <div className="rpv2-statistic-value">{stat.value}</div>
                <div className="rpv2-statistic-label">{stat.label}</div>
                {stat.description && (
                  <div className="rpv2-statistic-description">{stat.description}</div>
                )}
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  };

  const renderTeamSection = () => {
    if (!currentProject?.teamMembers || currentProject.teamMembers.length === 0) return null;

    return (
      <section className="rpv2-section rpv2-team">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Our Team</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div className="rpv2-team-grid">
            {currentProject.teamMembers.map((member) => (
              <div key={member.id} className="rpv2-team-card">
                <div className="rpv2-team-image">
                  {member.image_url ? (
                    <img src={member.image_url} alt={member.name} />
                  ) : (
                    <div className="rpv2-team-placeholder">
                      <span>👤</span>
                    </div>
                  )}
                </div>
                <div className="rpv2-team-content">
                  <h3 className="rpv2-team-name">{member.name}</h3>
                  <p className="rpv2-team-role">{member.role}</p>
                  {member.bio && (
                    <p className="rpv2-team-bio">{member.bio}</p>
                  )}
                  <div className="rpv2-team-contact">
                    {member.email && (
                      <a href={`mailto:${member.email}`} className="rpv2-team-contact-item">
                        <span>📧</span>
                        {member.email}
                      </a>
                    )}
                    {member.phone && (
                      <a href={`tel:${member.phone}`} className="rpv2-team-contact-item">
                        <span>📞</span>
                        {member.phone}
                      </a>
                    )}
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  };

  const renderFAQSection = () => {
    if (!currentProject?.faqs || currentProject.faqs.length === 0) return null;

    return (
      <section className="rpv2-section rpv2-faq">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Frequently Asked Questions</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div className="rpv2-faq-list">
            {currentProject.faqs.map((faq) => (
              <div key={faq.id} className="rpv2-faq-item">
                <button
                  className={`rpv2-faq-question ${activeAccordion === faq.id ? 'active' : ''}`}
                  onClick={() => setActiveAccordion(activeAccordion === faq.id ? null : faq.id)}
                >
                  <span>{faq.question}</span>
                  <svg 
                    className="rpv2-faq-icon"
                    width="20" 
                    height="20" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    strokeWidth="2"
                  >
                    <polyline points="6,9 12,15 18,9"/>
                  </svg>
                </button>
                <div className={`rpv2-faq-answer ${activeAccordion === faq.id ? 'active' : ''}`}>
                  <div 
                    className="rpv2-faq-answer-content"
                    dangerouslySetInnerHTML={{ __html: sanitizeHtml(faq.answer) }}
                  />
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  };

  const renderContactSection = () => {
    if (!currentProject || (!currentProject.contact_email && !currentProject.contact_phone && !currentProject.contact_address && !currentProject.office_hours)) {
      return null;
    }

    return (
      <section className="rpv2-section rpv2-contact">
        <div className="rpv2-container">
          <div className="rpv2-section-header">
            <h2 className="rpv2-section-title">Contact Information</h2>
            <div className="rpv2-section-divider"></div>
          </div>
          <div className="rpv2-contact-grid">
            {currentProject.contact_email && (
              <div className="rpv2-contact-item">
                <div className="rpv2-contact-icon">📧</div>
                <div className="rpv2-contact-content">
                  <h3>Email</h3>
                  <a href={`mailto:${currentProject.contact_email}`}>
                    {currentProject.contact_email}
                  </a>
                </div>
              </div>
            )}
            {currentProject.contact_phone && (
              <div className="rpv2-contact-item">
                <div className="rpv2-contact-icon">📞</div>
                <div className="rpv2-contact-content">
                  <h3>Phone</h3>
                  <a href={`tel:${currentProject.contact_phone}`}>
                    {currentProject.contact_phone}
                  </a>
                </div>
              </div>
            )}
            {currentProject.contact_address && (
              <div className="rpv2-contact-item">
                <div className="rpv2-contact-icon">📍</div>
                <div className="rpv2-contact-content">
                  <h3>Address</h3>
                  <p>{currentProject.contact_address}</p>
                </div>
              </div>
            )}
            {currentProject.office_hours && (
              <div className="rpv2-contact-item">
                <div className="rpv2-contact-icon">🕒</div>
                <div className="rpv2-contact-content">
                  <h3>Office Hours</h3>
                  <p>{currentProject.office_hours}</p>
                </div>
              </div>
            )}
          </div>
        </div>
      </section>
    );
  };

  return (
    <div className="rpv2-page">
      {/* Header */}
      <header className={`rpv2-header ${scrolled ? 'scrolled' : ''}`}>
        <div className="rpv2-container">
          <div className="rpv2-header-content">
            <button className="rpv2-back-btn" onClick={handleBack}>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
              </svg>
              Back to Home
            </button>
            <h1 className="rpv2-header-title">Research Projects</h1>
          </div>
        </div>
      </header>

      {/* Navigation Tabs */}
      <nav className="rpv2-nav">
        <div className="rpv2-container">
          <div className="rpv2-nav-tabs">
            <button 
              className={`rpv2-nav-tab ${activeTab === 'irb' ? 'active' : ''}`}
              onClick={() => setActiveTab('irb')}
            >
              <span className="rpv2-nav-tab-icon">⚖️</span>
              <span className="rpv2-nav-tab-text">Function of IRB</span>
            </button>
            <button 
              className={`rpv2-nav-tab ${activeTab === 'idream' ? 'active' : ''}`}
              onClick={() => setActiveTab('idream')}
            >
              <span className="rpv2-nav-tab-icon">🔬</span>
              <span className="rpv2-nav-tab-text">iDream Lab</span>
            </button>
            <button 
              className={`rpv2-nav-tab ${activeTab === 'hdss' ? 'active' : ''}`}
              onClick={() => setActiveTab('hdss')}
            >
              <span className="rpv2-nav-tab-icon">📊</span>
              <span className="rpv2-nav-tab-text">HDSS</span>
            </button>
          </div>
        </div>
      </nav>

      {/* Main Content */}
      <main className="rpv2-main">
        {loading ? (
          <div className="rpv2-loading">
            <div className="rpv2-spinner"></div>
            <p>Loading content...</p>
          </div>
        ) : (
          <>
            {renderHeroSection()}
            {renderOverviewSection()}
            {renderFunctionsSection()}
            {renderWorkflowSection()}
            {renderResourcesSection()}
            {renderStatisticsSection()}
            {renderTeamSection()}
            {renderFAQSection()}
            {renderContactSection()}
          </>
        )}
      </main>
    </div>
  );
};

export default ResearchProjectsV2;