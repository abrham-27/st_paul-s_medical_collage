import React, { useState } from 'react';
import './Alumni.css';

interface AlumniMember {
  id: number;
  name: string;
  graduationYear: string;
  degree: string;
  specialty: string;
  currentPosition: string;
  workplace: string;
  location: string;
  email: string;
  phone: string;
  image: string;
  achievements: string[];
  socialLinks?: {
    linkedin?: string;
    twitter?: string;
    researchGate?: string;
  };
  publications?: number;
  awards?: string[];
}

interface AlumniProps {
  onBack: () => void;
}

const Alumni: React.FC<AlumniProps> = ({ onBack }) => {
  const [activeTab, setActiveTab] = useState('spotlight');
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedSpecialty, setSelectedSpecialty] = useState('all');
  const [selectedYear, setSelectedYear] = useState('all');

  // Enhanced mock data - will be replaced with backend data
  const featuredAlumni: AlumniMember[] = [
    {
      id: 1,
      name: "Dr. Sara Tekle",
      graduationYear: "2015",
      degree: "Doctor of Medicine",
      specialty: "Cardiology",
      currentPosition: "Senior Cardiologist",
      workplace: "Mayo Clinic",
      location: "Rochester, USA",
      email: "sara.tekle@sphmmc.edu.et",
      phone: "+1 507 123 4567",
      image: "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face",
      achievements: [
        "Pioneered minimally invasive cardiac procedures",
        "Published 25+ research papers in cardiology",
        "Established cardiac rehabilitation program",
        "WHO consultant for cardiovascular health"
      ],
      socialLinks: {
        linkedin: "https://linkedin.com/in/saratekle",
        researchGate: "https://researchgate.net/profile/Sara-Tekle"
      },
      publications: 25,
      awards: ["Excellence in Cardiology Award 2022", "Innovation in Medicine 2021"]
    },
    {
      id: 2,
      name: "Dr. Michael Bekele",
      graduationYear: "2018",
      degree: "Doctor of Medicine",
      specialty: "Pediatrics",
      currentPosition: "Director",
      workplace: "Children's Hospital Ethiopia",
      location: "Addis Ababa, Ethiopia",
      email: "michael.bekele@sphmmc.edu.et",
      phone: "+251 911 234 567",
      image: "https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face",
      achievements: [
        "Established pediatric oncology unit",
        "Reduced child mortality by 40%",
        "Trained 100+ pediatric specialists",
        "UNICEF pediatric health consultant"
      ],
      socialLinks: {
        linkedin: "https://linkedin.com/in/michaelbekele",
        twitter: "https://twitter.com/drbekele"
      },
      publications: 18,
      awards: ["Humanitarian Award 2023", "Excellence in Pediatrics 2022"]
    },
    {
      id: 3,
      name: "Dr. Lena Tadesse",
      graduationYear: "2012",
      degree: "Doctor of Medicine",
      specialty: "Public Health",
      currentPosition: "WHO Representative",
      workplace: "World Health Organization",
      location: "Nairobi, Kenya",
      email: "lena.tadesse@sphmmc.edu.et",
      phone: "+254 712 345 678",
      image: "https://images.unsplash.com/photo-1594824476967-48c8b964f137?w=400&h=400&fit=crop&crop=face",
      achievements: [
        "Led malaria eradication initiatives",
        "Established national vaccination program",
        "Published 30+ public health papers",
        "Advisor to Ministry of Health"
      ],
      socialLinks: {
        linkedin: "https://linkedin.com/in/lenatadesse",
        researchGate: "https://researchgate.net/profile/Lena-Tadesse"
      },
      publications: 32,
      awards: ["Global Health Leadership Award 2023", "WHO Excellence Award 2021"]
    }
  ];

  const recentGraduates: AlumniMember[] = [
    {
      id: 4,
      name: "Dr. Samuel Kassa",
      graduationYear: "2023",
      degree: "Doctor of Medicine",
      specialty: "Emergency Medicine",
      currentPosition: "Resident",
      workplace: "SPHMMC",
      location: "Addis Ababa, Ethiopia",
      email: "samuel.kassa@sphmmc.edu.et",
      phone: "+251 913 456 789",
      image: "https://images.unsplash.com/photo-1582750433449-648ed127bb54b?w=400&h=400&fit=crop&crop=face",
      achievements: [
        "Best Resident Award 2023",
        "Published first research paper"
      ],
      publications: 1
    },
    {
      id: 5,
      name: "Dr. Hannah Girma",
      graduationYear: "2023",
      degree: "Doctor of Medicine",
      specialty: "Obstetrics & Gynecology",
      currentPosition: "Medical Officer",
      workplace: "Bahir Dar Hospital",
      location: "Bahir Dar, Ethiopia",
      email: "hannah.girma@sphmmc.edu.et",
      phone: "+251 914 567 890",
      image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&crop=face",
      achievements: [
        "Established maternal health outreach",
        "Reduced maternal complications"
      ]
    },
    {
      id: 6,
      name: "Dr. Daniel Tesfaye",
      graduationYear: "2022",
      degree: "Doctor of Medicine",
      specialty: "Internal Medicine",
      currentPosition: "Fellow",
      workplace: "Harvard Medical School",
      location: "Boston, USA",
      email: "daniel.tesfaye@sphmmc.edu.et",
      phone: "+1 617 123 4567",
      image: "https://images.unsplash.com/photo-1556157382-97eda2d62296a?w=400&h=400&fit=crop&crop=face",
      achievements: [
        "Harvard Medical Fellowship",
        "Published 5 research papers"
      ],
      socialLinks: {
        linkedin: "https://linkedin.com/in/danieltsefaye",
        researchGate: "https://researchgate.net/profile/Daniel-Tesfaye"
      },
      publications: 5
    }
  ];

  const alumniStats = [
    { number: "5000+", label: "Alumni Worldwide", icon: "🌍" },
    { number: "45+", label: "Countries", icon: "🏛️" },
    { number: "200+", label: "Specialists", icon: "🩺" },
    { number: "1000+", label: "Research Papers", icon: "🔬" },
    { number: "50+", label: "Hospital Leaders", icon: "🏥" },
    { number: "25+", label: "Academic Faculty", icon: "🎓" }
  ];

  const upcomingEvents = [
    {
      id: 1,
      title: "Alumni Reunion 2026",
      date: "July 15-17, 2026",
      location: "SPHMMC Campus",
      type: "Reunion",
      description: "Join us for a weekend of networking, learning, and celebration",
      attendees: "500+ expected"
    },
    {
      id: 2,
      title: "Medical Innovation Summit",
      date: "September 10, 2026",
      location: "Virtual",
      type: "Conference",
      description: "Global summit on medical innovation and healthcare technology",
      attendees: "1000+ expected"
    },
    {
      id: 3,
      title: "Homecoming Weekend",
      date: "December 5-7, 2026",
      location: "Addis Ababa",
      type: "Social",
      description: "Annual gathering with cultural events and networking",
      attendees: "300+ expected"
    },
    {
      id: 4,
      title: "Research Symposium",
      date: "March 20, 2026",
      location: "SPHMMC",
      type: "Academic",
      description: "Showcase of alumni research and innovations",
      attendees: "200+ expected"
    }
  ];

  // Combine all alumni for filtering
  const allAlumni = [...featuredAlumni, ...recentGraduates];

  // Filter functions
  const filteredAlumni = allAlumni.filter(alumni => {
    const matchesSearch = alumni.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         alumni.specialty.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         alumni.workplace.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         alumni.location.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesSpecialty = selectedSpecialty === 'all' || alumni.specialty === selectedSpecialty;
    const matchesYear = selectedYear === 'all' || alumni.graduationYear === selectedYear;
    
    return matchesSearch && matchesSpecialty && matchesYear;
  });

  // Get unique specialties and years for filters
  const specialties = Array.from(new Set(allAlumni.map(a => a.specialty)));
  const years = Array.from(new Set(allAlumni.map(a => a.graduationYear))).sort();

  return (
    <div className="alumni-page">
      <div className="alumni-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to Home</button>
          <h1>SPHMMC Alumni Network</h1>
          <p className="header-subtitle">Connecting medical leaders worldwide since 2007</p>
        </div>
      </div>

      {/* Enhanced Statistics Section */}
      <section className="alumni-stats-section">
        <div className="container">
          <div className="stats-grid">
            {alumniStats.map((stat, index) => (
              <div key={index} className="stat-card">
                <div className="stat-icon">{stat.icon}</div>
                <div className="stat-number">{stat.number}</div>
                <div className="stat-label">{stat.label}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Enhanced Navigation Tabs */}
      <section className="alumni-tabs-section">
        <div className="container">
          <div className="tabs-container">
            <button 
              className={`tab-button ${activeTab === 'spotlight' ? 'active' : ''}`}
              onClick={() => setActiveTab('spotlight')}
            >
              Alumni Spotlight
            </button>
            <button 
              className={`tab-button ${activeTab === 'directory' ? 'active' : ''}`}
              onClick={() => setActiveTab('directory')}
            >
              Directory
            </button>
            <button 
              className={`tab-button ${activeTab === 'events' ? 'active' : ''}`}
              onClick={() => setActiveTab('events')}
            >
              Events
            </button>
            <button 
              className={`tab-button ${activeTab === 'network' ? 'active' : ''}`}
              onClick={() => setActiveTab('network')}
            >
              Network
            </button>
          </div>
        </div>
      </section>

      {/* Tab Content */}
      <section className="alumni-content-section">
        <div className="container">
          
          {/* Alumni Spotlight Tab */}
          {activeTab === 'spotlight' && (
            <div className="tab-content">
              <div className="section-header">
                <h2>Featured Alumni Success Stories</h2>
                <p>Celebrating our distinguished graduates making global impact</p>
              </div>
              
              <div className="featured-grid">
                {featuredAlumni.map((alumni) => (
                  <div key={alumni.id} className="featured-card">
                    <div className="featured-image">
                      <img src={alumni.image} alt={alumni.name} />
                      <div className="graduation-badge">Class of {alumni.graduationYear}</div>
                      {alumni.awards && alumni.awards.length > 0 && (
                        <div className="award-badge">🏆 Award Winner</div>
                      )}
                    </div>
                    <div className="featured-content">
                      <h3>{alumni.name}</h3>
                      <p className="degree">{alumni.degree}</p>
                      <p className="specialty">{alumni.specialty}</p>
                      <p className="current-role">{alumni.currentPosition}</p>
                      <p className="workplace">{alumni.workplace}</p>
                      <p className="location">📍 {alumni.location}</p>
                      
                      <div className="achievements-section">
                        <h4>Key Achievements:</h4>
                        <ul>
                          {alumni.achievements.slice(0, 3).map((achievement, index) => (
                            <li key={index}>{achievement}</li>
                          ))}
                        </ul>
                      </div>

                      {alumni.publications && (
                        <div className="publications">
                          <strong>Publications:</strong> {alumni.publications}+ research papers
                        </div>
                      )}

                      <div className="contact-info">
                        <p>📧 {alumni.email}</p>
                        {alumni.phone && <p>📱 {alumni.phone}</p>}
                      </div>

                      {alumni.socialLinks && (
                        <div className="social-links">
                          {alumni.socialLinks.linkedin && (
                            <a href={alumni.socialLinks.linkedin} target="_blank" rel="noopener noreferrer">
                              LinkedIn
                            </a>
                          )}
                          {alumni.socialLinks.twitter && (
                            <a href={alumni.socialLinks.twitter} target="_blank" rel="noopener noreferrer">
                              Twitter
                            </a>
                          )}
                          {alumni.socialLinks.researchGate && (
                            <a href={alumni.socialLinks.researchGate} target="_blank" rel="noopener noreferrer">
                              ResearchGate
                            </a>
                          )}
                        </div>
                      )}
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}

          {/* Enhanced Directory Tab */}
          {activeTab === 'directory' && (
            <div className="tab-content">
              <div className="section-header">
                <h2>Alumni Directory</h2>
                <div className="search-filters">
                  <div className="search-container">
                    <input
                      type="text"
                      placeholder="Search alumni by name, specialty, workplace, or location..."
                      value={searchTerm}
                      onChange={(e) => setSearchTerm(e.target.value)}
                      className="search-input"
                    />
                    <button className="search-btn">🔍</button>
                  </div>
                  <div className="filter-controls">
                    <select 
                      value={selectedSpecialty} 
                      onChange={(e) => setSelectedSpecialty(e.target.value)}
                      className="filter-select"
                    >
                      <option value="all">All Specialties</option>
                      {specialties.map(specialty => (
                        <option key={specialty} value={specialty}>{specialty}</option>
                      ))}
                    </select>
                    <select 
                      value={selectedYear} 
                      onChange={(e) => setSelectedYear(e.target.value)}
                      className="filter-select"
                    >
                      <option value="all">All Years</option>
                      {years.map(year => (
                        <option key={year} value={year}>Class of {year}</option>
                      ))}
                    </select>
                  </div>
                </div>
              </div>

              <div className="directory-grid">
                <div className="directory-section">
                  <h3>Found {filteredAlumni.length} Alumni</h3>
                  <div className="alumni-list">
                    {filteredAlumni.map((alumni) => (
                      <div key={alumni.id} className="directory-item">
                        <div className="alumni-photo">
                          <img src={alumni.image} alt={alumni.name} />
                        </div>
                        <div className="alumni-info">
                          <h4>{alumni.name}</h4>
                          <p className="grad-year">Class of {alumni.graduationYear}</p>
                          <p className="specialty">{alumni.specialty}</p>
                          <p className="position">{alumni.currentPosition}</p>
                          <p className="workplace">{alumni.workplace}</p>
                          <p className="location">📍 {alumni.location}</p>
                          <p className="email">📧 {alumni.email}</p>
                          {alumni.publications && (
                            <p className="publications">📚 {alumni.publications} publications</p>
                          )}
                        </div>
                        <div className="alumni-actions">
                          <button className="connect-btn">Connect</button>
                          <button className="profile-btn">View Profile</button>
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            </div>
          )}

          {/* Enhanced Events Tab */}
          {activeTab === 'events' && (
            <div className="tab-content">
              <div className="section-header">
                <h2>Upcoming Alumni Events</h2>
                <p>Join us for networking, learning, and celebrations</p>
              </div>

              <div className="events-grid">
                {upcomingEvents.map((event) => (
                  <div key={event.id} className="event-card">
                    <div className="event-header">
                      <span className="event-type">{event.type}</span>
                      <h3>{event.title}</h3>
                    </div>
                    <div className="event-details">
                      <p className="event-date">📅 {event.date}</p>
                      <p className="event-location">📍 {event.location}</p>
                      <p className="event-attendees">👥 {event.attendees}</p>
                      <p className="event-description">{event.description}</p>
                    </div>
                    <div className="event-actions">
                      <button className="register-btn">Register Now</button>
                      <button className="calendar-btn">Add to Calendar</button>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}

          {/* Enhanced Network Tab */}
          {activeTab === 'network' && (
            <div className="tab-content">
              <div className="section-header">
                <h2>Join Our Global Network</h2>
                <p>Connect, collaborate, and contribute to the SPHMMC community</p>
              </div>

              <div className="network-content">
                <div className="network-card">
                  <div className="network-icon">🌐</div>
                  <h3>Alumni Portal</h3>
                  <p>Access exclusive resources, job opportunities, and networking events. Connect with fellow graduates and stay updated with latest news.</p>
                  <ul className="network-features">
                    <li>Professional networking</li>
                    <li>Job board and career resources</li>
                    <li>Exclusive alumni events</li>
                    <li>Mentorship opportunities</li>
                  </ul>
                  <button className="portal-btn">Access Portal</button>
                </div>
                
                <div className="network-card">
                  <div className="network-icon">🎓</div>
                  <h3>Mentorship Program</h3>
                  <p>Share your expertise and guide the next generation of healthcare leaders. Make a lasting impact on current students and recent graduates.</p>
                  <ul className="network-features">
                    <li>One-on-one mentorship</li>
                    <li>Career guidance sessions</li>
                    <li>Research collaboration</li>
                    <li>Professional development</li>
                  </ul>
                  <button className="mentor-btn">Become a Mentor</button>
                </div>
                
                <div className="network-card">
                  <div className="network-icon">💝</div>
                  <h3>Give Back</h3>
                  <p>Support SPHMMC through donations, scholarships, and knowledge sharing. Help us maintain excellence in medical education.</p>
                  <ul className="network-features">
                    <li>Scholarship funds</li>
                    <li>Research grants</li>
                    <li>Infrastructure development</li>
                    <li>Faculty support</li>
                  </ul>
                  <button className="donate-btn">Support SPHMMC</button>
                </div>

                <div className="network-card">
                  <div className="network-icon">📢</div>
                  <h3>Share Your Story</h3>
                  <p>Inspire current students and fellow alumni by sharing your success story, achievements, and career journey.</p>
                  <ul className="network-features">
                    <li>Success story features</li>
                    <li>Alumni newsletter</li>
                    <li>Speaking opportunities</li>
                    <li>Social media highlights</li>
                  </ul>
                  <button className="story-btn">Share Your Story</button>
                </div>
              </div>
            </div>
          )}
        </div>
      </section>

      {/* Enhanced Call to Action */}
      <section className="alumni-cta">
        <div className="container">
          <div className="cta-content">
            <h2>Stay Connected with SPHMMC</h2>
            <p>Update your information, join our global network, and help us celebrate the achievements of our medical professionals making a difference worldwide.</p>
            <div className="cta-buttons">
              <button className="btn-primary">Update Profile</button>
              <button className="btn-secondary">Share Your Story</button>
              <button className="btn-outline">Join Newsletter</button>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Alumni;
