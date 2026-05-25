import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './Goals.css'

const goals = [
  { icon:'🎓', title:'Professional Excellence', pct:82,
    desc:"Train competent and responsive professionals who can address the community's problems through innovative and practical means.",
    details:['Competency-based education','Practical skill development','Problem-solving abilities','Community-focused training'] },
  { icon:'🌍', title:'Societal Development', pct:75,
    desc:'Contribute to societal development through the training of responsive professionals, conducting high-quality relevant research, and professional advocacy.',
    details:['Community engagement','Evidence-based research','Professional advocacy','Social responsibility'] },
  { icon:'⚖️', title:'Educational Equity', pct:88,
    desc:'Promote the principle of educational equity irrespective of ethnicity, religion, gender or political background.',
    details:['Inclusive education','Equal opportunities','Diversity and inclusion','Fair access policies'] },
  { icon:'🤲', title:"Women's Empowerment", pct:70,
    desc:"Promote women's participation in all spheres of development.",
    details:['Gender equality initiatives','Women leadership programs','Empowerment opportunities','Inclusive development'] },
  { icon:'🤝', title:'Strategic Partnerships', pct:78,
    desc:'Strengthen partnerships and linkages with local and international institutions for the purpose of rendering high quality, applied research.',
    details:['International collaborations','Research partnerships','Knowledge exchange','Global networking'] },
]

