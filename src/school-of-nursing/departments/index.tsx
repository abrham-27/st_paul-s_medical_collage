import { type JSX } from 'react'
import './departments.css'

interface SchoolOfNursingDepartmentsProps {
  onBack: () => void
  onSelect: (id: string) => void
}

function SchoolOfNursingDepartments({ onBack, onSelect }: SchoolOfNursingDepartmentsProps): JSX.Element {
  return (
    <div className="nursing-departments">
      {/* Hero Section */}
      <section className="departments-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">
              ← Back
            </button>
            <h1>Our Departments</h1>
            <p>Excellence in Specialized Nursing Education</p>
          </div>
        </div>
      </section>

      {/* Main Content */}
      <section className="departments-content">
        <div className="container">
          {/* Departments Grid */}
          <div className="departments-grid">
            <div className="department-card">
              <div className="card-header emergency">
                <div className="department-icon">🚑</div>
                <h2>Emergency & Critical Care</h2>
                <p>Life-Saving Expertise</p>
              </div>
              <div className="card-content">
                <p className="department-description">
                  Specialized training for emergency situations and critical care environments, 
                  preparing nurses for high-pressure medical scenarios and life-saving interventions.
                </p>
                <ul className="department-features">
                  <li>Emergency response protocols</li>
                  <li>Critical care management</li>
                  <li>Trauma nursing expertise</li>
                  <li>Advanced life support</li>
                </ul>
                <a href="#" onClick={(e) => { e.preventDefault(); onSelect('emergency'); }} className="department-link">
                  Explore Department →
                </a>
              </div>
            </div>

            <div className="department-card">
              <div className="card-header neonatal">
                <div className="department-icon">👶</div>
                <h2>Neonatal & Pediatrics</h2>
                <p>Care for Youngest Patients</p>
              </div>
              <div className="card-content">
                <p className="department-description">
                  Focused on the specialized care needs of infants, children, and adolescents, 
                  with emphasis on developmental considerations and family-centered care.
                </p>
                <ul className="department-features">
                  <li>Neonatal intensive care</li>
                  <li>Pediatric assessment skills</li>
                  <li>Child development knowledge</li>
                  <li>Family support systems</li>
                </ul>
                <a href="#" onClick={(e) => { e.preventDefault(); onSelect('neonatal'); }} className="department-link">
                  Explore Department →
                </a>
              </div>
            </div>

            <div className="department-card">
              <div className="card-header medical">
                <div className="department-icon">⚕️</div>
                <h2>Medical & Surgical</h2>
                <p>Comprehensive Patient Care</p>
              </div>
              <div className="card-content">
                <p className="department-description">
                  Broad-based training covering medical-surgical nursing across diverse specialties, 
                  preparing nurses for ward-based care and surgical assistance.
                </p>
                <ul className="department-features">
                  <li>Medical-surgical nursing</li>
                  <li>Pre and post-operative care</li>
                  <li>Chronic disease management</li>
                  <li>Ward administration</li>
                </ul>
                <a href="#" onClick={(e) => { e.preventDefault(); onSelect('medical'); }} className="department-link">
                  Explore Department →
                </a>
              </div>
            </div>

            <div className="department-card">
              <div className="card-header operative">
                <div className="department-icon">⚕️</div>
                <h2>Operative Theatre</h2>
                <p>Surgical Excellence</p>
              </div>
              <div className="card-content">
                <p className="department-description">
                  Specialized perioperative nursing education, preparing nurses to assist 
                  in surgical procedures and maintain sterile, safe operating environments.
                </p>
                <ul className="department-features">
                  <li>Operating room assistance</li>
                  <li>Anesthesia support</li>
                  <li>Sterile technique mastery</li>
                  <li>Surgical instrumentation</li>
                </ul>
                <a href="#" onClick={(e) => { e.preventDefault(); onSelect('operative'); }} className="department-link">
                  Explore Department →
                </a>
              </div>
            </div>
          </div>

          {/* Overview Section */}
          <div className="overview-section">
            <h2>Department Excellence</h2>
            <div className="excellence-grid">
              <div className="excellence-item">
                <div className="excellence-icon">🎓</div>
                <h3>Expert Faculty</h3>
                <p>
                  Led by experienced nursing professionals with extensive clinical backgrounds 
                  and academic expertise in their respective specialties.
                </p>
              </div>
              <div className="excellence-item">
                <div className="excellence-icon">🏥</div>
                <h3>Advanced Facilities</h3>
                <p>
                  State-of-the-art simulation labs, clinical training centers, 
                  and modern equipment for hands-on learning experiences.
                </p>
              </div>
              <div className="excellence-item">
                <div className="excellence-icon">🔬</div>
                <h3>Research Integration</h3>
                <p>
                  Each department contributes to nursing research and evidence-based 
                  practice improvements in their specialty areas.
                </p>
              </div>
              <div className="excellence-item">
                <div className="excellence-icon">🤝</div>
                <h3>Community Impact</h3>
                <p>
                  Departments engage in community outreach and health promotion 
                  activities relevant to their specialty focus areas.
                </p>
              </div>
            </div>
          </div>

          {/* Statistics Section */}
          <div className="stats-section">
            <h2>Department Impact</h2>
            <div className="stats-grid">
              <div className="stat-item">
                <div className="stat-number">4</div>
                <div className="stat-label">Specialized Departments</div>
                <div className="stat-desc">Comprehensive nursing specialties</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">500+</div>
                <div className="stat-label">Students Enrolled</div>
                <div className="stat-desc">Across all departments</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">50+</div>
                <div className="stat-label">Clinical Partners</div>
                <div className="stat-desc">Training hospitals and centers</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">95%</div>
                <div className="stat-label">Employment Rate</div>
                <div className="stat-desc">Graduate success rate</div>
              </div>
            </div>
          </div>

          {/* Programs Section */}
          <div className="programs-section">
            <h2>Program Offerings</h2>
            <div className="programs-grid">
              <div className="program-card">
                <h3>Undergraduate Programs</h3>
                <ul className="program-list">
                  <li>BSc in Emergency and Critical Care Nursing</li>
                  <li>BSc in Neonatal and Pediatrics Nursing</li>
                  <li>BSc in Medical and Surgical Nursing</li>
                  <li>BSc in Operative Theatre Nursing</li>
                </ul>
                <p>4-year programs combining theory and extensive clinical practice</p>
              </div>
              <div className="program-card">
                <h3>Postgraduate Programs</h3>
                <ul className="program-list">
                  <li>MSc in Critical Care Nursing</li>
                  <li>MSc in Neonatal Nursing</li>
                  <li>MSc in Medical-Surgical Nursing</li>
                  <li>MSc in Perioperative Nursing</li>
                </ul>
                <p>Advanced specialization for nursing leadership and expertise</p>
              </div>
              <div className="program-card">
                <h3>Residency Programs</h3>
                <ul className="program-list">
                  <li>Nursing Residency in Critical Care</li>
                  <li>Nursing Residency in Neonatology</li>
                  <li>Nursing Residency in Perioperative Care</li>
                </ul>
                <p>Hospital-based training with hands-on clinical experience</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default SchoolOfNursingDepartments
