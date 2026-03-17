import { type JSX } from 'react'
import './OperativeTheatre.css'

interface OperativeTheatreProps {
  onBack: () => void
}

function OperativeTheatre({ onBack }: OperativeTheatreProps): JSX.Element {
  return (
    <div className="operative-theatre">
      {/* Hero Section */}
      <section className="department-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>Operative Theatre Nursing</h1>
            <p>Surgical Excellence and Precision</p>
          </div>
        </div>
      </section>

      {/* Main Content */}
      <section className="department-content">
        <div className="container">
          {/* Department Overview */}
          <div className="overview-section">
            <h2>Department Overview</h2>
            <div className="overview-content">
              <div className="mission-statement">
                <div className="mission-icon">⚕️</div>
                <div className="mission-text">
                  <h3>Our Mission</h3>
                  <p>
                    To produce highly skilled perioperative nurses who can ensure 
                    safe, efficient surgical environments and provide excellent 
                    patient care throughout the surgical experience.
                  </p>
                </div>
              </div>
              <div className="department-intro">
                <p>
                  The Department of Operative Theatre Nursing specializes in perioperative 
                  care, preparing nurses to work in operating rooms and surgical 
                  settings. Our program emphasizes sterile techniques, surgical 
                  assistance, and comprehensive patient safety protocols.
                </p>
              </div>
            </div>
          </div>

          {/* Specialization Areas */}
          <div className="areas-section">
            <h2>Specialization Areas</h2>
            <div className="areas-grid">
              <div className="area-card">
                <div className="area-icon">🔧</div>
                <h3>Operating Room Assistance</h3>
                <p>
                  Direct surgical assistance, instrument handling, and 
                  operating room coordination during surgical procedures.
                </p>
                <ul className="area-features">
                  <li>Surgical instrument management</li>
                  <li>Operating room setup</li>
                  <li>Surgical field maintenance</li>
                  <li>Surgeon assistance</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">🩹</div>
                <h3>Anesthesia Support</h3>
                <p>
                  Advanced anesthesia assistance, patient monitoring, and 
                  airway management during surgical procedures.
                </p>
                <ul className="area-features">
                  <li>Anesthesia administration support</li>
                  <li>Patient monitoring</li>
                  <li>Airway management</li>
                  <li>Recovery care</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">🦠</div>
                <h3>Sterile Techniques</h3>
                <p>
                  Mastery of sterile procedures, infection control, and 
                  maintaining aseptic environments in surgical settings.
                </p>
                <ul className="area-features">
                  <li>Sterile field establishment</li>
                  <li>Infection control protocols</li>
                  <li>Sterile technique maintenance</li>
                  <li>Environmental monitoring</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">📊</div>
                <h3>Surgical Technology</h3>
                <p>
                  Advanced surgical equipment operation, technology integration, 
                  and modern surgical system management.
                </p>
                <ul className="area-features">
                  <li>Surgical equipment operation</li>
                  <li>Technology troubleshooting</li>
                  <li>System integration</li>
                  <li>Equipment maintenance</li>
                </ul>
              </div>
            </div>
          </div>

          {/* Clinical Training */}
          <div className="training-section">
            <h2>Clinical Training Excellence</h2>
            <div className="training-grid">
              <div className="training-item">
                <div className="training-header">
                  <h3>Operating Room Simulation</h3>
                  <div className="training-icon">🏥</div>
                </div>
                <p>
                  State-of-the-art operating room simulators for surgical 
                  procedure practice and team coordination training.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Virtual surgery simulation</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Team coordination training</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Emergency scenario practice</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Instrument Skills Lab</h3>
                  <div className="training-icon">🔧</div>
                </div>
                <p>
                  Hands-on training with surgical instruments, equipment 
                  setup, and sterile technique development.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Instrument identification</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Suture and needle skills</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Laparoscopic techniques</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Anesthesia Training</h3>
                  <div className="training-icon">💉</div>
                </div>
                <p>
                  Advanced anesthesia equipment operation, patient monitoring, 
                  and emergency response training.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Anesthesia machine operation</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Patient monitoring systems</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Airway management skills</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Career Opportunities */}
          <div className="career-section">
            <h2>Career Opportunities</h2>
            <div className="career-grid">
              <div className="career-item">
                <div className="career-icon">⚕️</div>
                <h3>Operating Room Roles</h3>
                <ul className="career-list">
                  <li>Scrub Nurse</li>
                  <li>Circulating Nurse</li>
                  <li>First Assistant</li>
                  <li>Operating Room Manager</li>
                  <li>Surgical Team Lead</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">🩹</div>
                <h3>Anesthesia Roles</h3>
                <ul className="career-list">
                  <li>Anesthesia Nurse</li>
                  <li>Recovery Room Nurse</li>
                  <li>PACU Nurse</li>
                  <li>Anesthesia Technician</li>
                  <li>Pain Management Nurse</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">🎓</div>
                <h3>Advanced Practice</h3>
                <ul className="career-list">
                  <li>Perioperative Nurse Practitioner</li>
                  <li>Surgical Nurse Specialist</li>
                  <li>Operating Room Consultant</li>
                  <li>Surgical Educator</li>
                  <li>Clinical Nurse Specialist</li>
                </ul>
              </div>
            </div>
          </div>

          {/* Department Stats */}
          <div className="stats-section">
            <h2>Department Impact</h2>
            <div className="stats-grid">
              <div className="stat-item">
                <div className="stat-number">100+</div>
                <div className="stat-label">Students Enrolled</div>
                <div className="stat-desc">Perioperative program</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">18+</div>
                <div className="stat-label">Operating Rooms</div>
                <div className="stat-desc">Clinical training sites</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">99%</div>
                <div className="stat-label">Safety Record</div>
                <div className="stat-desc">Infection control compliance</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">30+</div>
                <div className="stat-label">Simulation Hours</div>
                <div className="stat-desc">Per student per semester</div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default OperativeTheatre
