import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './Goals.css'

function ResearchGoals(): JSX.Element {
  const navigate = useNavigate()

  const [scrolled, setScrolled] = useState(false)

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 10)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const goals = [
    {
      icon: '🎓',
      title: 'Professional Excellence',
      description: 'Train competent and responsive professionals who can address the community\'s problems through innovative and practical means.',
      details: [
        'Competency-based education',
        'Practical skill development',
        'Problem-solving abilities',
        'Community-focused training'
      ]
    },
    {
      icon: '🌍',
      title: 'Societal Development',
      description: 'Contribute to societal development through the training of responsive professionals, conducting high-quality relevant research, and professional advocacy.',
      details: [
        'Community engagement',
        'Evidence-based research',
        'Professional advocacy',
        'Social responsibility'
      ]
    },
    {
      icon: '⚖️',
      title: 'Educational Equity',
      description: 'Promote the principle of educational equity irrespective of ethnicity, religion, gender or political background.',
      details: [
        'Inclusive education',
        'Equal opportunities',
        'Diversity and inclusion',
        'Fair access policies'
      ]
    },
    {
      icon: '♀️',
      title: 'Women\'s Empowerment',
      description: 'Promote women\'s participation in all spheres of development.',
      details: [
        'Gender equality initiatives',
        'Women leadership programs',
        'Empowerment opportunities',
        'Inclusive development'
      ]
    },
    {
      icon: '🤝',
      title: 'Strategic Partnerships',
      description: 'Strengthen partnerships and linkages with local and international institutions for the purpose of rendering high quality, applied research.',
      details: [
        'International collaborations',
        'Research partnerships',
        'Knowledge exchange',
        'Global networking'
      ]
    }
  ]

  return (
    <div className="research-goals-page">
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
              <h1>Goals</h1>
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
                  <span className="badge-icon">🎯</span>
                  <span className="badge-text">Our Objectives</span>
                </div>
                <h2 className="hero-title">Achieving Excellence Through Strategic Goals</h2>
                <p className="hero-description">
                  Our goals guide us toward becoming a leading institution in healthcare education, 
                  research, and community service across Africa.
                </p>
              </div>
            </section>

            {/* Goals Overview */}
            <section className="goals-overview">
              <div className="section-header">
                <div className="section-icon">🎯</div>
                <h2>Strategic Goals</h2>
                <div className="section-underline"></div>
              </div>
              <div className="overview-content">
                <p className="overview-text">
                  We are committed to achieving these five strategic goals that align with our vision 
                  to become a prestigious academic and research center in Africa by 2030 G.C.
                </p>
                <div className="goals-stats">
                  <div className="stat-item">
                    <div className="stat-number">5</div>
                    <div className="stat-label">Strategic Goals</div>
                  </div>
                  <div className="stat-item">
                    <div className="stat-number">2030</div>
                    <div className="stat-label">Target Year</div>
                  </div>
                  <div className="stat-item">
                    <div className="stat-number">Africa</div>
                    <div className="stat-label">Regional Focus</div>
                  </div>
                </div>
              </div>
            </section>

            {/* Individual Goals */}
            <section className="individual-goals">
              <div className="goals-grid">
                {goals.map((goal, index) => (
                  <div key={index} className="goal-card" style={{ animationDelay: `${index * 0.1}s` }}>
                    <div className="goal-header">
                      <div className="goal-icon">{goal.icon}</div>
                      <h3>{goal.title}</h3>
                    </div>
                    <div className="goal-description">
                      <p>{goal.description}</p>
                    </div>
                    <div className="goal-details">
                      <h4>Key Focus Areas:</h4>
                      <ul>
                        {goal.details.map((detail, detailIndex) => (
                          <li key={detailIndex}>{detail}</li>
                        ))}
                      </ul>
                    </div>
                    <div className="goal-progress">
                      <div className="progress-label">Implementation Progress</div>
                      <div className="progress-bar">
                        <div className="progress-fill" style={{ width: `${Math.random() * 30 + 60}%` }}></div>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </section>

            {/* Implementation Strategy */}
            <section className="implementation-section">
              <div className="section-header">
                <div className="section-icon">🚀</div>
                <h2>Implementation Strategy</h2>
                <div className="section-underline"></div>
              </div>
              <div className="implementation-content">
                <div className="strategy-grid">
                  <div className="strategy-card">
                    <div className="strategy-icon">📋</div>
                    <h3>Strategic Planning</h3>
                    <p>Comprehensive planning with clear milestones and performance indicators</p>
                  </div>
                  <div className="strategy-card">
                    <div className="strategy-icon">👥</div>
                    <h3>Stakeholder Engagement</h3>
                    <p>Active involvement of all stakeholders in goal implementation</p>
                  </div>
                  <div className="strategy-card">
                    <div className="strategy-icon">📊</div>
                    <h3>Monitoring & Evaluation</h3>
                    <p>Regular assessment of progress and impact measurement</p>
                  </div>
                  <div className="strategy-card">
                    <div className="strategy-icon">💰</div>
                    <h3>Resource Allocation</h3>
                    <p>Optimal utilization of available resources for maximum impact</p>
                  </div>
                </div>
              </div>
            </section>

            {/* Impact Metrics */}
            <section className="impact-section">
              <div className="section-header">
                <div className="section-icon">📈</div>
                <h2>Impact Metrics</h2>
                <div className="section-underline"></div>
              </div>
              <div className="impact-content">
                <div className="metrics-grid">
                  <div className="metric-card">
                    <div className="metric-icon">🎓</div>
                    <div className="metric-number">95%</div>
                    <div className="metric-label">Graduate Employment Rate</div>
                    <div className="metric-description">Our graduates successfully employed within 6 months</div>
                  </div>
                  <div className="metric-card">
                    <div className="metric-icon">🔬</div>
                    <div className="metric-number">150+</div>
                    <div className="metric-label">Research Publications</div>
                    <div className="metric-description">Annual research output in peer-reviewed journals</div>
                  </div>
                  <div className="metric-card">
                    <div className="metric-icon">🤝</div>
                    <div className="metric-number">50+</div>
                    <div className="metric-label">Partner Institutions</div>
                    <div className="metric-description">Local and international collaboration partners</div>
                  </div>
                  <div className="metric-card">
                    <div className="metric-icon">🌍</div>
                    <div className="metric-number">1M+</div>
                    <div className="metric-label">Community Impact</div>
                    <div className="metric-description">Lives positively impacted through our programs</div>
                  </div>
                </div>
              </div>
            </section>

            {/* Timeline */}
            <section className="timeline-section">
              <div className="section-header">
                <div className="section-icon">📅</div>
                <h2>Implementation Timeline</h2>
                <div className="section-underline"></div>
              </div>
              <div className="timeline-content">
                <div className="timeline">
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-year">2024</div>
                      <div className="marker-dot"></div>
                    </div>
                    <div className="timeline-content">
                      <h3>Foundation Phase</h3>
                      <p>Establish baseline metrics and initial implementation frameworks</p>
                    </div>
                  </div>
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-year">2026</div>
                      <div className="marker-dot"></div>
                    </div>
                    <div className="timeline-content">
                      <h3>Growth Phase</h3>
                      <p>Scale up successful programs and expand partnerships</p>
                    </div>
                  </div>
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-year">2028</div>
                      <div className="marker-dot"></div>
                    </div>
                    <div className="timeline-content">
                      <h3>Optimization Phase</h3>
                      <p>Refine programs based on feedback and achieved outcomes</p>
                    </div>
                  </div>
                  <div className="timeline-item">
                    <div className="timeline-marker">
                      <div className="marker-year">2030</div>
                      <div className="marker-dot active"></div>
                    </div>
                    <div className="timeline-content">
                      <h3>Achievement Phase</h3>
                      <p>Realize vision as leading medical center in Africa</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* Call to Action */}
            <section className="cta-section">
              <div className="cta-content">
                <h2>Join Our Journey</h2>
                <p>Be part of our mission to transform healthcare education and research in Africa.</p>
                <div className="cta-buttons">
                  <button className="cta-button primary">Support Our Goals</button>
                  <button className="cta-button secondary">Partner With Us</button>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>
    </div>
  )
}

export default ResearchGoals
