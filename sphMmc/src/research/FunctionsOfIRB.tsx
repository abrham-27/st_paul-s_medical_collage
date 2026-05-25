import { useState, useEffect, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import './FunctionsOfIRB.css'

const irbMembers = [
  { icon:'👨‍⚕️', title:'Medical & Healthcare Professionals', desc:'Clinical experts with extensive experience in medical research and patient care' },
  { icon:'⚖️', title:'Legal Experts', desc:'Lawyers specializing in healthcare law and research ethics' },
  { icon:'👥', title:'Social Scientists', desc:'Experts in social sciences, ethics, and community impact assessment' },
  { icon:'🌍', title:'Community Representatives', desc:'Patient advocates and community stakeholders representing public interests' },
  { icon:'🤝', title:'Ethicists', desc:'Specialists in bioethics and research methodology' },
  { icon:'👤', title:'Laypersons', desc:'Community members providing non-technical perspective on research ethics' },
]

function FunctionsOfIRB(): JSX.Element {
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
          <h1 className="rp-header-title">Functions of IRB</h1>
        </div>
      </header>

      <main className="rp-main">
        <div className="rp-content">

          <div className="rp-hero">
            <div className="rp-badge"><span>⚖️</span><span>Ethical Oversight</span></div>
            <h2 className="rp-hero-title">Ensuring Research Integrity &amp; Participant Protection</h2>
            <p className="rp-hero-desc">The Institutional Review Board serves as the guardian of ethical standards in research, ensuring all studies protect human subjects while advancing scientific knowledge.</p>
          </div>

          {/* Legal Framework */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🏛️</span>
              <h2 className="rp-sec-title">Legal &amp; Regulatory Framework</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-card-grid">
              <div className="rp-card">
                <div className="rp-card-head"><div className="rp-card-icon">🏛️</div><h3>Regulatory Authorities</h3></div>
                <p>Obtained from <strong>National Health Research Ethics Review Committee (NHRERC)</strong>, the IRB plays a supervisory role to all human subject studies conducted at SPHMMC.</p>
                <ul className="rp-items-list"><li>Direct supervision by national ethics committee</li><li>Regular review and audit of research protocols</li></ul>
              </div>
              <div className="rp-card">
                <div className="rp-card-head"><div className="rp-card-icon">📜</div><h3>National Guidelines</h3></div>
                <p>SPHMMC has adopted <strong>National Health Research Ethics Guidelines</strong>, aligned with international standards:</p>
                <ul className="rp-items-list"><li>Declaration of Helsinki — international ethical principles</li><li>Belmont Report — ethical principles for human subject protection</li></ul>
              </div>
              <div className="rp-card">
                <div className="rp-card-head"><div className="rp-card-icon">🏢</div><h3>Institutional Mandate</h3></div>
                <p>SPHMMC IRB operates under institutional oversight but is <strong>independent in its aspect</strong>, compliant with national guidelines.</p>
                <ul className="rp-items-list"><li>Autonomous decision-making authority</li><li>Adherence to national and international standards</li><li>Comprehensive review of all research activities</li></ul>
              </div>
            </div>
          </section>

          {/* IRB Structure */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">👥</span>
              <h2 className="rp-sec-title">Structure of IRB</h2>
              <div className="rp-underline"></div>
            </div>
            <p className="rp-intro-text">As per national guideline, SPHMMC IRB has <strong>15 members</strong> from a multidisciplinary panel:</p>
            <div className="rp-card-grid">
              {irbMembers.map((m, i) => (
                <div key={i} className="rp-card">
                  <div className="rp-card-head"><div className="rp-card-icon">{m.icon}</div><h3>{m.title}</h3></div>
                  <p>{m.desc}</p>
                </div>
              ))}
            </div>
          </section>

          {/* Appointment */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">📅</span>
              <h2 className="rp-sec-title">Appointment &amp; Training</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-grid-2">
              <div className="rp-card">
                <div className="rp-card-head"><div className="rp-card-icon">📋</div><h3>Appointment Process</h3></div>
                <p>Members appointed by <strong>Academic and Vice Provost</strong> and undergo regular ethics and scientific integrity training.</p>
                <div className="rp-step-list">
                  <div className="rp-step"><div className="rp-step-num">1</div><div><h4>Selection</h4><p>Based on expertise and ethical standing</p></div></div>
                  <div className="rp-step"><div className="rp-step-num">2</div><div><h4>Appointment</h4><p>Formal appointment by institutional leadership</p></div></div>
                  <div className="rp-step"><div className="rp-step-num">3</div><div><h4>Training</h4><p>Regular ethics and integrity education</p></div></div>
                </div>
              </div>
              <div className="rp-card">
                <div className="rp-card-head"><div className="rp-card-icon">🎓</div><h3>Training Program</h3></div>
                <p>Members certified by <strong>national Research Ethics committee under the MOE</strong>.</p>
                <ul className="rp-items-list"><li>International research ethics guidelines</li><li>Ethiopian research ethics regulations</li><li>Scientific integrity and research methodology</li></ul>
              </div>
            </div>
          </section>

          {/* Core Functions */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">⚙️</span>
              <h2 className="rp-sec-title">Core Functions of IRB</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-grid-3">
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🔍</div><h3>Protocol Review</h3></div><p>Comprehensive review of research proposals and methodologies</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🛡️</div><h3>Risk Assessment</h3></div><p>Evaluation of potential risks and mitigation strategies</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📋</div><h3>Approval Process</h3></div><p>Ethical clearance and authorization of research studies</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">👁️</div><h3>Monitoring</h3></div><p>Ongoing oversight of approved research activities</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📊</div><h3>Compliance Audit</h3></div><p>Regular audits to ensure adherence to ethical standards</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">🤝</div><h3>Education &amp; Training</h3></div><p>Training researchers on ethical conduct and standards</p></div>
            </div>
          </section>

          {/* Accreditation */}
          <section className="rp-section rp-section--white">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">🏆</span>
              <h2 className="rp-sec-title">National Certification</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-accred">
              <div className="rp-accred-badge">🏆</div>
              <div>
                <div className="rp-accred-title">NHRERC Certified — Level A IRB</div>
                <p className="rp-accred-desc">Recognized by the national research ethics committee at the Ministry of Education with the privilege to review and approve human subject studies including clinical trials. SPHMMC IRB maintains certification through continuous improvement and strict adherence to national and international research ethics standards.</p>
              </div>
            </div>
          </section>

          {/* Contact */}
          <section className="rp-section rp-section--light">
            <div className="rp-sec-header">
              <span className="rp-sec-icon">📞</span>
              <h2 className="rp-sec-title">Contact IRB Office</h2>
              <div className="rp-underline"></div>
            </div>
            <div className="rp-grid-3">
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📧</div><h3>Email</h3></div><p>irb@sphmmc.edu.et</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📞</div><h3>Phone</h3></div><p>+251-XXX-XXXX</p></div>
              <div className="rp-card"><div className="rp-card-head"><div className="rp-card-icon">📍</div><h3>Office Location</h3></div><p>Research Administration Building, SPHMMC</p></div>
            </div>
          </section>

          {/* CTA */}
          <section className="rp-section rp-section--cta">
            <div className="rp-cta-inner">
              <h2>Work With Our IRB</h2>
              <p>Submit your research proposal and get ethical clearance from our nationally accredited review board.</p>
              <div className="rp-cta-btns">
                <button className="rp-btn-primary">Submit Proposal</button>
                <button className="rp-btn-secondary">Learn More</button>
              </div>
            </div>
          </section>

        </div>
      </main>
    </div>
  )
}

export default FunctionsOfIRB
