import { type JSX } from 'react'
import './about.css'

interface SchoolOfNursingAboutProps {
  onBack: () => void
}

function SchoolOfNursingAbout({ onBack }: SchoolOfNursingAboutProps): JSX.Element {
  return (
    <div className="nursing-about">
      {/* Hero Section */}
      <section className="nursing-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>School of Nursing</h1>
            <p>Excellence in Nursing Education Since 2012</p>
          </div>
        </div>
      </section>

      {/* Main Content */}
      <section className="nursing-content">
        <div className="container">
          {/* Introduction */}
          <div className="content-section">
            <h2>Our History</h2>
            <div className="history-timeline">
              <div className="timeline-item">
                <div className="timeline-year">2007</div>
                <div className="timeline-content">
                  <h3>Foundation</h3>
                  <p>Saint Paul's Hospital Millennium Medical College was opened and became a higher education institution under Ethiopian Federal Ministry of Health (EFMOH).</p>
                </div>
              </div>
              
              <div className="timeline-item">
                <div className="timeline-year">2012</div>
                <div className="timeline-content">
                  <h3>Nursing Education Directorate</h3>
                  <p>Started with two specialty Nursing Programs: Operating Theatre Nursing and Emergency and Critical Care Nursing in collaboration with Trauma Care Ethiopia and Children Burn Care Foundation.</p>
                </div>
              </div>
              
              <div className="timeline-item">
                <div className="timeline-year">2022</div>
                <div className="timeline-content">
                  <h3>School of Nursing</h3>
                  <p>Nursing Education Directorate was scaled up to School of Nursing (SoN) by College's Senate pronouncement.</p>
                </div>
              </div>
            </div>
          </div>

          {/* Programs */}
          <div className="content-section">
            <h2>Academic Programs</h2>
            <div className="programs-grid">
              <div className="program-card undergraduate">
                <div className="program-header">
                  <h3>Undergraduate Programs</h3>
                  <div className="program-count">5 Programs</div>
                </div>
                <ul className="program-list">
                  <li>Pediatrics and Child Health Nursing</li>
                  <li>Surgical Nursing</li>
                  <li>Neonatal Nursing</li>
                  <li>Emergency and Critical Care Nursing</li>
                  <li>Operative Theatre Nursing</li>
                </ul>
                <p className="program-description">
                  Students are selected individuals who had diploma in nursing and trained for two and half years to be graduated as BSc nurses in respective programs.
                </p>
              </div>

              <div className="program-card postgraduate">
                <div className="program-header">
                  <h3>Postgraduate Programs</h3>
                  <div className="program-count">6 Programs</div>
                </div>
                <ul className="program-list">
                  <li>Critical Care Nursing</li>
                  <li>Paramedics</li>
                  <li>Neonatal Nursing</li>
                  <li>Cardiovascular Nursing</li>
                  <li>Oncology Nursing</li>
                  <li>Cardio-thoracic Surgery Nursing</li>
                </ul>
                <p className="program-description">
                  Candidates are selected based on admission criteria mentioned in each program's curricula.
                </p>
              </div>
            </div>
          </div>

          {/* Nursing Residency Program */}
          <div className="content-section">
            <h2>Nursing Residency Program (NRP)</h2>
            <div className="residency-feature">
              <div className="feature-content">
                <h3>Hands-on Learning Approach</h3>
                <p>
                  The School has upgraded existing curriculum and new postgraduate programs to Nursing Residency approaches. 
                  This curriculum is designed to train qualified, skilled nurses and prepare nurses who can meet current health care needs.
                </p>
                <div className="benefits-grid">
                  <div className="benefit-item">
                    <div className="benefit-icon">🎯</div>
                    <h4>Patient Safety Focus</h4>
                    <p>Substantial focus on patient safety through real-world experience</p>
                  </div>
                  <div className="benefit-item">
                    <div className="benefit-icon">🏥</div>
                    <h4>Care Setting Experience</h4>
                    <p>Opportunity to gain hands-on experience in actual care settings</p>
                  </div>
                  <div className="benefit-item">
                    <div className="benefit-icon">👨‍⚕️</div>
                    <h4>Professional Development</h4>
                    <p>Supports nurses in becoming confident and competent practitioners</p>
                  </div>
                  <div className="benefit-item">
                    <div className="benefit-icon">📋</div>
                    <h4>Independent Responsibility</h4>
                    <p>Residents take responsibility for patients' care with supervision</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Current Transition */}
          <div className="content-section">
            <h2>Current Innovations</h2>
            <div className="innovation-card">
              <div className="innovation-header">
                <h3>Residency-Based Learning</h3>
                <span className="innovation-badge">2024</span>
              </div>
              <p>
                Currently, SoN of SPHMMC has shifted four postgraduate programs from classroom-based lectures to hospital-based and learning by doing - which is residency in nursing:
              </p>
              <div className="programs-transition">
                <div className="transition-program">Critical Care Nursing</div>
                <div className="transition-program">Neonatal Nursing</div>
                <div className="transition-program">Oncology Nursing</div>
                <div className="transition-program">Cardiovascular Nursing</div>
              </div>
            </div>
          </div>

          {/* Future Plans */}
          <div className="content-section">
            <h2>Future Vision</h2>
            <div className="vision-card">
              <div className="vision-content">
                <h3>PhD Program Launch</h3>
                <p className="vision-year">2024/25</p>
                <p>
                  St. Paul's Hospital Millennium Medical College School of Nursing will open Nursing PhD program under the umbrella of newly restructured one PhD program at SPHMMC by organizing its workforce.
                </p>
                <div className="vision-points">
                  <div className="vision-point">
                    <span className="point-icon">📈</span>
                    <span>Continuous and consistent progress to expand programs</span>
                  </div>
                  <div className="vision-point">
                    <span className="point-icon">🎓</span>
                    <span>Stepping forward nursing profession of the country</span>
                  </div>
                  <div className="vision-point">
                    <span className="point-icon">🏛️</span>
                    <span>Alignment with national growth and development agendas</span>
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

export default SchoolOfNursingAbout
