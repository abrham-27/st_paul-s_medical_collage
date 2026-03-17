import { type JSX } from 'react'
import './EmergencyCriticalCare.css'

interface EmergencyCriticalCareProps {
  onBack: () => void
}

function EmergencyCriticalCare({ onBack }: EmergencyCriticalCareProps): JSX.Element {
  return (
    <div className="emergency-critical-care">
      {/* Hero Section */}
      <section className="department-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>Emergency & Critical Care Nursing</h1>
            <p>Life-Saving Expertise in Critical Moments</p>
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
                <div className="mission-icon">🚑</div>
                <div className="mission-text">
                  <h3>Our Mission</h3>
                  <p>
                    To produce highly skilled emergency and critical care nurses capable of 
                    providing rapid, evidence-based interventions in life-threatening situations 
                    while maintaining compassion and professional excellence.
                  </p>
                </div>
              </div>
              <div className="department-intro">
                <p>
                  The Department of Emergency and Critical Care Nursing at St. Paul's Hospital 
                  Millennium Medical College is dedicated to training nurses who can excel in 
                  high-pressure medical environments. Our program combines advanced theoretical 
                  knowledge with extensive hands-on clinical experience to prepare graduates 
                  for the challenges of emergency medicine and intensive care units.
                </p>
              </div>
            </div>
          </div>

          {/* Key Areas */}
          <div className="areas-section">
            <h2>Specialization Areas</h2>
            <div className="areas-grid">
              <div className="area-card">
                <div className="area-icon">⚡</div>
                <h3>Emergency Nursing</h3>
                <p>
                  Rapid assessment and intervention for acute medical conditions, trauma 
                  care, and emergency department operations.
                </p>
                <ul className="area-features">
                  <li>Triage and rapid assessment</li>
                  <li>Trauma and injury management</li>
                  <li>Emergency medication administration</li>
                  <li>Crisis communication skills</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">🫁</div>
                <h3>Critical Care Nursing</h3>
                <p>
                  Advanced care for critically ill patients in ICU/CCU settings, 
                  including ventilator management and hemodynamic monitoring.
                </p>
                <ul className="area-features">
                  <li>Mechanical ventilation support</li>
                  <li>Hemodynamic monitoring</li>
                  <li>Advanced life support</li>
                  <li>Critical care pharmacology</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">💉</div>
                <h3>Trauma Nursing</h3>
                <p>
                  Specialized care for trauma patients, including mass casualty 
                  incidents and disaster response protocols.
                </p>
                <ul className="area-features">
                  <li>Trauma assessment protocols</li>
                  <li>Mass casualty management</li>
                  <li>Disaster preparedness</li>
                  <li>Emergency surgical assistance</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">🔥</div>
                <h3>Acute Care</h3>
                <p>
                  Management of acute exacerbations of chronic conditions and 
                  rapid deterioration scenarios in various clinical settings.
                </p>
                <ul className="area-features">
                  <li>Acute deterioration recognition</li>
                  <li>Rapid response teams</li>
                  <li>Acute medication management</li>
                  <li>Critical pathway navigation</li>
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
                  <h3>Simulation Labs</h3>
                  <div className="training-icon">🏥</div>
                </div>
                <p>
                  State-of-the-art simulation centers with high-fidelity manikins 
                  for emergency scenarios, code blue drills, and critical care 
                  skill development.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>High-fidelity simulators</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Emergency scenario training</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Code blue simulations</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Clinical Rotations</h3>
                  <div className="training-icon">🔄</div>
                </div>
                <p>
                  Extensive clinical rotations through emergency departments, 
                  intensive care units, and trauma centers for real-world experience.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>ED clinical rotations</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>ICU/CCU placements</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Trauma center experience</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Advanced Skills Labs</h3>
                  <div className="training-icon">🔬</div>
                </div>
                <p>
                  Specialized skills training for advanced procedures, equipment 
                  operation, and emergency intervention techniques.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Advanced airway management</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Critical care equipment</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Emergency procedure labs</span>
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
                <h3>Hospital Settings</h3>
                <ul className="career-list">
                  <li>Emergency Department Nurse</li>
                  <li>Intensive Care Unit Nurse</li>
                  <li>Trauma Center Nurse</li>
                  <li>Critical Care Transport Nurse</li>
                  <li>Emergency Room Manager</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">⚕️</div>
                <h3>Specialized Roles</h3>
                <ul className="career-list">
                  <li>Flight Nurse</li>
                  <li>Disaster Response Nurse</li>
                  <li>Critical Care Educator</li>
                  <li>Emergency Department Consultant</li>
                  <li>Trauma Program Coordinator</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">🎓</div>
                <h3>Advanced Practice</h3>
                <ul className="career-list">
                  <li>Critical Care Nurse Practitioner</li>
                  <li>Emergency Nurse Practitioner</li>
                  <li>Clinical Nurse Specialist</li>
                  <li>Acute Care Nurse Practitioner</li>
                  <li>Critical Care Clinical Nurse Leader</li>
                </ul>
              </div>
            </div>
          </div>

          {/* Department Stats */}
          <div className="stats-section">
            <h2>Department Impact</h2>
            <div className="stats-grid">
              <div className="stat-item">
                <div className="stat-number">150+</div>
                <div className="stat-label">Students Enrolled</div>
                <div className="stat-desc">Across all program levels</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">20+</div>
                <div className="stat-label">Clinical Partners</div>
                <div className="stat-desc">Major hospitals and centers</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">98%</div>
                <div className="stat-label">Employment Rate</div>
                <div className="stat-desc">Within 6 months of graduation</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">24/7</div>
                <div className="stat-label">Simulation Access</div>
                <div className="stat-desc">Advanced training facilities</div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default EmergencyCriticalCare
