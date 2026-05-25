import { type JSX, useState, useEffect } from 'react'
import './alumni.css'

interface Alumni {
  id: string
  name: string
  graduationYear: number
  degree: string
  specialization: string
  currentPosition: string
  workplace: string
  location: string
  email: string
  phone?: string
  linkedin?: string
  image?: string
  achievements: string[]
  bio: string
  isFeatured: boolean
}

function AlumniPage(): JSX.Element {
  const [searchTerm, setSearchTerm] = useState('')
  const [filterYear, setFilterYear] = useState('')
  const [filterDepartment, setFilterDepartment] = useState('')
  const [selectedAlumni, setSelectedAlumni] = useState<Alumni | null>(null)
  const [showModal, setShowModal] = useState(false)

  // Placeholder data - will be replaced with backend API call
  const alumniData: Alumni[] = [
    {
      id: '1',
      name: 'Dr. Alemayehu Bekele',
      graduationYear: 2015,
      degree: 'Doctor of Medicine',
      specialization: 'Cardiology',
      currentPosition: 'Senior Cardiologist',
      workplace: 'St. Paul\'s Hospital',
      location: 'Addis Ababa, Ethiopia',
      email: 'alemayehu.bekele@email.com',
      linkedin: 'linkedin.com/in/alemayehu-bekele',
      image: '/api/placeholder/200/200',
      achievements: [
        'Published 15+ research papers in cardiology',
        'Established cardiac rehabilitation program',
        'Mentored 50+ medical students'
      ],
      bio: 'Dr. Alemayehu is a distinguished cardiologist dedicated to advancing cardiovascular care in Ethiopia. After graduating from St. Paul\'s, he completed his fellowship in interventional cardiology and has been instrumental in establishing modern cardiac care protocols.',
      isFeatured: true
    },
    {
      id: '2',
      name: 'Dr. Sofia Tesfaye',
      graduationYear: 2018,
      degree: 'Doctor of Medicine',
      specialization: 'Pediatrics',
      currentPosition: 'Pediatric Emergency Physician',
      workplace: 'Black Lion Hospital',
      location: 'Addis Ababa, Ethiopia',
      email: 'sofia.tesfaye@email.com',
      phone: '+251 911 234 567',
      image: '/api/placeholder/200/200',
      achievements: [
        'Led pediatric emergency response team',
        'Developed pediatric triage protocols',
        'International speaker on child health'
      ],
      bio: 'Dr. Sofia specializes in pediatric emergency medicine and has been a pioneer in developing child-friendly emergency care systems in Ethiopia. Her work has significantly improved pediatric emergency outcomes.',
      isFeatured: true
    },
    {
      id: '3',
      name: 'Dr. Kassahun Lemma',
      graduationYear: 2016,
      degree: 'Doctor of Medicine',
      specialization: 'Surgery',
      currentPosition: 'General Surgeon',
      workplace: 'Myungsung Medical Center',
      location: 'Addis Ababa, Ethiopia',
      email: 'kassahun.lemma@email.com',
      linkedin: 'linkedin.com/in/kassahun-lemma',
      image: '/api/placeholder/200/200',
      achievements: [
        'Performed 1000+ successful surgeries',
        'Introduced minimally invasive techniques',
        'Trained 20+ surgical residents'
      ],
      bio: 'Dr. Kassahun is a skilled general surgeon known for his expertise in minimally invasive surgical techniques. He has been instrumental in training the next generation of surgeons.',
      isFeatured: false
    },
    {
      id: '4',
      name: 'Dr. Hanna Solomon',
      graduationYear: 2019,
      degree: 'Doctor of Medicine',
      specialization: 'Obstetrics & Gynecology',
      currentPosition: 'OB/GYN Specialist',
      workplace: 'St. Paul\'s Hospital',
      location: 'Addis Ababa, Ethiopia',
      email: 'hanna.solomon@email.com',
      image: '/api/placeholder/200/200',
      achievements: [
        'Reduced maternal mortality rates',
        'Established women\'s health clinic',
        'Research in reproductive health'
      ],
      bio: 'Dr. Hanna is dedicated to improving maternal and child health outcomes. Her work in establishing comprehensive women\'s health services has been recognized nationally.',
      isFeatured: true
    },
    {
      id: '5',
      name: 'Dr. Yonas Tekle',
      graduationYear: 2017,
      degree: 'Doctor of Medicine',
      specialization: 'Internal Medicine',
      currentPosition: 'Internal Medicine Physician',
      workplace: 'Adera Medical Center',
      location: 'Addis Ababa, Ethiopia',
      email: 'yonas.tekle@email.com',
      linkedin: 'linkedin.com/in/yonas-tekle',
      image: '/api/placeholder/200/200',
      achievements: [
        'Diabetes management program leader',
        'Published research on tropical diseases',
        'Community health advocate'
      ],
      bio: 'Dr. Yonas specializes in internal medicine with a focus on chronic disease management. His work in diabetes care has improved patient outcomes significantly.',
      isFeatured: false
    }
  ]

  const [filteredAlumni, setFilteredAlumni] = useState<Alumni[]>(alumniData)

  useEffect(() => {
    // Filter alumni based on search and filters
    let filtered = alumniData.filter(alumni => {
      const matchesSearch = alumni.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                          alumni.specialization.toLowerCase().includes(searchTerm.toLowerCase()) ||
                          alumni.workplace.toLowerCase().includes(searchTerm.toLowerCase())
      
      const matchesYear = !filterYear || alumni.graduationYear.toString() === filterYear
      const matchesDepartment = !filterDepartment || 
                              alumni.specialization.toLowerCase().includes(filterDepartment.toLowerCase())
      
      return matchesSearch && matchesYear && matchesDepartment
    })

    setFilteredAlumni(filtered)
  }, [searchTerm, filterYear, filterDepartment])

  const featuredAlumni = alumniData.filter(alumni => alumni.isFeatured)
  const graduationYears = [...new Set(alumniData.map(alumni => alumni.graduationYear))].sort((a, b) => b - a)
  const departments = [...new Set(alumniData.map(alumni => alumni.specialization))]

  const openModal = (alumni: Alumni) => {
    setSelectedAlumni(alumni)
    setShowModal(true)
  }

  const closeModal = () => {
    setShowModal(false)
    setSelectedAlumni(null)
  }

  return (
    <div className="alumni-page">
      {/* Hero Section */}
      <section className="alumni-hero">
        <div className="hero-overlay">
          <div className="container">
            <h1>Our Alumni Network</h1>
            <p>Connecting Excellence, Building Futures</p>
            <div className="hero-stats">
              <div className="stat-item">
                <div className="stat-number">5000+</div>
                <div className="stat-label">Graduates</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">50+</div>
                <div className="stat-label">Countries</div>
              </div>
              <div className="stat-item">
                <div className="stat-number">100+</div>
                <div className="stat-label">Hospitals</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Featured Alumni */}
      <section className="featured-section">
        <div className="container">
          <h2>Featured Alumni</h2>
          <div className="featured-grid">
            {featuredAlumni.map(alumni => (
              <div key={alumni.id} className="featured-card" onClick={() => openModal(alumni)}>
                <div className="featured-image">
                  <img src={alumni.image || '/api/placeholder/200/200'} alt={alumni.name} />
                  <div className="featured-badge">Featured</div>
                </div>
                <div className="featured-content">
                  <h3>{alumni.name}</h3>
                  <p className="alumni-position">{alumni.currentPosition}</p>
                  <p className="alumni-workplace">{alumni.workplace}</p>
                  <div className="alumni-meta">
                    <span className="graduation-year">Class of {alumni.graduationYear}</span>
                    <span className="specialization">{alumni.specialization}</span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Search and Filters */}
      <section className="search-section">
        <div className="container">
          <div className="search-filters">
            <div className="search-box">
              <input
                type="text"
                placeholder="Search alumni by name, specialization, or workplace..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="search-input"
              />
              <button className="search-btn">Search</button>
            </div>
            
            <div className="filters">
              <select 
                value={filterYear} 
                onChange={(e) => setFilterYear(e.target.value)}
                className="filter-select"
              >
                <option value="">All Years</option>
                {graduationYears.map(year => (
                  <option key={year} value={year}>Class of {year}</option>
                ))}
              </select>
              
              <select 
                value={filterDepartment} 
                onChange={(e) => setFilterDepartment(e.target.value)}
                className="filter-select"
              >
                <option value="">All Departments</option>
                {departments.map(dept => (
                  <option key={dept} value={dept}>{dept}</option>
                ))}
              </select>
            </div>
          </div>
        </div>
      </section>

      {/* Alumni Directory */}
      <section className="directory-section">
        <div className="container">
          <h2>Alumni Directory</h2>
          <p className="directory-count">Showing {filteredAlumni.length} alumni</p>
          
          <div className="alumni-grid">
            {filteredAlumni.map(alumni => (
              <div key={alumni.id} className="alumni-card" onClick={() => openModal(alumni)}>
                <div className="alumni-image">
                  <img src={alumni.image || '/api/placeholder/200/200'} alt={alumni.name} />
                </div>
                <div className="alumni-info">
                  <h3>{alumni.name}</h3>
                  <p className="alumni-position">{alumni.currentPosition}</p>
                  <p className="alumni-workplace">{alumni.workplace}</p>
                  <p className="alumni-location">📍 {alumni.location}</p>
                  <div className="alumni-meta">
                    <span className="graduation-year">Class of {alumni.graduationYear}</span>
                    <span className="specialization">{alumni.specialization}</span>
                  </div>
                  <div className="alumni-actions">
                    <button className="contact-btn">Contact</button>
                    <button className="profile-btn">View Profile</button>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Alumni Modal */}
      {showModal && selectedAlumni && (
        <div className="modal-overlay" onClick={closeModal}>
          <div className="modal-content" onClick={(e) => e.stopPropagation()}>
            <button className="modal-close" onClick={closeModal}>×</button>
            
            <div className="modal-header">
              <div className="modal-image">
                <img src={selectedAlumni.image || '/api/placeholder/200/200'} alt={selectedAlumni.name} />
              </div>
              <div className="modal-info">
                <h2>{selectedAlumni.name}</h2>
                <p className="modal-position">{selectedAlumni.currentPosition}</p>
                <p className="modal-workplace">{selectedAlumni.workplace}</p>
                <p className="modal-location">📍 {selectedAlumni.location}</p>
              </div>
            </div>
            
            <div className="modal-body">
              <div className="modal-section">
                <h3>Education</h3>
                <p><strong>Degree:</strong> {selectedAlumni.degree}</p>
                <p><strong>Specialization:</strong> {selectedAlumni.specialization}</p>
                <p><strong>Graduation Year:</strong> {selectedAlumni.graduationYear}</p>
              </div>
              
              <div className="modal-section">
                <h3>Bio</h3>
                <p>{selectedAlumni.bio}</p>
              </div>
              
              <div className="modal-section">
                <h3>Achievements</h3>
                <ul>
                  {selectedAlumni.achievements.map((achievement, index) => (
                    <li key={index}>{achievement}</li>
                  ))}
                </ul>
              </div>
              
              <div className="modal-section">
                <h3>Contact Information</h3>
                <p><strong>Email:</strong> {selectedAlumni.email}</p>
                {selectedAlumni.phone && <p><strong>Phone:</strong> {selectedAlumni.phone}</p>}
                {selectedAlumni.linkedin && (
                  <p><strong>LinkedIn:</strong> <a href={`https://${selectedAlumni.linkedin}`} target="_blank" rel="noopener noreferrer">{selectedAlumni.linkedin}</a></p>
                )}
              </div>
            </div>
            
            <div className="modal-actions">
              <button className="modal-contact-btn">Send Message</button>
              <button className="modal-connect-btn">Connect</button>
            </div>
          </div>
        </div>
      )}

      {/* Call to Action */}
      <section className="cta-section">
        <div className="container">
          <div className="cta-content">
            <h2>Are You an Alumnus?</h2>
            <p>Join our growing network of healthcare professionals and stay connected with your alma mater.</p>
            <div className="cta-buttons">
              <button className="cta-primary">Register as Alumnus</button>
              <button className="cta-secondary">Update Your Profile</button>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default AlumniPage