function ResearchGoals(): JSX.Element {
  const navigate = useNavigate()
  const [scrolled, setScrolled] = useState(false)
  useEffect(() => {
    const h = () => setScrolled(window.scrollY > 10)
    window.addEventListener('scroll', h)
    return () => window.removeEventListener('scroll', h)
  }, [])

  return (
    <div className="rg-page">
      <header className={`rg-header${scrolled ? ' scrolled' : ''}`}>
        <div className="rg-header-inner">
          <button className="rg-back" onClick={() => navigate('/')}>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Home
          </button>
          <h1 className="rg-header-title">Research Goals</h1>
        </div>
      </header>

      <main className="rg-main">
        <div className="rg-content">

          <div className="rg-hero">
            <div className="rg-badge"><span>🎯</span><span>Our Objectives</span></div>
            <h2 className="rg-hero-title">Achieving Excellence Through Strategic Goals</h2>
            <p className="rg-hero-desc">Our goals guide us toward becoming a leading institution in healthcare education, research, and community service across Africa.</p>
          </div>

          {/* Overview */}
          <section className="rg-section rg-section--white">
            <div className="rg-sec-header">
              <span className="rg-sec-icon">🎯</span>
              <h2 className="rg-sec-title">Strategic Goals</h2>
              <div className="rg-underline"></div>
            </div>
            <p className="rg-overview-text">We are committed to achieving these five strategic goals that align with our vision to become a prestigious academic and research center in Africa by 2030 G.C.</p>
            <div className="rg-stats-row">
              <div className="rg-stat-card"><div className="rg-stat-num">5</div><div className="rg-stat-label">Strategic Goals</div></div>
              <div className="rg-stat-card"><div className="rg-stat-num">2030</div><div className="rg-stat-label">Target Year</div></div>
              <div className="rg-stat-card"><div className="rg-stat-num">Africa</div><div className="rg-stat-label">Regional Focus</div></div>
            </div>
          </section>

          {/* Goals */}
          <section className="rg-section rg-section--light">
            <div className="rg-sec-header">
              <span className="rg-sec-icon">🏆</span>
              <h2 className="rg-sec-title">Our Five Goals</h2>
              <div className="rg-underline"></div>
            </div>
            <div className="rg-goals-grid">
              {goals.map((g, i) => (
                <div key={i} className="rg-goal-card" style={{animationDelay:`${i*0.1}s`}}>
                  <div className="rg-goal-head">
                    <div className="rg-goal-icon">{g.icon}</div>
                    <h3>{g.title}</h3>
                  </div>
                  <p className="rg-goal-desc">{g.desc}</p>
                  <div className="rg-goal-details">
                    <h4>Key Focus Areas:</h4>
                    <ul>{g.details.map((d,j) => <li key={j}>{d}</li>)}</ul>
                  </div>
                  <div className="rg-progress-label">Implementation Progress</div>
                  <div className="rg-progress-bar"><div className="rg-progress-fill" style={{width:`${g.pct}%`}}></div></div>
                </div>
              ))}
            </div>
          </section>

          {/* Strategy */}
          <section className="rg-section rg-section--white">
            <div className="rg-sec-header">
              <span className="rg-sec-icon">🚀</span>
              <h2 className="rg-sec-title">Implementation Strategy</h2>
              <div className="rg-underline"></div>
            </div>
            <div className="rg-strategy-grid">
              <div className="rg-strategy-card"><span className="rg-strategy-icon">📋</span><h3>Strategic Planning</h3><p>Comprehensive planning with clear milestones and performance indicators</p></div>
              <div className="rg-strategy-card"><span className="rg-strategy-icon">👥</span><h3>Stakeholder Engagement</h3><p>Active involvement of all stakeholders in goal implementation</p></div>
              <div className="rg-strategy-card"><span className="rg-strategy-icon">📊</span><h3>Monitoring &amp; Evaluation</h3><p>Regular assessment of progress and impact measurement</p></div>
              <div className="rg-strategy-card"><span className="rg-strategy-icon">💰</span><h3>Resource Allocation</h3><p>Optimal utilization of available resources for maximum impact</p></div>
            </div>
          </section>

          {/* Metrics */}
          <section className="rg-section rg-section--light">
            <div className="rg-sec-header">
              <span className="rg-sec-icon">📈</span>
              <h2 className="rg-sec-title">Impact Metrics</h2>
              <div className="rg-underline"></div>
            </div>
            <div className="rg-metrics-grid">
              <div className="rg-metric-card"><span className="rg-metric-icon">🎓</span><div className="rg-metric-num">95%</div><div className="rg-metric-label">Graduate Employment Rate</div><div className="rg-metric-desc">Our graduates successfully employed within 6 months</div></div>
              <div className="rg-metric-card"><span className="rg-metric-icon">🔬</span><div className="rg-metric-num">150+</div><div className="rg-metric-label">Research Publications</div><div className="rg-metric-desc">Annual research output in peer-reviewed journals</div></div>
              <div className="rg-metric-card"><span className="rg-metric-icon">🤝</span><div className="rg-metric-num">50+</div><div className="rg-metric-label">Partner Institutions</div><div className="rg-metric-desc">Local and international collaboration partners</div></div>
              <div className="rg-metric-card"><span className="rg-metric-icon">🌍</span><div className="rg-metric-num">1M+</div><div className="rg-metric-label">Community Impact</div><div className="rg-metric-desc">Lives positively impacted through our programs</div></div>
            </div>
          </section>

          {/* Timeline */}
          <section className="rg-section rg-section--white">
            <div className="rg-sec-header">
              <span className="rg-sec-icon">📅</span>
              <h2 className="rg-sec-title">Implementation Timeline</h2>
              <div className="rg-underline"></div>
            </div>
            <div className="rg-timeline">
              <div className="rg-tl-item"><div className="rg-tl-year">2024</div><h3>Foundation Phase</h3><p>Establish baseline metrics and initial implementation frameworks</p></div>
              <div className="rg-tl-item"><div className="rg-tl-year">2026</div><h3>Growth Phase</h3><p>Scale up successful programs and expand partnerships</p></div>
              <div className="rg-tl-item"><div className="rg-tl-year">2028</div><h3>Optimization Phase</h3><p>Refine programs based on feedback and achieved outcomes</p></div>
              <div className="rg-tl-item"><div className="rg-tl-year rg-tl-year--active">2030</div><h3>Achievement Phase</h3><p>Realize vision as leading medical center in Africa</p></div>
            </div>
          </section>

          {/* CTA */}
          <section className="rg-section rg-section--cta">
            <div className="rg-cta-inner">
              <h2>Join Our Journey</h2>
              <p>Be part of our mission to transform healthcare education and research in Africa.</p>
              <div className="rg-cta-btns">
                <button className="rg-btn-primary">Support Our Goals</button>
                <button className="rg-btn-secondary">Partner With Us</button>
              </div>
            </div>
          </section>

        </div>
      </main>
    </div>
  )
}

export default ResearchGoals
