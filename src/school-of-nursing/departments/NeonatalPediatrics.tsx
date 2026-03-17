import { type JSX } from 'react'
import './NeonatalPediatrics.css'

interface NeonatalPediatricsProps {
  onBack: () => void
}

function NeonatalPediatrics({ onBack }: NeonatalPediatricsProps): JSX.Element {
  return (
    <div className="neonatal-pediatrics">
      {/* Hero Section */}
      <section className="department-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>Neonatal & Pediatrics Nursing</h1>
            <p>Care for Our Youngest Patients</p>
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
                <div className="mission-icon">👶</div>
                <div className="mission-text">
                  <h3>Our Mission</h3>
                  <p>
                    To prepare compassionate neonatal and pediatric nurses who can provide 
                    developmentally appropriate care for infants, children, and adolescents 
                    while supporting families through evidence-based practice.
                  </p>
                </div>
              </div>
              <div className="department-intro">
                <p>
                  The Department of Neonatal and Pediatrics Nursing focuses on the specialized 
                  healthcare needs of children from birth through adolescence. Our program 
                  emphasizes developmental considerations, family-centered care, and the unique 
                  physiological and psychological aspects of pediatric nursing.
                </p>
              </div>
            </div>
          </div>

          {/* Specialization Areas */}
          <div className="areas-section">
            <h2>Specialization Areas</h2>
            <div className="areas-grid">
              <div className="area-card">
                <div className="area-icon">🍼</div>
                <h3>Neonatal Nursing</h3>
                <p>
                  Specialized care for newborns, particularly premature infants 
                  and those with medical complications requiring intensive monitoring.
                </p>
                <ul className="area-features">
                  <li>Neonatal intensive care</li>
                  <li>Premature infant management</li>
                  <li>Newborn assessment skills</li>
                  <li>Parent education and support</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">👧</div>
                <h3>Pediatric Nursing</h3>
                <p>
                  Comprehensive care for children from infancy through adolescence, 
                  focusing on growth, development, and age-appropriate interventions.
                </p>
                <ul className="area-features">
                  <li>Developmental assessment</li>
                  <li>Pediatric medication management</li>
                  <li>Child growth monitoring</li>
                  <li>Age-specific care protocols</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">🏥</div>
                <h3>Pediatric Critical Care</h3>
                <p>
                  Advanced care for critically ill children, including pediatric 
                  intensive care and emergency pediatric interventions.
                </p>
                <ul className="area-features">
                  <li>Pediatric ICU management</li>
                  <li>Critical child assessment</li>
                  <li>Pediatric life support</li>
                  <li>Family crisis support</li>
                </ul>
              </div>

              <div className="area-card">
                <div className="area-icon">👨‍👩‍👧</div>
                <h3>Family-Centered Care</h3>
                <p>
                  Holistic approach involving parents and families in care planning, 
                  education, and support throughout the child's healthcare journey.
                </p>
                <ul className="area-features">
                  <li>Family education programs</li>
                  <li>Parent support systems</li>
                  <li>Child life care coordination</li>
                  <li>Home care preparation</li>
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
                  <h3>Neonatal Simulation</h3>
                  <div className="training-icon">🤱</div>
                </div>
                <p>
                  Advanced neonatal simulators for premature infant care, 
                  neonatal resuscitation, and intensive care skill development.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Premature infant simulators</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Neonatal resuscitation training</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>PICU simulation scenarios</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Pediatric Clinical Skills</h3>
                  <div className="training-icon">🩺</div>
                </div>
                <p>
                  Hands-on training in pediatric assessment, medication administration, 
                  and developmental care across all pediatric age groups.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Pediatric assessment labs</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Age-specific skill training</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Developmental care techniques</span>
                  </div>
                </div>
              </div>

              <div className="training-item">
                <div className="training-header">
                  <h3>Family Support Training</h3>
                  <div className="training-icon">👨‍👩‍👧</div>
                </div>
                <p>
                  Training in family education, counseling, and support 
                  strategies to enhance family-centered care delivery.
                </p>
                <div className="training-features">
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Parent education techniques</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Family counseling skills</span>
                  </div>
                  <div className="feature-item">
                    <span className="feature-icon">✓</span>
                    <span>Support system coordination</span>
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
                <div className="career-icon">🍼</div>
                <h3>Neonatal Settings</h3>
                <ul className="career-list">
                  <li>Neonatal Intensive Care Nurse</li>
                  <li>Nursery Level II/III Nurse</li>
                  <li>Neonatal Nurse Practitioner</li>
                  <li>Newborn Care Specialist</li>
                  <li>Lactation Consultant</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">👧</div>
                <h3>Pediatric Settings</h3>
                <ul className="career-list">
                  <li>Pediatric Unit Nurse</li>
                  <li>Pediatric ICU Nurse</li>
                  <li>Pediatric Emergency Nurse</li>
                  <li>Pediatric Nurse Practitioner</li>
                  <li>School Nurse</li>
                </ul>
              </div>

              <div className="career-item">
                <div className="career-icon">🏥</div>
                <h3>Specialized Roles</h3>
                <ul className="career-list">
                  <li>Developmental Care Nurse</li>
                  <li>Pediatric Clinical Nurse Specialist</li>
                  <li>Child Life Specialist</li>
                  <li>Pediatric Palliative Care Nurse</li>
                  <li>Pediatric Case Manager</li>
                </ul>
              </div>
            </div>
          </div>

          {/* Department Stats */}
          <div className="stats-section">
            <h2>Department Impact</h2>
            <div className="stats-grid">
              <div className="stat-item">
                <div className="stat-number">120+</div>
                <div className="stat-label">Students Enrolled</div>
                <div className="stat-desc">Across neonatal and pediatrics</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">15+</div>
                <div className="stat-label">Clinical Partners</div>
                <div className="stat-desc">Hospitals and specialty centers</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">97%</div>
                <div className="stat-label">Family Satisfaction</div>
                <div className="stat-desc">Parent feedback ratings</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">50+</div>
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

export default NeonatalPediatrics
