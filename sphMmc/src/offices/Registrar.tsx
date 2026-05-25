import { useState, useEffect } from 'react';
import './Office.css';
import './Registrar.css';

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

interface ProcessData {
  id: number;
  step_number: number;
  title: string;
  description: string;
  icon?: string;
}

interface ContactData {
  office_name: string;
  email: string;
  phone: string;
  location: string;
  working_hours: string;
}

export default function RegistrarOffice({ onBack }: Props) {
  const [activeTab, setActiveTab] = useState('about');
  const [aboutData, setAboutData] = useState<AboutData | null>(null);
  const [services, setServices] = useState<ServiceData[]>([]);
  const [processes, setProcesses] = useState<ProcessData[]>([]);
  const [contactInfo, setContactInfo] = useState<ContactData | null>(null);
  const [loading, setLoading] = useState(false);

  const tabs = [
    { id: 'about', label: 'About' },
    { id: 'services', label: 'Our Services' },
    { id: 'process', label: 'Registration Process' },
    { id: 'contact', label: 'Contact Info' }
  ];

  // Fetch About data
  const fetchAboutData = async () => {
    try {
      setLoading(true);
      const response = await fetch('/api/offices/registrar/page');
      const result = await response.json();
      console.log('Registrar About API response:', result);
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
      const response = await fetch('/api/offices/registrar/services');
      const result = await response.json();
      console.log('Registrar Services API response:', result);
      setServices(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching services data:', error);
      setServices([]);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Process data
  const fetchProcessData = async () => {
    try {
      setLoading(true);
      const response = await fetch('/api/offices/registrar/process');
      const result = await response.json();
      console.log('Registrar Process API response:', result);
      setProcesses(result.success ? result.data : []);
    } catch (error) {
      console.error('Error fetching process data:', error);
      setProcesses([]);
    } finally {
      setLoading(false);
    }
  };

  // Fetch Contact data
  const fetchContactData = async () => {
    try {
      setLoading(true);
      const response = await fetch('/api/offices/registrar/contact');
      const result = await response.json();
      console.log('Registrar Contact API response:', result);
      setContactInfo(result.success ? result.data : null);
    } catch (error) {
      console.error('Error fetching contact data:', error);
      setContactInfo(null);
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
      case 'process':
        if (processes.length === 0) await fetchProcessData();
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
        console.log('Testing Registrar backend connection...');
        const response = await fetch('/api/offices/registrar/services');
        console.log('Registrar backend test response status:', response.status);
        if (response.ok) {
          const data = await response.json();
          console.log('Registrar backend test data:', data);
        } else {
          console.error('Registrar backend returned error status:', response.status);
        }
      } catch (error) {
        console.error('Registrar backend connection test failed:', error);
      }
    };
    
    testBackendConnection();
    fetchAboutData();
    fetchServicesData();
    setActiveTab('about');
  }, []);

  // Fetch data when tab changes (lazy loading)
  useEffect(() => {
    if (activeTab === 'process' && processes.length === 0) {
      fetchProcessData();
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
          <h1 className="office-hero-title">Registrar Office</h1>
          <p className="office-hero-sub">Managing academic records, student registration, and institutional documentation.</p>
        </div>
      </div>

      {/* Tab Navigation */}
      <div className="registrar-tabs-container">
        <div className="office-container">
          <div className="registrar-tabs">
            {tabs.map(tab => (
              <button
                key={tab.id}
                className={`registrar-tab ${activeTab === tab.id ? 'registrar-tab--active' : ''}`}
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
        <div className="registrar-loading">
          <div className="registrar-loading-spinner"></div>
          <p>Loading...</p>
        </div>
      )}

      <div className="office-container office-body">

        {/* About Section */}
        {activeTab === 'about' && (
          <div id="about" className="office-section registrar-section">
            {aboutData && (
              <>
                <h2>{aboutData.title}</h2>
                <p>{aboutData.description}</p>
              </>
            )}
          </div>
        )}

        {/* Our Services Section */}
        {activeTab === 'services' && (
          <div id="services" className="office-section registrar-section">
            {services.length > 0 && (
              <>
                <h2>Our Services</h2>
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

        {/* Registration Process Section */}
        {activeTab === 'process' && (
          <div id="process" className="office-section registrar-section">
            {processes.length > 0 && (
              <>
                <h2>Registration Process</h2>
                <div className="registrar-process-timeline">
                  {processes.sort((a, b) => a.step_number - b.step_number).map((process, _index) => (
                    <div key={process.id} className="registrar-process-step">
                      <div className="registrar-step-number">
                        {process.icon || process.step_number}
                      </div>
                      <div className="registrar-step-content">
                        <h3>{process.title}</h3>
                        <p>{process.description}</p>
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
          <div id="contact" className="office-section registrar-section">
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
    </div>
  );
}
