import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './RolesResponsibilities.css'

const researchStats = [
  { label:'Annual Proposals', value:'1,400', icon:'📋' },
  { label:'Student Research', value:'80%', icon:'👨‍🎓' },
  { label:'Faculty Research', value:'15%', icon:'👨‍🏫' },
  { label:'External Research', value:'5%', icon:'🤝' },
]

const collaborationAreas = [
  { icon:'🎓', title:'Capacity Building', desc:'Continued training for IRB members in advanced ethical review processes, international standards certification, and continuous professional development.' },
  { icon:'🏗️', title:'Infrastructure Improvement', desc:'Providing IRBs with better resources including digitalizing the review and application process so that applicants can follow the status of their protocol approval online.' },
  { icon:'👥', title:'Strengthen Human Power', desc:'Additional full-time staff for monitoring and oversight of approved research activities and improved data recording systems.' },
  { icon:'📢', title:'Public Awareness', desc:'Increasing awareness among researchers about the importance of ethical research practices and the role of IRBs through campaigns and training programs.' },
]

function RolesResponsibilities(): JSX.Element {
  const navigate = useNavigate()
  const [scrolled, setScrolled] = useState(false)
  useEffect(() => {
    const h = () => setScrolled(window.scrollY > 10)
    window.addEventListener('scroll', h)
    return () => window.removeEventListener('scroll', h)
  }, [])

  return (
    <div className="rp-page">
      <header className={`rp-header${scrolled ? ' scrolled' : ''}`}>
        <div className="rp-header-inner">
          <button className="rp-back" onClick={() => navigate('/')}>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Home
          </button>
          <h1 className="rp-header-title">Roles &amp; Responsibilities</h1>
        </div>
      </header>

      <main className="rp-main">
        <div className="rp-content">

          <div className="rp-hero">
            <div className="rp-badge"><span>⚖️</span><span>IRB Governance</span></div>
            <h2 className="rp-hero-title">Ensuring Ethical Excellence in Research</h2>
            <p className="rp-hero-desc">The Institutional Review Board plays a critical role in safeguarding human subjects while promoting scientific integrity and ethical research practices.</p>
          </div>

          {/* Core Responsibilities */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">📋</span>
              <h2 className="rp-sec-title">IRB Core Responsibilities</h2>
              <div className="rp-underline"></div>
            </div>
            <p className="rp-intro-text">The IRB serves as the guardian of research ethics, ensuring that all studies involving human subjects meet the highest standards of scientific integrity and participant protection.</p>
            <div className="rp-grid-4">
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🔍</div><h3>Review &amp; Approve</h3></div><p>Evaluate research proposals for ethical compliance</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">👁️</div><h3>Monitor &amp; Supervise</h3></div><p>Oversight of ongoing research activities</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📊</div><h3>Evaluate &amp; Report</h3></div><p>Assess research outcomes and compliance</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🎓</div><h3>Educate &amp; Train</h3></div><p>Guide researchers on ethical practices</p></div>
            </div>
          </section>

          {/* Review of Proposals */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">📋</span>
              <h2 className="rp-sec-title">Review of Research Proposals</h2>
              <div className="rp-underline"></div>
            </div>
            <p className="rp-intro-text">The primary responsibility of IRBs is to review and approve research proposals involving human subjects, assessing:</p>
            <div className="rp-card-grid">
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">⚖️</div><h3>Risk-Benefit Analysis</h3></div><p>The potential risks and benefits to participants</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📝</div><h3>Informed Consent</h3></div><p>The written informed consent process</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🔒</div><h3>Data Protection</h3></div><p>Confidentiality and data protection measures</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">⚖️</div><h3>Equitable Recruitment</h3></div><p>Equitable participant recruitment practices</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🔬</div><h3>Scientific Integrity</h3></div><p>The proposed research scientific integrity to the highest standard</p></div>
            </div>

            {/* Stats */}
            <div style={{marginTop:'3rem'}}>
              <h3 style={{fontSize:'1.6rem',fontWeight:'800',color:'#0a1628',marginBottom:'1.5rem',textAlign:'center'}}>Research Approval Statistics</h3>
              <div className="rp-grid-4">
                {researchStats.map((s, i) => (
                  <div key={i} className="rp-stat-card">
                    <span className="rp-stat-icon">{s.icon}</span>
                    <div className="rp-stat-num">{s.value}</div>
                    <div className="rp-stat-label">{s.label}</div>
                  </div>
                ))}
              </div>
              <div className="rp-note" style={{marginTop:'1.5rem'}}>
                <p>Starting from 2020 G.C the IRB has approved an average of 1,400 proposals annually. Student researches account for about 80% followed by faculty and external applicants.</p>
              </div>
            </div>

            <div className="rp-warn" style={{marginTop:'2rem'}}>
              <h4>Compliance Limitations</h4>
              <p>Limited monitoring capacity, documentation gaps, and staff shortages present ongoing challenges to full compliance oversight.</p>
            </div>
          </section>

          {/* Monitoring */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">👁️</span>
              <h2 className="rp-sec-title">Monitoring Ongoing Research</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-warn">
              <h4>Limited Monitoring Resources</h4>
              <p>The IRB rarely monitors approved studies because of limited number of full time staff to ensure they adhere to the approved protocol and ethical guidelines.</p>
            </div>
            <div className="rp-grid-3" style={{marginTop:'2rem'}}>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">⏸️</div><h3>Study Suspension</h3></div><p>Can suspend studies if violations are identified</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🛑</div><h3>Study Termination</h3></div><p>Can terminate studies for ethical violations</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📋</div><h3>Protocol Review</h3></div><p>Review adherence to approved protocols</p></div>
            </div>
            <div className="rp-warn" style={{marginTop:'2rem'}}>
              <h4>Documentation Gap</h4>
              <p>No single documented record was obtained up to the reporters search from IRB archives, limiting tracking of ongoing studies and audit trail creation.</p>
            </div>
          </section>

          {/* Post-Research */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">📊</span>
              <h2 className="rp-sec-title">Post-Research Review</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-warn">
              <h4>IRB Review Limitations</h4>
              <p>After research completion, SPHMMC IRBs fails to review findings to ensure that the study was conducted ethically and that data handling meets the ethical standards. Other than the student thesis defense at department levels, no systematic post-research review exists.</p>
            </div>
            <div className="rp-card-grid" style={{marginTop:'2rem'}}>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📋</div><h3>Ethical Compliance Review</h3></div><p>No systematic review of ethical conduct after study completion</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🔒</div><h3>Data Handling Assessment</h3></div><p>Limited evaluation of data protection post-study</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📊</div><h3>Outcome Documentation</h3></div><p>Incomplete final study documentation</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📝</div><h3>Compliance Certification</h3></div><p>No formal compliance certification process</p></div>
            </div>
          </section>

          {/* Collaboration */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🤝</span>
              <h2 className="rp-sec-title">Potentials of Collaboration on IRBs</h2>
              <div className="rp-underline"></div>
            </div>
            <p className="rp-intro-text">Strategic collaboration opportunities exist to strengthen IRB operations and enhance research ethics governance across the institution.</p>
            <div className="rp-collab-grid">
              {collaborationAreas.map((a, i) => (
                <div key={i} className="rp-collab-card">
                  <div className="rp-collab-head"><div className="rp-collab-icon">{a.icon}</div><h3>{a.title}</h3></div>
                  <p>{a.desc}</p>
                </div>
              ))}
            </div>
          </section>

          {/* CTA */}
          <section className="rp-section rp-section--cta">
            <div className="rp-cta-inner">
              <h2>Strengthening IRB Excellence</h2>
              <p>Through strategic collaboration and capacity building, we can enhance our IRB's ability to protect research participants while promoting scientific innovation.</p>
              <div className="rp-cta-btns">
                <button className="rp-btn-primary">Partner With IRB</button>
                <button className="rp-btn-secondary">Learn More</button>
              </div>
            </div>
          </section>

        </div>
      </main>
    </div>
  )
}

export default RolesResponsibilities
