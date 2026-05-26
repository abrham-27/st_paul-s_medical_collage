import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import './Office.css';
import { sanitizeHtml } from '../utils/richText';

interface Props { 
  onBack: () => void;
  officeName?: string;
  officeType?: string;
}

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

const OFFICE_CONFIG: Record<string, { name: string; description: string; icon: string }> = {
  provost: {
    name: 'Provost Office',
    description: 'Leading academic excellence and institutional governance at SPHMMC.',
    icon: '🎓'
  },
  bdvp: {
    name: 'Business Development Vice Provost',
    description: 'Driving strategic partnerships and business development initiatives.',
    icon: '💼'
  },
  msvp: {
    name: 'Medical Service Vice Provost',
    description: 'Overseeing clinical services and medical operations excellence.',
    icon: '🏥'
  },
  finance: {
    name: 'Finance Office',
    description: 'Managing financial operations and fiscal responsibility.',
    icon: '💰'
  },
  arvp: {
    name: 'Academic Research Vice Provost',
    description: 'Advancing research excellence and academic innovation.',
    icon: '🔬'
  },
  registrar: {
    name: 'Registrar Office',
    description: 'Managing student records, registration, and academic services.',
    icon: '📋'
  },
  ict: {
    name: 'ICT Department',
    description: 'Powering digital infrastructure and technology services.',
    icon: '💻'
  },
  library: {
    name: 'Library Services',
    description: 'Supporting learning and research through comprehensive library resources.',
    icon: '📚'
  }
};

const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';

export default function GenericOffice({ onBack, officeName, officeType }: Props) {
  const params = useParams();
  const office = officeType || params.office || 'provost';
  const config = OFFICE_CONFIG[office] || OFFICE_CONFIG.provost;
  
  const [activeTab, setActiveTab] = useState('about');
  const [aboutData, setAboutData] = useState<AboutData | null>(null);
  const [services, setServices] = useState<ServiceData[]>([]);
  const [projects, setProjects] = useState<ProjectData[]>([]);
  const [contactInfo, setContactInfo] = useState<ContactData | null>(null);
  const [gallery, setGallery] = useState<GalleryData[]>([]);
  const [loading, setLoading] = useState(false);

  const tabs = [
    { id: 'about', label: `About ${config.name}` },
    { id: 'services', label: 'Our Services' },
    { id: 'projects', label: 'Projects' },
    { id: 'contact', label: 'Contact Info' }
  ];

  // Fetch About data
  const fetchAboutData = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/offices/${office}/page`);
      const result = await response.json();
      setAboutData(result.success ? result.data : null);
    } catch (error) {
      console.error('Error fetching about data:', error);
      setAboutData(null);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Services data
  const fetchServicesData = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/offices/${office}/services`);
      const result = await response.json();
      setServices(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching services data:', error);
      setServices([]);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Projects data
  const fetchProjectsData = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/offices/${office}/projects`);
      const result = await response.json();
      setProjects(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching projects data:', error);
      setProjects([]);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Contact data
  const fetchContactData = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/offices/${office}/contact`);
      const result = await response.json();
      setContactInfo(result.success ? result.data : null);
    } catch (error) {
      console.error('Error fetching contact data:', error);
      setContactInfo(null);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Gallery data
  const fetchGalleryData = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/offices/${office}/gallery`);
      const result = await response.json();
      setGallery(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching gallery data:', error);
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
        if (gallery.length === 0) await fetchGalleryData();
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

  // Default behavior: fetch About data immediately
  useEffect(() => {
    fetchAboutData();
    setActiveTab('about');
  }, [office]);

  return (
    <div className="office-page">
      <div className="office-hero">
        <div className="office-container">
          <button className="office-back-btn" onClick={onBack}>← Back</button>
          <span className="office-badge">SPHMMC · Offices</span>
          <h1 className="office-hero-title">{officeName || config.name}</h1>
          <p className="office-hero-sub">{config.description}</p>
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

        {/* About Section */}
        {activeTab === 'about' && (
          <div id="about" className="office-section ict-section">
            {aboutData ? (
              <>
                <h2>{aboutData.title}</h2>
                <div dangerouslySetInnerHTML={{ __html: sanitizeHtml(aboutData.description) }} />
                
                {/* Gallery - integrated into About section */}
                {gallery.length > 0 && (
                  <div className="ict-gallery-section">
                    <h3>Gallery</h3>
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
            ) : (
              <div className="office-section">
                <h2>About {config.name}</h2>
                <p>Welcome to the {config.name}. {config.description}</p>
              </div>
            )}
          </div>
        )}

        {/* Services Section */}
        {activeTab === 'services' && (
          <div id="services" className="office-section ict-section">
            <h2>Our Services</h2>
            {services.length > 0 ? (
              <div className="office-cards">
                {services.map(service => (
                  <div key={service.id} className="office-card">
                    <span className="office-card-icon">{service.icon}</span>
                    <h3>{service.title}</h3>
                    <div dangerouslySetInnerHTML={{ __html: sanitizeHtml(service.description) }} />
                  </div>
                ))}
              </div>
            ) : (
              <p>No services information available at the moment.</p>
            )}
          </div>
        )}

        {/* Projects Section */}
        {activeTab === 'projects' && (
          <div id="projects" className="office-section ict-section">
            <h2>Projects</h2>
            {projects.length > 0 ? (
              <div className="ict-projects-grid">
                {projects.map(project => (
                  <div key={project.id} className="ict-project-card">
                    {project.image ? (
                      <img src={project.image} alt={project.title} className="ict-project-img" />
                    ) : (
                      <div className="ict-project-img-placeholder">{config.icon}</div>
                    )}
                    <div className="ict-project-body">
                      <h3>{project.title}</h3>
                      <div dangerouslySetInnerHTML={{ __html: sanitizeHtml(project.excerpt) }} />
                      <a href={`/office/${office}/projects/${project.slug}`} className="ict-read-more">
                        Read More →
                      </a>
                    </div>
                  </div>
                ))}
              </div>
            ) : (
              <p>No projects information available at the moment.</p>
            )}
          </div>
        )}

        {/* Contact Info Section */}
        {activeTab === 'contact' && (
          <div id="contact" className="office-section ict-section">
            <h2>Contact Information</h2>
            {contactInfo ? (
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
            ) : (
              <div className="office-contact">
                <div className="office-contact-item">
                  <span className="office-contact-label">Office Name</span>
                  <span className="office-contact-value">{config.name}</span>
                </div>
                <div className="office-contact-item">
                  <span className="office-contact-label">Location</span>
                  <span className="office-contact-value">SPHMMC Campus</span>
                </div>
                <div className="office-contact-item">
                  <span className="office-contact-label">Working Hours</span>
                  <span className="office-contact-value">Monday - Friday: 8:00 AM - 5:00 PM</span>
                </div>
              </div>
            )}
          </div>
        )}

      </div>
    </div>
  );
}