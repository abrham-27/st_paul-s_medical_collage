import { useState, useEffect } from 'react';
import './Office.css';
import './ICT.css';

interface Props { onBack: () => void }

interface AboutData {
  title: string;
  description: string;
  featured_image?: string;
}

interface ServiceData {
  id: number;
  icon: string;
  title: string;
  description: string;
}

interface ProjectData {
  id: number;
  image?: string;
  title: string;
  excerpt: string;
  slug: string;
}

interface ContactData {
  office_name: string;
  email: string;
  phone: string;
  location: string;
  working_hours: string;
}

interface GalleryData {
  id: number;
  image?: string;
  title: string;
}

export default function ICTOffice({ onBack }: Props) {
  const [activeTab, setActiveTab] = useState('about');
  const [aboutData, setAboutData] = useState<AboutData | null>(null);
  const [services, setServices] = useState<ServiceData[]>([]);
  const [projects, setProjects] = useState<ProjectData[]>([]);
  const [contactInfo, setContactInfo] = useState<ContactData | null>(null);
  const [gallery, setGallery] = useState<GalleryData[]>([]);
  const [loading, setLoading] = useState(false);

  const tabs = [
    { id: 'about', label: 'About ICT' },
    { id: 'services', label: 'Our Services' },
    { id: 'projects', label: 'ICT Projects' },
    { id: 'contact', label: 'Contact Info' }
  ];

  // Fetch About ICT data
  const fetchAboutData = async () => {
    try {
      setLoading(true);
      const response = await fetch('/api/offices/ict/page');
      const result = await response.json();
      console.log('About API response:', result);
      setAboutData(result.success ? result.data : null);
    } catch (error) {
      console.error('Error fetching about data:', error);
      // Set null on error - no fallback data
      setAboutData(null);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Services data
  const fetchServicesData = async () => {
    try {
      setLoading(true);
      const response = await fetch('/api/offices/ict/services');
      const result = await response.json();
      console.log('Services API response:', result);
      setServices(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching services data:', error);
      // Set empty array on error - no fallback data
      setServices([]);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Projects data
  const fetchProjectsData = async () => {
    try {
      setLoading(true);
      console.log('Fetching projects from /api/offices/ict/projects...');
      const response = await fetch('/api/offices/ict/projects');
      console.log('Response status:', response.status);
      console.log('Response ok:', response.ok);
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const result = await response.json();
      console.log('Projects API response:', result);
      console.log('Projects data length:', result.success ? result.data?.length : 0);
      
      if (result.success && result.data) {
        console.log('First project:', result.data[0]);
      }
      
      setProjects(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching projects data:', error);
      console.error('Error details:', error instanceof Error ? error.message : 'Unknown error');
      // Set empty array on error - no fallback data
      setProjects([]);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Contact data
  const fetchContactData = async () => {
    try {
      setLoading(true);
      const response = await fetch('/api/offices/ict/contact');
      const result = await response.json();
      console.log('Contact API response:', result);
      setContactInfo(result.success ? result.data : null);
    } catch (error) {
      console.error('Error fetching contact data:', error);
      // Set null on error - no fallback data
      setContactInfo(null);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Gallery data
  const fetchGalleryData = async () => {
    try {
      setLoading(true);
      const response = await fetch('/api/offices/ict/gallery');
      const result = await response.json();
      console.log('Gallery API response:', result);
      setGallery(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching gallery data:', error);
      // Set empty array on error - no fallback data
      setGallery([]);
    } finally {
      setLoading(false);
    }
  };

  const scrollToSection = async (tabId: string) => {
    setActiveTab(tabId);
    
    // Fetch data only when tab is clicked (lazy loading)
    switch (tabId) {
      case 'about':
        if (!aboutData) await fetchAboutData();
        break;
      case 'services':
        if (services.length === 0) await fetchServicesData();
        break;
      case 'projects':
        if (projects.length === 0) await fetchProjectsData();
        break;
      case 'contact':
        if (!contactInfo) await fetchContactData();
        break;
    }

    const element = document.getElementById(tabId);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  // Default behavior: fetch About and Services data immediately
  useEffect(() => {
    // Test backend connectivity first
    const testBackendConnection = async () => {
      try {
        console.log('Testing backend connection...');
        const response = await fetch('/api/offices/ict/projects');
        console.log('Backend test response status:', response.status);
        if (response.ok) {
          const data = await response.json();
          console.log('Backend test data:', data);
        } else {
          console.error('Backend returned error status:', response.status);
        }
      } catch (error) {
        console.error('Backend connection test failed:', error);
      }
    };
    
    testBackendConnection();
    fetchAboutData();
    fetchServicesData();
    setActiveTab('about');
  }, []);

  // Fetch data when tab changes (lazy loading)
  useEffect(() => {
    if (activeTab === 'about' && gallery.length === 0) {
      fetchGalleryData();
    }
    if (activeTab === 'projects' && projects.length === 0) {
      fetchProjectsData();
    }
    if (activeTab === 'contact' && !contactInfo) {
      fetchContactData();
    }
  }, [activeTab]);

  return (
    <div className="office-page">
      <div className="office-hero">
        <div className="office-container">
          <button className="office-back-btn" onClick={onBack}>← Back</button>
          <span className="office-badge">SPHMMC · Offices</span>
          <h1 className="office-hero-title">ICT Department</h1>
          <p className="office-hero-sub">Powering digital infrastructure, technology services, and IT support across SPHMMC.</p>
        </div>
      </div>

      {/* Tab Navigation */}
      <div className="ict-tabs-container">
        <div className="office-container">
          <div className="ict-tabs">
            {tabs.map(tab => (
              <button
                key={tab.id}
                className={`ict-tab ${activeTab === tab.id ? 'ict-tab--active' : ''}`}
                onClick={() => scrollToSection(tab.id)}
              >
                {tab.label}
              </button>
            ))}
          </div>
        </div>
      </div>

      {/* Loading Indicator */}
      {loading && (
        <div className="ict-loading">
          <div className="ict-loading-spinner"></div>
          <p>Loading...</p>
        </div>
      )}

      <div className="office-container office-body">

        {/* About ICT Section */}
        {activeTab === 'about' && (
          <div id="about" className="office-section ict-section">
            {aboutData && (
              <>
                <h2>{aboutData.title}</h2>
                <p>{aboutData.description}</p>
                
                {/* ICT Gallery - integrated into About section */}
                {gallery.length > 0 && (
                  <div className="ict-gallery-section">
                    <h3>ICT Gallery</h3>
                    <div className="ict-gallery">
                      {gallery.map(item => (
                        <div key={item.id} className="ict-gallery-item">
                          {item.image ? (
                            <img src={item.image} alt={item.title} className="ict-gallery-img" />
                          ) : (
                            <div className="ict-gallery-img-placeholder">📷</div>
                          )}
                          <div className="ict-gallery-overlay">
                            <span>{item.title}</span>
                            <span className="ict-gallery-zoom">🔍</span>
                          </div>
                        </div>
                      ))}
                    </div>
                  </div>
                )}
              </>
            )}
          </div>
        )}

        {/* Our Services Section */}
        {activeTab === 'services' && (
          <div id="services" className="office-section ict-section">
            {services.length > 0 && (
              <>
                <h2>ICT Services</h2>
                <div className="office-cards">
                  {services.map(service => (
                    <div key={service.id} className="office-card">
                      <span className="office-card-icon">{service.icon}</span>
                      <h3>{service.title}</h3>
                      <p>{service.description}</p>
                    </div>
                  ))}
                </div>
              </>
            )}
          </div>
        )}

        {/* ICT Projects Section */}
        {activeTab === 'projects' && (
          <div id="projects" className="office-section ict-section">
            {projects.length > 0 && (
              <>
                <h2>ICT Projects</h2>
                <div className="ict-projects-grid">
                  {projects.map(project => (
                    <div key={project.id} className="ict-project-card">
                      {project.image ? (
                        <img src={project.image} alt={project.title} className="ict-project-img" />
                      ) : (
                        <div className="ict-project-img-placeholder">🖥️</div>
                      )}
                      <div className="ict-project-body">
                        <h3>{project.title}</h3>
                        <p>{project.excerpt}</p>
                        <a href={`/office/ict/projects/${project.slug}`} className="ict-read-more">
                          Read More →
                        </a>
                      </div>
                    </div>
                  ))}
                </div>
              </>
            )}
          </div>
        )}

        {/* Contact Info Section */}
        {activeTab === 'contact' && (
          <div id="contact" className="office-section ict-section">
            {contactInfo && (
              <>
                <h2>Contact Information</h2>
                <div className="office-contact">
                  <div className="office-contact-item">
                    <span className="office-contact-label">Office Name</span>
                    <span className="office-contact-value">{contactInfo.office_name}</span>
                  </div>
                  <div className="office-contact-item">
                    <span className="office-contact-label">Location</span>
                    <span className="office-contact-value">{contactInfo.location}</span>
                  </div>
                  <div className="office-contact-item">
                    <span className="office-contact-label">Email</span>
                    <span className="office-contact-value">
                      <a href={`mailto:${contactInfo.email}`}>{contactInfo.email}</a>
                    </span>
                  </div>
                  <div className="office-contact-item">
                    <span className="office-contact-label">Phone</span>
                    <span className="office-contact-value">{contactInfo.phone}</span>
                  </div>
                  <div className="office-contact-item">
                    <span className="office-contact-label">Working Hours</span>
                    <span className="office-contact-value">{contactInfo.working_hours}</span>
                  </div>
                </div>
              </>
            )}
          </div>
        )}

      </div>

      {/* Digital Platforms Section */}
      <div className="office-section">
        <h2>Digital Platforms</h2>
        <div className="office-cards" style={{ gridTemplateColumns: 'repeat(2, 1fr)' }}>
          <div className="office-card">
            <span className="office-card-icon">🎓</span>
            <h3>Student Portal</h3>
            <p>Access grades, course registration, and academic information at <a href="https://portal.sphmmc.edu.et" target="_blank" rel="noopener noreferrer" style={{ color: '#4169E1' }}>portal.sphmmc.edu.et</a></p>
          </div>
          <div className="office-card">
            <span className="office-card-icon">📰</span>
            <h3>SPHMMC Website</h3>
            <p>Official institutional website with news, announcements, and academic information.</p>
          </div>
        </div>
      </div>
    </div>
  );
}
