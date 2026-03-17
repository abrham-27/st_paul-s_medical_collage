import { type JSX } from 'react'
import './MedicalSurgical.css'

interface MedicalSurgicalProps {
  onBack: () => void
}

function MedicalSurgical({ onBack }: MedicalSurgicalProps): JSX.Element {
  return (
    <div className="medical-surgical">
      {/* Hero Section */}
      <section className="department-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>Medical & Surgical Nursing</h1>
            <p>Comprehensive Patient Care Excellence</p>
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
                    To develop competent medical-surgical nurses who can provide 
                    comprehensive care across diverse clinical settings, from general 
                    wards to specialized surgical units.
                  </p>
                </div>
              </div>
              <div className="department-intro">
                <p>
                  The Department of Medical and Surgical Nursing prepares nurses for the 
                  dynamic challenges of ward-based care and surgical assistance. Our 
                  curriculum integrates medical-surgical nursing theory with extensive 
                  clinical practice to develop well-rounded healthcare professionals.
                </p>
              </div>
            </div>
          </div>

          {/* Specialization Areas */}
          <div className="areas-section">
            <h2>Specialization Areas</h2>
            <div className="areas-grid">
              <div className="area-card">
                <div className="area-icon">🏥</div>
                <h3>Medical-Surgical Nursing</h3>
                <p>
                  Comprehensive care for adult patients with diverse medical 
                  and surgical conditions across various clinical settings.
                </p>
                <ul className="area-features">
                  <li>Medical-surgical assessment</li>
                  <li>Chronic disease management</li>
                  <li>Medication administration</li>
                  <li>Patient education</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">⚕️</div>
                <h3>Perioperative Nursing</h3>
                <p>
                  Specialized care for patients undergoing surgical procedures, 
                  including pre-operative preparation and post-operative recovery.
                </p>
                <ul className="area-features">
                  <li>Pre-operative assessment</li>
                  <li>Operating room assistance</li>
                  <li>Anesthesia support</li>
                  <li>Post-operative care</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">🩹</div>
                <h3>Ward Management</h3>
                <p>
                  Leadership and coordination of nursing care in medical 
                  and surgical wards, ensuring quality and efficiency.
                </p>
                <ul className="area-features">
                  <li>Ward administration</li>
                  <li>Resource management</li>
                  <li>Quality improvement</li>
                  <li>Team coordination</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">📋</div>
                <h3>Clinical Documentation</h3>
                <p>
                  Expert documentation practices for legal compliance, 
                  care continuity, and quality improvement initiatives.
                </p>
                <ul className="area-features">
                  <li>Care planning documentation</li>
                  <li>Progress note writing</li>
                  <li>Medication administration records</li>
                  <li>Clinical audit participation</li>
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
                  <h3>Ward-Based Training</h3>
                  <div className="training-icon">🏥</div>
                </div>
                <p>
                  Extensive clinical rotations through medical, surgical, and 
                  specialty wards for comprehensive patient care experience.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Medical ward rotations</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Surgical ward experience</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Specialty unit placements</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Surgical Skills Lab</h3>
                  <div className="training-icon">🔧</div>
                </div>
                <p>
                  Advanced training in surgical assistance, sterile techniques, 
                  and operating room equipment management.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Sterile technique mastery</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Surgical instrument training</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Operating room simulation</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Critical Care Training</h3>
                  <div className="training-icon">🫁</div>
                </div>
                <p>
                  Advanced skills for managing acutely ill medical-surgical 
                  patients in high-dependency care settings.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Critical assessment skills</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Advanced life support</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Hemodynamic monitoring</span>
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
                <div className="career-icon">🏥</div>
                <h3>Ward Settings</h3>
                <ul className="career-list">
                  <li>Medical Ward Nurse</li>
                  <li>Surgical Ward Nurse</li>
                  <li>Charge Nurse</li>
                  <li>Ward Manager</li>
                  <li>Clinical Nurse Leader</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">⚕️</div>
                <h3>Surgical Settings</h3>
                <ul className="career-list">
                  <li>Operating Room Nurse</li>
                  <li>Perioperative Nurse</li>
                  <li>Surgical First Assistant</li>
                  <li>Day Surgery Nurse</li>
                  <li>Surgical Nurse Specialist</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">🎓</div>
                <h3>Advanced Practice</h3>
                <ul className="career-list">
                  <li>Medical-Surgical Nurse Practitioner</li>
                  <li>Clinical Nurse Specialist</li>
                  <li>Wound Care Specialist</li>
                  <li>Stoma Care Nurse</li>
                  <li>Clinical Nurse Consultant</li>
                </ul>
              </div>
            </div>
          </div>

          {/* Department Stats */}
          <div className="stats-section">
            <h2>Department Impact</h2>
            <div className="stats-grid">
              <div className="stat-item">
                <div className="stat-number">180+</div>
                <div className="stat-label">Students Enrolled</div>
                <div className="stat-desc">Medical-surgical program</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">25+</div>
                <div className="stat-label">Clinical Partners</div>
                <div className="stat-desc">Hospitals and surgical centers</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">96%</div>
                <div className="stat-label">Employment Rate</div>
                <div className="stat-desc">Within 6 months of graduation</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">40+</div>
                <div className="stat-label">Ward Rotations</div>
                <div className="stat-desc">Clinical placement sites</div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default MedicalSurgical
