import { type JSX } from 'react'
import './mission.css'

interface SchoolOfNursingMissionProps {
  onBack: () => void
}

function SchoolOfNursingMission({ onBack }: SchoolOfNursingMissionProps): JSX.Element {
  return (
    <div className="nursing-mission">
      {/* Hero Section */}
      <section className="mission-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>Our Mission</h1>
            <p>Excellence in Nursing Education and Healthcare Innovation</p>
          </div>
        </div>
      </section>

      {/* Main Content */}
      <section className="mission-content">
        <div className="container">
          {/* Mission Statement */}
          <div className="content-section">
            <div className="mission-statement">
              <div className="statement-icon">
                <div className="icon-circle">
                  <span>🎯</span>
                </div>
              </div>
              <div className="statement-content">
                <h2>Core Mission</h2>
                <p className="mission-text">
                  To provide exceptional nursing education that produces highly competent, compassionate, 
                  and innovative healthcare professionals who can address the evolving healthcare needs 
                  of Ethiopia and beyond through excellence in teaching, research, and community service.
                </p>
              </div>
            </div>
          </div>

          {/* Mission Pillars */}
          <div className="content-section">
            <h2>Mission Pillars</h2>
            <div className="pillars-grid">
              <div className="pillar-card">
                <div className="pillar-icon">📚</div>
                <h3>Academic Excellence</h3>
                <p>
                  Deliver cutting-edge nursing education through evidence-based curricula, 
                  innovative teaching methodologies, and continuous professional development 
                  programs that meet international standards.
                </p>
                <ul className="pillar-points">
                  <li>Evidence-based curriculum design</li>
                  <li>Advanced clinical training</li>
                  <li>Continuous professional development</li>
                  <li>International standards compliance</li>
                </ul>
              </div>

              <div className="pillar-card">
                <div className="pillar-icon">🔬</div>
                <h3>Research Innovation</h3>
                <p>
                  Foster a culture of scientific inquiry and research that addresses local 
                  healthcare challenges while contributing to global nursing knowledge and 
                  practice advancement.
                </p>
                <ul className="pillar-points">
                  <li>Healthcare problem-solving research</li>
                  <li>Evidence-based practice promotion</li>
                  <li>Collaborative research initiatives</li>
                  <li>Knowledge translation and dissemination</li>
                </ul>
              </div>

              <div className="pillar-card">
                <div className="pillar-icon">🏥</div>
                <h3>Clinical Excellence</h3>
                <p>
                  Ensure graduates possess advanced clinical competencies through hands-on 
                  training, residency programs, and exposure to diverse healthcare settings 
                  and patient populations.
                </p>
                <ul className="pillar-points">
                  <li>Hands-on clinical training</li>
                  <li>Residency program integration</li>
                  <li>Diverse healthcare exposure</li>
                  <li>Advanced skill development</li>
                </ul>
              </div>

              <div className="pillar-card">
                <div className="pillar-icon">🤝</div>
                <h3>Community Service</h3>
                <p>
                  Engage in community outreach and public health initiatives that improve 
                  healthcare access, promote health education, and address the healthcare 
                  needs of underserved populations.
                </p>
                <ul className="pillar-points">
                  <li>Community health outreach</li>
                  <li>Public health education</li>
                  <li>Underserved population service</li>
                  <li>Healthcare access improvement</li>
                </ul>
              </div>
            </div>
          </div>

          {/* Educational Philosophy */}
          <div className="content-section">
            <h2>Educational Philosophy</h2>
            <div className="philosophy-card">
              <div className="philosophy-header">
                <h3>Student-Centered Learning</h3>
                <div className="philosophy-badge">SPHMMC Approach</div>
              </div>
              <p>
                Our educational philosophy is rooted in the belief that nursing education should 
                be transformative, empowering students to become critical thinkers, lifelong 
                learners, and compassionate caregivers. We emphasize:
              </p>
              <div className="philosophy-grid">
                <div className="philosophy-item">
                  <div className="philosophy-icon">🧠</div>
                  <h4>Critical Thinking</h4>
                  <p>Developing analytical and problem-solving skills for clinical decision-making</p>
                </div>
                <div className="philosophy-item">
                  <div className="philosophy-icon">💝</div>
                  <h4>Compassionate Care</h4>
                  <p>Cultivating empathy and patient-centered care approaches</p>
                </div>
                <div className="philosophy-item">
                  <div className="philosophy-icon">🔄</div>
                  <h4>Lifelong Learning</h4>
                  <p>Fostering continuous professional development and adaptation</p>
                </div>
                <div className="philosophy-item">
                  <div className="philosophy-icon">⚖️</div>
                  <h4>Ethical Practice</h4>
                  <p>Upholding professional standards and ethical responsibilities</p>
                </div>
              </div>
            </div>
          </div>

          {/* Quality Commitment */}
          <div className="content-section">
            <h2>Quality Commitment</h2>
            <div className="quality-section">
              <div className="quality-content">
                <h3>Assurance of Excellence</h3>
                <p>
                  St. Paul's Hospital Millennium Medical College School of Nursing is committed 
                  to maintaining the highest standards of quality in all aspects of nursing 
                  education through:
                </p>
                <div className="quality-metrics">
                  <div className="metric-item">
                    <div className="metric-number">100%</div>
                    <div className="metric-label">Curriculum Compliance</div>
                    <div className="metric-desc">National and international standards</div>
                  </div>
                  <div className="metric-item">
                    <div className="metric-number">95%</div>
                    <div className="metric-label">Graduate Success</div>
                    <div className="metric-desc">Employment and licensure rates</div>
                  </div>
                  <div className="metric-item">
                    <div className="metric-number">24/7</div>
                    <div className="metric-label">Clinical Access</div>
                    <div className="metric-desc">Hands-on training opportunities</div>
                  </div>
                  <div className="metric-item">
                    <div className="metric-number">50+</div>
                    <div className="metric-label">Partner Institutions</div>
                    <div className="metric-desc">Clinical collaboration network</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Strategic Goals */}
          <div className="content-section">
            <h2>Strategic Goals</h2>
            <div className="goals-timeline">
              <div className="goal-item">
                <div className="goal-marker short-term">Short-term</div>
                <div className="goal-content">
                  <h3>Program Expansion</h3>
                  <p>Expand specialty programs and enhance existing curricula to meet emerging healthcare needs</p>
                </div>
              </div>
              <div className="goal-item">
                <div className="goal-marker medium-term">Medium-term</div>
                <div className="goal-content">
                  <h3>Research Excellence</h3>
                  <p>Establish research centers and increase scholarly output contributing to nursing science</p>
                </div>
              </div>
              <div className="goal-item">
                <div className="goal-marker long-term">Long-term</div>
                <div className="goal-content">
                  <h3>Regional Leadership</h3>
                  <p>Become the leading nursing education institution in East Africa and beyond</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default SchoolOfNursingMission
