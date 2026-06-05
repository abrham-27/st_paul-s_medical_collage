import React, { useState, useEffect, useRef } from 'react';
import { apiService } from '../services/api';
import type { AlumniMember, AlumniEvent, AlumniStat } from '../services/api';
import './Alumni.css';

interface AlumniProps {
  onBack: () => void;
}

const Alumni: React.FC<AlumniProps> = ({ onBack }) => {
  const [activeTab, setActiveTab] = useState<'directory' | 'spotlight' | 'events' | 'register'>('directory');
  const [loading, setLoading] = useState<boolean>(true);
  const [alumniList, setAlumniList] = useState<AlumniMember[]>([]);
  const [stats, setStats] = useState<AlumniStat[]>([]);
  const [events, setEvents] = useState<AlumniEvent[]>([]);
  const [searchTerm, setSearchTerm] = useState<string>('');
  const [selectedSpecialty, setSelectedSpecialty] = useState<string>('all');
  const [selectedYear, setSelectedYear] = useState<string>('all');
  const [selectedAlumni, setSelectedAlumni] = useState<AlumniMember | null>(null);
  const [showModal, setShowModal] = useState<boolean>(false);
  const [specialties, setSpecialties] = useState<string[]>([]);
  const [years, setYears] = useState<string[]>([]);

  // Registration Form State
  const [formData, setFormData] = useState({
    name: '',
    graduation_year: new Date().getFullYear(),
    degree: 'Doctor of Medicine (MD)',
    specialty: '',
    current_position: '',
    workplace: '',
    location: '',
    email: '',
    phone: '',
    bio: '',
    linkedin: '',
    twitter: '',
    research_gate: '',
    publications: 0,
  });
  const [achievements, setAchievements] = useState<string[]>(['']);
  const [awards, setAwards] = useState<string[]>(['']);
  const [formImage, setFormImage] = useState<File | null>(null);
  const [imagePreview, setImagePreview] = useState<string | null>(null);
  const [submitting, setSubmitting] = useState<boolean>(false);
  const [submitSuccess, setSubmitSuccess] = useState<boolean>(false);
  const [submitError, setSubmitError] = useState<string | null>(null);

  const fileInputRef = useRef<HTMLInputElement>(null);

  const loadData = async () => {
    setLoading(true);
    try {
      // Fetch statistics
      const statsRes = await apiService.getAlumniStats();
      if (statsRes.success) {
        setStats(statsRes.data);
      }

      // Fetch upcoming events
      const eventsRes = await apiService.getAlumniEvents();
      if (eventsRes.success) {
        setEvents(eventsRes.data);
      }

      // Fetch all alumni
      const alumniRes = await apiService.getAlumni();
      if (alumniRes.success) {
        setAlumniList(alumniRes.data);
        
        // Extract unique specialties and years
        const extractedSpecialties = Array.from(new Set(alumniRes.data.map(a => a.specialty).filter(Boolean)));
        setSpecialties(extractedSpecialties);
        
        const extractedYears = Array.from(new Set(alumniRes.data.map(a => String(a.graduation_year)).filter(Boolean)))
          .sort((a, b) => b.localeCompare(a));
        setYears(extractedYears);
      }
    } catch (error) {
      console.error('Error fetching alumni data:', error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    loadData();
  }, []);

  // Filter alumni locally for directory view
  const filteredAlumni = alumniList.filter(alumni => {
    const matchesSearch = 
      alumni.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
      (alumni.specialty && alumni.specialty.toLowerCase().includes(searchTerm.toLowerCase())) ||
      (alumni.workplace && alumni.workplace.toLowerCase().includes(searchTerm.toLowerCase())) ||
      (alumni.location && alumni.location.toLowerCase().includes(searchTerm.toLowerCase()));
      
    const matchesSpecialty = selectedSpecialty === 'all' || alumni.specialty === selectedSpecialty;
    const matchesYear = selectedYear === 'all' || String(alumni.graduation_year) === selectedYear;
    
    return matchesSearch && matchesSpecialty && matchesYear;
  });

  // Featured alumni for Spotlight tab
  const featuredAlumni = alumniList.filter(alumni => alumni.is_featured);

  // Modal handlers
  const openModal = (alumni: AlumniMember) => {
    setSelectedAlumni(alumni);
    setShowModal(true);
  };

  const closeModal = () => {
    setShowModal(false);
    setSelectedAlumni(null);
  };

  // Form input handlers
  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleAchievementChange = (index: number, value: string) => {
    const updated = [...achievements];
    updated[index] = value;
    setAchievements(updated);
  };

  const addAchievementField = () => {
    setAchievements(prev => [...prev, '']);
  };

  const removeAchievementField = (index: number) => {
    if (achievements.length > 1) {
      setAchievements(prev => prev.filter((_, i) => i !== index));
    }
  };

  const handleAwardChange = (index: number, value: string) => {
    const updated = [...awards];
    updated[index] = value;
    setAwards(updated);
  };

  const addAwardField = () => {
    setAwards(prev => [...prev, '']);
  };

  const removeAwardField = (index: number) => {
    if (awards.length > 1) {
      setAwards(prev => prev.filter((_, i) => i !== index));
    }
  };

  const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (file) {
      setFormImage(file);
      const reader = new FileReader();
      reader.onloadend = () => {
        setImagePreview(reader.result as string);
      };
      reader.readAsDataURL(file);
    }
  };

  const handleFormSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setSubmitting(true);
    setSubmitError(null);

    try {
      const payload = new FormData();
      
      // Append standard fields
      Object.entries(formData).forEach(([key, value]) => {
        payload.append(key, String(value));
      });

      // Filter out empty achievements and awards and append as JSON strings
      const filteredAchievements = achievements.filter(a => a.trim() !== '');
      payload.append('achievements', JSON.stringify(filteredAchievements));

      const filteredAwards = awards.filter(a => a.trim() !== '');
      payload.append('awards', JSON.stringify(filteredAwards));

      // Append image if selected
      if (formImage) {
        payload.append('image', formImage);
      }

      const response = await apiService.registerAlumnus(payload);
      
      if (response.success) {
        setSubmitSuccess(true);
        // Refresh local directory data
        loadData();
        // Reset form
        setFormData({
          name: '',
          graduation_year: new Date().getFullYear(),
          degree: 'Doctor of Medicine (MD)',
          specialty: '',
          current_position: '',
          workplace: '',
          location: '',
          email: '',
          phone: '',
          bio: '',
          linkedin: '',
          twitter: '',
          research_gate: '',
          publications: 0,
        });
        setAchievements(['']);
        setAwards(['']);
        setFormImage(null);
        setImagePreview(null);
      } else {
        setSubmitError('Failed to register. Please check your inputs.');
      }
    } catch (error: any) {
      console.error('Registration error:', error);
      setSubmitError(error.message || 'An error occurred during submission. Please try again.');
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className="alumni-page">
      {/* Premium Hero Section */}
      <section className="alumni-hero">
        <div className="hero-gradient-overlay"></div>
        <div className="hero-content-container container">
          <button className="back-home-btn" onClick={onBack}>
            <span className="arrow">←</span> Back to Homepage
          </button>
          <div className="hero-badge">SPHMMC Alumni Association</div>
          <h1 className="hero-title">Connecting Medical Leaders Globally</h1>
          <p className="hero-description">
            Celebrating the legacy of St. Paul's Hospital Millennium Medical College. Our graduates are driving clinical excellence, medical research, and healthcare policy across the globe.
          </p>
          <div className="hero-cta-group">
            <button className="hero-btn-primary" onClick={() => setActiveTab('register')}>
              Join Network & Register
            </button>
            <button className="hero-btn-secondary" onClick={() => setActiveTab('directory')}>
              Browse Directory
            </button>
          </div>
        </div>
      </section>

      {/* Dynamic Statistics Section */}
      <section className="alumni-stats-section">
        <div className="container">
          <div className="stats-glass-panel">
            <div className="stats-grid">
              {stats.length > 0 ? (
                stats.map((stat, idx) => (
                  <div key={idx} className="stat-card">
                    <div className="stat-icon-wrap">{stat.icon}</div>
                    <div className="stat-info">
                      <div className="stat-number">{stat.number}</div>
                      <div className="stat-label">{stat.label}</div>
                    </div>
                  </div>
                ))
              ) : (
                // Fallback stats while loading or if empty
                <>
                  <div className="stat-card">
                    <div className="stat-icon-wrap">🌍</div>
                    <div className="stat-info">
                      <div className="stat-number">5000+</div>
                      <div className="stat-label">Alumni Worldwide</div>
                    </div>
                  </div>
                  <div className="stat-card">
                    <div className="stat-icon-wrap">🏛️</div>
                    <div className="stat-info">
                      <div className="stat-number">45+</div>
                      <div className="stat-label">Countries</div>
                    </div>
                  </div>
                  <div className="stat-card">
                    <div className="stat-icon-wrap">🩺</div>
                    <div className="stat-info">
                      <div className="stat-number">200+</div>
                      <div className="stat-label">Specialists</div>
                    </div>
                  </div>
                  <div className="stat-card">
                    <div className="stat-icon-wrap">🔬</div>
                    <div className="stat-info">
                      <div className="stat-number">1000+</div>
                      <div className="stat-label">Research Papers</div>
                    </div>
                  </div>
                </>
              )}
            </div>
          </div>
        </div>
      </section>

      {/* Sticky Tab Navigation */}
      <nav className="alumni-nav-tabs">
        <div className="container tab-nav-wrap">
          <button 
            className={`nav-tab-btn ${activeTab === 'directory' ? 'active' : ''}`}
            onClick={() => setActiveTab('directory')}
          >
            <span>📁</span> Alumni Directory
          </button>
          <button 
            className={`nav-tab-btn ${activeTab === 'spotlight' ? 'active' : ''}`}
            onClick={() => setActiveTab('spotlight')}
          >
            <span>✨</span> Alumni Spotlight
          </button>
          <button 
            className={`nav-tab-btn ${activeTab === 'events' ? 'active' : ''}`}
            onClick={() => setActiveTab('events')}
          >
            <span>📅</span> Events & reunions
          </button>
          <button 
            className={`nav-tab-btn ${activeTab === 'register' ? 'active' : ''}`}
            onClick={() => setActiveTab('register')}
          >
            <span>📝</span> Join Directory
          </button>
        </div>
      </nav>

      {/* Main Content Area */}
      <main className="alumni-main-content container">
        {loading && activeTab !== 'register' ? (
          <div className="loading-spinner-wrap">
            <div className="spinner"></div>
            <p>Loading SPHMMC Alumni database...</p>
          </div>
        ) : (
          <div className="tab-fade-in">
            {/* ── Tab: Directory ── */}
            {activeTab === 'directory' && (
              <div className="directory-tab-content">
                <div className="content-intro">
                  <h2>Search Alumni Directory</h2>
                  <p>Filter through our medical professionals by graduation year, specialty, name, or current institution.</p>
                </div>

                {/* Filter bar */}
                <div className="directory-filter-bar">
                  <div className="search-input-wrapper">
                    <span className="search-icon">🔍</span>
                    <input
                      type="text"
                      placeholder="Search by name, specialty, workplace, country..."
                      value={searchTerm}
                      onChange={(e) => setSearchTerm(e.target.value)}
                    />
                    {searchTerm && (
                      <button className="clear-search-btn" onClick={() => setSearchTerm('')}>×</button>
                    )}
                  </div>

                  <div className="filter-select-group">
                    <div className="select-wrapper">
                      <select 
                        value={selectedSpecialty} 
                        onChange={(e) => setSelectedSpecialty(e.target.value)}
                      >
                        <option value="all">All Specialties</option>
                        {specialties.map(spec => (
                          <option key={spec} value={spec}>{spec}</option>
                        ))}
                      </select>
                    </div>

                    <div className="select-wrapper">
                      <select 
                        value={selectedYear} 
                        onChange={(e) => setSelectedYear(e.target.value)}
                      >
                        <option value="all">All Class Years</option>
                        {years.map(yr => (
                          <option key={yr} value={yr}>Class of {yr}</option>
                        ))}
                      </select>
                    </div>
                  </div>
                </div>

                {/* Grid layout */}
                {filteredAlumni.length > 0 ? (
                  <div className="directory-cards-grid">
                    {filteredAlumni.map((alumni) => (
                      <div key={alumni.id} className="alumni-grid-card" onClick={() => openModal(alumni)}>
                        <div className="card-avatar-wrap">
                          <img src={alumni.image || 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face'} alt={alumni.name} />
                          <div className="class-badge">Class of {alumni.graduation_year}</div>
                        </div>
                        <div className="card-body">
                          <h3>{alumni.name}</h3>
                          <div className="degree-tag">{alumni.degree}</div>
                          <div className="specialty-label">{alumni.specialty}</div>
                          <p className="card-position">{alumni.current_position || 'Medical Officer'}</p>
                          <p className="card-workplace">🏢 {alumni.workplace || 'SPHMMC Affiliate'}</p>
                          {alumni.location && <p className="card-location">📍 {alumni.location}</p>}
                        </div>
                        <div className="card-footer">
                          <button className="view-profile-btn" onClick={(e) => {
                            e.stopPropagation();
                            openModal(alumni);
                          }}>
                            View Profile
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                ) : (
                  <div className="no-results-state">
                    <div className="no-results-icon">📂</div>
                    <h3>No alumni found matching your criteria</h3>
                    <p>Try resetting the filters or broadening your search parameters.</p>
                    <button className="reset-filters-btn" onClick={() => {
                      setSearchTerm('');
                      setSelectedSpecialty('all');
                      setSelectedYear('all');
                    }}>
                      Reset All Filters
                    </button>
                  </div>
                )}
              </div>
            )}

            {/* ── Tab: Spotlight ── */}
            {activeTab === 'spotlight' && (
              <div className="spotlight-tab-content">
                <div className="content-intro">
                  <h2>Alumni Spotlight</h2>
                  <p>Celebrating outstanding graduates making pioneering impacts in medicine and research worldwide.</p>
                </div>

                {featuredAlumni.length > 0 ? (
                  <div className="spotlight-row-container">
                    {featuredAlumni.map((alumni) => (
                      <div key={alumni.id} className="spotlight-profile-card">
                        <div className="spotlight-header">
                          <div className="spotlight-image-container">
                            <img src={alumni.image || 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face'} alt={alumni.name} />
                            <div className="spotlight-class-badge">Class of {alumni.graduation_year}</div>
                          </div>
                          <div className="spotlight-meta-info">
                            <div className="spotlight-featured-tag">★ Featured Alumnus</div>
                            <h2>{alumni.name}</h2>
                            <p className="spotlight-degree">{alumni.degree} &bull; <span className="specialty-highlight">{alumni.specialty}</span></p>
                            <p className="spotlight-work">{alumni.current_position} at <strong>{alumni.workplace}</strong></p>
                            {alumni.location && <p className="spotlight-loc">📍 {alumni.location}</p>}
                          </div>
                        </div>
                        <div className="spotlight-body">
                          {alumni.bio && (
                            <div className="spotlight-bio-section">
                              <h3>Biography</h3>
                              <p>{alumni.bio}</p>
                            </div>
                          )}

                          {alumni.achievements && alumni.achievements.length > 0 && (
                            <div className="spotlight-achieve-section">
                              <h3>Key Contributions & Achievements</h3>
                              <ul>
                                {alumni.achievements.map((ach, idx) => (
                                  <li key={idx}><span>✓</span> {ach}</li>
                                ))}
                              </ul>
                            </div>
                          )}

                          {alumni.awards && alumni.awards.length > 0 && (
                            <div className="spotlight-awards-section">
                              <h3>Honors & Awards</h3>
                              <div className="awards-flex-list">
                                {alumni.awards.map((aw, idx) => (
                                  <div key={idx} className="award-pill">🏆 {aw}</div>
                                ))}
                              </div>
                            </div>
                          )}
                        </div>
                        <div className="spotlight-footer">
                          <div className="spotlight-stats">
                            {alumni.publications > 0 && (
                              <div className="spotlight-stat-item">
                                <span className="stat-val">{alumni.publications}</span>
                                <span className="stat-lbl">Research Papers</span>
                              </div>
                            )}
                          </div>
                          <div className="spotlight-actions">
                            {alumni.email && (
                              <a href={`mailto:${alumni.email}`} className="spotlight-email-btn">
                                ✉ Email {alumni.name.split(' ')[0]}
                              </a>
                            )}
                            {alumni.linkedin && (
                              <a href={alumni.linkedin} target="_blank" rel="noopener noreferrer" className="spotlight-social-btn linkedin">
                                LinkedIn
                              </a>
                            )}
                          </div>
                        </div>
                      </div>
                    ))}
                  </div>
                ) : (
                  <div className="no-results-state">
                    <div className="no-results-icon">✨</div>
                    <h3>No featured alumni in database yet</h3>
                    <p>Check back later as we feature more SPHMMC graduates.</p>
                  </div>
                )}
              </div>
            )}

            {/* ── Tab: Events ── */}
            {activeTab === 'events' && (
              <div className="events-tab-content">
                <div className="content-intro">
                  <h2>Alumni Events & Reunions</h2>
                  <p>Stay connected and participate in our medical symposiums, homecomings, and networking dinners.</p>
                </div>

                {events.length > 0 ? (
                  <div className="events-cards-grid">
                    {events.map((event) => (
                      <div key={event.id} className="event-item-card">
                        <div className="event-type-badge">{event.type}</div>
                        <h3 className="event-title">{event.title}</h3>
                        <div className="event-meta-rows">
                          <p className="event-date">📅 {event.date}</p>
                          <p className="event-loc">📍 {event.location}</p>
                          {event.attendees && <p className="event-att">👥 {event.attendees}</p>}
                        </div>
                        <p className="event-desc">{event.description}</p>
                        <div className="event-footer">
                          <button className="event-register-btn" onClick={() => alert(`Registration details for ${event.title} will be sent to your email.`)}>
                            Register Now
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                ) : (
                  <div className="no-results-state">
                    <div className="no-results-icon">📅</div>
                    <h3>No upcoming events scheduled</h3>
                    <p>Please check back later or subscribe to the alumni newsletter.</p>
                  </div>
                )}
              </div>
            )}

            {/* ── Tab: Register Form ── */}
            {activeTab === 'register' && (
              <div className="register-tab-content">
                <div className="content-intro">
                  <h2>Alumni Registration</h2>
                  <p>Add your profile to the SPHMMC alumni directory. Help students and fellow graduates connect with you.</p>
                </div>

                <div className="registration-form-panel">
                  {submitSuccess ? (
                    <div className="success-form-state">
                      <div className="success-check-icon">✓</div>
                      <h3>Registration Successful!</h3>
                      <p>Your alumnus profile has been successfully saved to the database. It is now active and searchable in the directory.</p>
                      <div className="success-actions">
                        <button className="success-btn-primary" onClick={() => {
                          setSubmitSuccess(false);
                          setActiveTab('directory');
                        }}>
                          View Directory
                        </button>
                        <button className="success-btn-secondary" onClick={() => setSubmitSuccess(false)}>
                          Add Another Profile
                        </button>
                      </div>
                    </div>
                  ) : (
                    <form onSubmit={handleFormSubmit} className="premium-form-layout">
                      {submitError && (
                        <div className="form-error-alert">
                          <strong>⚠️ Error:</strong> {submitError}
                        </div>
                      )}

                      <h3 className="form-section-title">Personal & Contact Info</h3>
                      <div className="form-row two-cols">
                        <div className="form-group">
                          <label htmlFor="name">Full Name <span className="required">*</span></label>
                          <input
                            type="text"
                            id="name"
                            name="name"
                            value={formData.name}
                            onChange={handleInputChange}
                            placeholder="e.g. Dr. Abebe Kebede"
                            required
                          />
                        </div>
                        <div className="form-group">
                          <label htmlFor="email">Email Address <span className="required">*</span></label>
                          <input
                            type="email"
                            id="email"
                            name="email"
                            value={formData.email}
                            onChange={handleInputChange}
                            placeholder="e.g. abebe.k@hospital.com"
                            required
                          />
                        </div>
                      </div>

                      <div className="form-row two-cols">
                        <div className="form-group">
                          <label htmlFor="phone">Phone Number</label>
                          <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value={formData.phone}
                            onChange={handleInputChange}
                            placeholder="e.g. +251 911 000 000"
                          />
                        </div>
                        <div className="form-group">
                          <label htmlFor="location">Current Location (City, Country)</label>
                          <input
                            type="text"
                            id="location"
                            name="location"
                            value={formData.location}
                            onChange={handleInputChange}
                            placeholder="e.g. Addis Ababa, Ethiopia"
                          />
                        </div>
                      </div>

                      <h3 className="form-section-title">Academic Details</h3>
                      <div className="form-row two-cols">
                        <div className="form-group">
                          <label htmlFor="graduation_year">Graduation Year <span className="required">*</span></label>
                          <select
                            id="graduation_year"
                            name="graduation_year"
                            value={formData.graduation_year}
                            onChange={handleInputChange}
                            required
                          >
                            {Array.from({ length: new Date().getFullYear() - 2006 }, (_, i) => new Date().getFullYear() - i).map(year => (
                              <option key={year} value={year}>{year}</option>
                            ))}
                          </select>
                        </div>
                        <div className="form-group">
                          <label htmlFor="degree">Degree Obtained <span className="required">*</span></label>
                          <input
                            type="text"
                            id="degree"
                            name="degree"
                            value={formData.degree}
                            onChange={handleInputChange}
                            placeholder="e.g. Doctor of Medicine (MD)"
                            required
                          />
                        </div>
                      </div>

                      <div className="form-row two-cols">
                        <div className="form-group">
                          <label htmlFor="specialty">Specialty / Specialization <span className="required">*</span></label>
                          <input
                            type="text"
                            id="specialty"
                            name="specialty"
                            value={formData.specialty}
                            onChange={handleInputChange}
                            placeholder="e.g. Pediatrics, Surgery, Cardiology"
                            required
                          />
                        </div>
                        <div className="form-group">
                          <label htmlFor="publications">Number of Publications</label>
                          <input
                            type="number"
                            id="publications"
                            name="publications"
                            value={formData.publications}
                            onChange={handleInputChange}
                            min="0"
                          />
                        </div>
                      </div>

                      <h3 className="form-section-title">Professional Status</h3>
                      <div className="form-row two-cols">
                        <div className="form-group">
                          <label htmlFor="current_position">Current Position / Title</label>
                          <input
                            type="text"
                            id="current_position"
                            name="current_position"
                            value={formData.current_position}
                            onChange={handleInputChange}
                            placeholder="e.g. Senior Pediatrician, Resident"
                          />
                        </div>
                        <div className="form-group">
                          <label htmlFor="workplace">Current Workplace / Hospital</label>
                          <input
                            type="text"
                            id="workplace"
                            name="workplace"
                            value={formData.workplace}
                            onChange={handleInputChange}
                            placeholder="e.g. St. Paul's Hospital"
                          />
                        </div>
                      </div>

                      <h3 className="form-section-title">Biography & Achievements</h3>
                      <div className="form-group">
                        <label htmlFor="bio">Biography / Short Summary</label>
                        <textarea
                          id="bio"
                          name="bio"
                          value={formData.bio}
                          onChange={handleInputChange}
                          rows={4}
                          placeholder="Tell us about your medical career and journey after graduation..."
                        />
                      </div>

                      <div className="form-group">
                        <label>Key Achievements</label>
                        {achievements.map((achievement, idx) => (
                          <div key={idx} className="dynamic-input-row">
                            <input
                              type="text"
                              value={achievement}
                              onChange={(e) => handleAchievementChange(idx, e.target.value)}
                              placeholder={`Achievement #${idx + 1} (e.g. Established neonatal ICU unit)`}
                            />
                            {achievements.length > 1 && (
                              <button 
                                type="button" 
                                className="remove-row-btn"
                                onClick={() => removeAchievementField(idx)}
                              >
                                Remove
                              </button>
                            )}
                          </div>
                        ))}
                        <button 
                          type="button" 
                          className="add-row-btn"
                          onClick={addAchievementField}
                        >
                          + Add Another Achievement
                        </button>
                      </div>

                      <div className="form-group">
                        <label>Honors & Awards</label>
                        {awards.map((award, idx) => (
                          <div key={idx} className="dynamic-input-row">
                            <input
                              type="text"
                              value={award}
                              onChange={(e) => handleAwardChange(idx, e.target.value)}
                              placeholder={`Award #${idx + 1} (e.g. Best MD Researcher 2024)`}
                            />
                            {awards.length > 1 && (
                              <button 
                                type="button" 
                                className="remove-row-btn"
                                onClick={() => removeAwardField(idx)}
                              >
                                Remove
                              </button>
                            )}
                          </div>
                        ))}
                        <button 
                          type="button" 
                          className="add-row-btn"
                          onClick={addAwardField}
                        >
                          + Add Another Award
                        </button>
                      </div>

                      <h3 className="form-section-title">Social Links</h3>
                      <div className="form-row three-cols">
                        <div className="form-group">
                          <label htmlFor="linkedin">LinkedIn Profile URL</label>
                          <input
                            type="url"
                            id="linkedin"
                            name="linkedin"
                            value={formData.linkedin}
                            onChange={handleInputChange}
                            placeholder="https://linkedin.com/in/username"
                          />
                        </div>
                        <div className="form-group">
                          <label htmlFor="twitter">Twitter / X URL</label>
                          <input
                            type="url"
                            id="twitter"
                            name="twitter"
                            value={formData.twitter}
                            onChange={handleInputChange}
                            placeholder="https://twitter.com/username"
                          />
                        </div>
                        <div className="form-group">
                          <label htmlFor="research_gate">ResearchGate URL</label>
                          <input
                            type="url"
                            id="research_gate"
                            name="research_gate"
                            value={formData.research_gate}
                            onChange={handleInputChange}
                            placeholder="https://researchgate.net/profile/username"
                          />
                        </div>
                      </div>

                      <h3 className="form-section-title">Profile Image</h3>
                      <div className="form-group photo-uploader-wrap">
                        <label>Profile Picture</label>
                        <div className="uploader-flex-row">
                          <div className="avatar-preview-box">
                            {imagePreview ? (
                              <img src={imagePreview} alt="Preview" />
                            ) : (
                              <div className="placeholder-preview">👤</div>
                            )}
                          </div>
                          <div className="upload-controls">
                            <input
                              type="file"
                              id="image-file"
                              accept="image/*"
                              ref={fileInputRef}
                              onChange={handleImageChange}
                              style={{ display: 'none' }}
                            />
                            <button
                              type="button"
                              className="choose-file-btn"
                              onClick={() => fileInputRef.current?.click()}
                            >
                              Choose Profile Image
                            </button>
                            <p className="upload-tip">JPG, PNG or WEBP. Max size 2MB.</p>
                          </div>
                        </div>
                      </div>

                      <div className="form-submit-row">
                        <button 
                          type="submit" 
                          className="form-submit-btn" 
                          disabled={submitting}
                        >
                          {submitting ? 'Submitting Details...' : 'Register Alumnus Profile'}
                        </button>
                      </div>
                    </form>
                  )}
                </div>
              </div>
            )}
          </div>
        )}
      </main>

      {/* ── Detail Modal ── */}
      {showModal && selectedAlumni && (
        <div className="modal-overlay-bg" onClick={closeModal}>
          <div className="modal-container-panel" onClick={(e) => e.stopPropagation()}>
            <button className="modal-close-x-btn" onClick={closeModal}>×</button>
            
            <div className="modal-header-panel">
              <div className="modal-photo-container">
                <img src={selectedAlumni.image || 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face'} alt={selectedAlumni.name} />
                <div className="modal-class-tag">Class of {selectedAlumni.graduation_year}</div>
              </div>
              <div className="modal-meta-info">
                <h2>{selectedAlumni.name}</h2>
                <div className="modal-degree-pill">{selectedAlumni.degree}</div>
                <div className="modal-specialty-text">{selectedAlumni.specialty}</div>
                <p className="modal-job-pos">{selectedAlumni.current_position || 'Medical Officer'}</p>
                <p className="modal-job-hosp">🏢 {selectedAlumni.workplace || 'SPHMMC Affiliate'}</p>
                {selectedAlumni.location && <p className="modal-job-loc">📍 {selectedAlumni.location}</p>}
              </div>
            </div>

            <div className="modal-body-panel">
              {selectedAlumni.bio && (
                <div className="modal-info-block">
                  <h3>Biography</h3>
                  <p>{selectedAlumni.bio}</p>
                </div>
              )}

              {selectedAlumni.achievements && selectedAlumni.achievements.length > 0 && (
                <div className="modal-info-block">
                  <h3>Key Achievements & Contributions</h3>
                  <ul className="modal-achieve-list">
                    {selectedAlumni.achievements.map((ach, idx) => (
                      <li key={idx}><span>✓</span> {ach}</li>
                    ))}
                  </ul>
                </div>
              )}

              {selectedAlumni.awards && selectedAlumni.awards.length > 0 && (
                <div className="modal-info-block">
                  <h3>Honors & Awards</h3>
                  <div className="modal-awards-wrap">
                    {selectedAlumni.awards.map((aw, idx) => (
                      <span key={idx} className="modal-award-tag">🏆 {aw}</span>
                    ))}
                  </div>
                </div>
              )}

              <div className="modal-info-block">
                <h3>Contact & Social Connections</h3>
                <div className="modal-contact-details">
                  <p>📧 <strong>Email:</strong> <a href={`mailto:${selectedAlumni.email}`}>{selectedAlumni.email}</a></p>
                  {selectedAlumni.phone && <p>📱 <strong>Phone:</strong> {selectedAlumni.phone}</p>}
                  {selectedAlumni.publications > 0 && <p>🔬 <strong>Publications:</strong> {selectedAlumni.publications} research papers</p>}
                </div>
                
                {(selectedAlumni.linkedin || selectedAlumni.twitter || selectedAlumni.research_gate) && (
                  <div className="modal-socials-group">
                    {selectedAlumni.linkedin && (
                      <a href={selectedAlumni.linkedin} target="_blank" rel="noopener noreferrer" className="modal-social-icon linkedin">
                        LinkedIn Profile
                      </a>
                    )}
                    {selectedAlumni.twitter && (
                      <a href={selectedAlumni.twitter} target="_blank" rel="noopener noreferrer" className="modal-social-icon twitter">
                        Twitter Profile
                      </a>
                    )}
                    {selectedAlumni.research_gate && (
                      <a href={selectedAlumni.research_gate} target="_blank" rel="noopener noreferrer" className="modal-social-icon researchgate">
                        ResearchGate
                      </a>
                    )}
                  </div>
                )}
              </div>
            </div>

            <div className="modal-footer-panel">
              <a href={`mailto:${selectedAlumni.email}`} className="modal-footer-action-btn primary">
                Send Direct Message
              </a>
              <button className="modal-footer-action-btn secondary" onClick={closeModal}>
                Close Profile
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Alumni;
