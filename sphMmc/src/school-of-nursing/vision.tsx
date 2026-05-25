import { type JSX } from 'react'
import './vision.css'

interface SchoolOfNursingVisionProps {
  onBack: () => void
}

function SchoolOfNursingVision({ onBack }: SchoolOfNursingVisionProps): JSX.Element {
  return (
    <div className="nursing-vision">
      {/* Hero Section */}
      <section className="vision-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>Our Vision</h1>
            <p>Leading the Future of Nursing Education in Africa</p>
          </div>
        </div>
      </section>

      {/* Main Content */}
      <section className="vision-content">
        <div className="container">
          {/* Vision Statement */}
          <div className="content-section">
            <div className="vision-statement">
              <div className="statement-icon">
                <div className="icon-circle">
                  <span>👁️</span>
                </div>
              </div>
              <div className="statement-content">
                <h2>Core Vision</h2>
                <p className="vision-text">
                  To be a premier center of excellence in nursing education, research, and practice 
                  that produces transformative leaders who advance healthcare delivery, improve 
                  patient outcomes, and shape the future of nursing in Ethiopia and across Africa.
                </p>
              </div>
            </div>
          </div>

          {/* Vision Aspirations */}
          <div className="content-section">
            <h2>Vision Aspirations</h2>
            <div className="aspirations-grid">
              <div className="aspiration-card">
                <div className="aspiration-icon">🌍</div>
                <h3>Regional Leadership</h3>
                <p>
                  Become the leading nursing education institution in East Africa, setting 
                  standards for excellence and innovation in nursing education and practice.
                </p>
                <div className="aspiration-metrics">
                  <div className="metric">
                    <span className="metric-value">East Africa</span>
                    <span className="metric-label">Regional Influence</span>
                  </div>
                  <div className="metric">
                    <span className="metric-value">Top 3</span>
                    <span className="metric-label">African Ranking</span>
                  </div>
                </div>
              </div>

              <div className="aspiration-card">
                <div className="aspiration-icon">🎓</div>
                <h3>Academic Excellence</h3>
                <p>
                  Establish internationally recognized nursing programs that produce graduates 
                  capable of competing globally while addressing local healthcare challenges.
                </p>
                <div className="aspiration-metrics">
                  <div className="metric">
                    <span className="metric-value">PhD Program</span>
                    <span className="metric-label">2024/25 Launch</span>
                  </div>
                  <div className="metric">
                    <span className="metric-value">10+</span>
                    <span className="metric-label">Specialty Programs</span>
                  </div>
                </div>
              </div>

              <div className="aspiration-card">
                <div className="aspiration-icon">🔬</div>
                <h3>Research Innovation</h3>
                <p>
                  Lead groundbreaking nursing research that addresses critical healthcare 
                  challenges and contributes to evidence-based practice improvements.
                </p>
                <div className="aspiration-metrics">
                  <div className="metric">
                    <span className="metric-value">50+</span>
                    <span className="metric-label">Annual Publications</span>
                  </div>
                  <div className="metric">
                    <span className="metric-value">5</span>
                    <span className="metric-label">Research Centers</span>
                  </div>
                </div>
              </div>

              <div className="aspiration-card">
                <div className="aspiration-icon">⚕️</div>
                <h3>Clinical Impact</h3>
                <p>
                  Transform healthcare delivery through innovative clinical practices, 
                  advanced training methodologies, and community engagement initiatives.
                </p>
                <div className="aspiration-metrics">
                  <div className="metric">
                    <span className="metric-value">100%</span>
                    <span className="metric-label">Residency Integration</span>
                  </div>
                  <div className="metric">
                    <span className="metric-value">1M+</span>
                    <span className="metric-label">Lives Impacted</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Future Roadmap */}
          <div className="content-section">
            <h2>Future Roadmap</h2>
            <div className="roadmap-container">
              <div className="roadmap-timeline">
                <div className="roadmap-phase">
                  <div className="phase-marker current">2024-2025</div>
                  <div className="phase-content">
                    <h3>Foundation Building</h3>
                    <ul className="phase-items">
                      <li>Launch PhD Nursing Program</li>
                      <li>Complete Residency Program Transition</li>
                      <li>Establish Research Infrastructure</li>
                      <li>International Accreditation Process</li>
                    </ul>
                  </div>
                </div>

                <div className="roadmap-phase">
                  <div className="phase-marker upcoming">2026-2028</div>
                  <div className="phase-content">
                    <h3>Expansion Phase</h3>
                    <ul className="phase-items">
                      <li>Regional Campus Development</li>
                      <li>Advanced Simulation Centers</li>
                      <li>International Partnerships</li>
                      <li>Digital Learning Platform</li>
                    </ul>
                  </div>
                </div>

                <div className="roadmap-phase">
                  <div className="phase-marker future">2029-2030</div>
                  <div className="phase-content">
                    <h3>Excellence Achievement</h3>
                    <ul className="phase-items">
                      <li>African Leadership Position</li>
                      <li>Global Recognition</li>
                      <li>Innovation Hub Status</li>
                      <li>Sustainable Growth Model</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Impact Areas */}
          <div className="content-section">
            <h2>Strategic Impact Areas</h2>
            <div className="impact-grid">
              <div className="impact-area education">
                <div className="impact-header">
                  <h3>Education Transformation</h3>
                  <div className="impact-icon">📚</div>
                </div>
                <p>
                  Revolutionizing nursing education through innovative curricula, 
                  technology integration, and competency-based learning approaches.
                </p>
                <div className="impact-points">
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Competency-based curriculum</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Technology-enhanced learning</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Lifelong learning pathways</span>
                  </div>
                </div>
              </div>

              <div className="impact-area research">
                <div className="impact-header">
                  <h3>Research Leadership</h3>
                  <div className="impact-icon">🔬</div>
                </div>
                <p>
                  Leading nursing research that addresses critical healthcare challenges 
                  and contributes to global nursing knowledge and practice.
                </p>
                <div className="impact-points">
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Evidence-based practice</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Clinical research integration</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Knowledge translation</span>
                  </div>
                </div>
              </div>

              <div className="impact-area community">
                <div className="impact-header">
                  <h3>Community Engagement</h3>
                  <div className="impact-icon">🤝</div>
                </div>
                <p>
                  Strengthening community health through outreach programs, 
                  public health initiatives, and partnerships with healthcare providers.
                </p>
                <div className="impact-points">
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Community health outreach</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Public health education</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Healthcare access improvement</span>
                  </div>
                </div>
              </div>

              <div className="impact-area innovation">
                <div className="impact-header">
                  <h3>Innovation Hub</h3>
                  <div className="impact-icon">💡</div>
                </div>
                <p>
                  Creating a center for nursing innovation that develops new solutions 
                  for healthcare delivery challenges and nurtures entrepreneurial thinking.
                </p>
                <div className="impact-points">
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Healthcare technology solutions</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Process innovation</span>
                  </div>
                  <div className="impact-point">
                    <span className="point-icon">✓</span>
                    <span>Entrepreneurial development</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Vision Commitment */}
          <div className="content-section">
            <h2>Our Commitment</h2>
            <div className="commitment-card">
              <div className="commitment-header">
                <h3>Excellence in Action</h3>
                <div className="commitment-badge">SPHMMC Promise</div>
              </div>
              <p>
                St. Paul's Hospital Millennium Medical College School of Nursing is committed 
                to realizing this vision through unwavering dedication to quality, innovation, 
                and service. We pledge to:
              </p>
              <div className="commitment-list">
                <div className="commitment-item">
                  <div className="commitment-number">01</div>
                  <div className="commitment-text">
                    <h4>Maintain Highest Standards</h4>
                    <p>Uphold international standards in education, research, and clinical practice</p>
                  </div>
                </div>
                <div className="commitment-item">
                  <div className="commitment-number">02</div>
                  <div className="commitment-text">
                    <h4>Foster Innovation</h4>
                    <p>Continuously innovate and adapt to emerging healthcare needs and technologies</p>
                  </div>
                </div>
                <div className="commitment-item">
                  <div className="commitment-number">03</div>
                  <div className="commitment-text">
                    <h4>Develop Leaders</h4>
                    <p>Nurture nursing leaders who can transform healthcare systems and practices</p>
                  </div>
                </div>
                <div className="commitment-item">
                  <div className="commitment-number">04</div>
                  <div className="commitment-text">
                    <h4>Global Impact</h4>
                    <p>Contribute to global nursing knowledge and best practices while serving local communities</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default SchoolOfNursingVision
