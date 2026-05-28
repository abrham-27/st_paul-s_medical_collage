import React from 'react';

interface ContactProps {
  title: string;
  subtitle?: string;
  officeAddress?: string;
  officePhone?: string;
  officeEmail?: string;
  officeHours?: string;
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsContact: React.FC<ContactProps> = ({
  title,
  subtitle,
  officeAddress,
  officePhone,
  officeEmail,
  officeHours,
  icon = '📞',
  backgroundColor = 'navy'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  
  const contactItems = [
    {
      icon: '📍',
      title: 'Office Address',
      info: officeAddress,
      link: officeAddress ? `https://maps.google.com/?q=${encodeURIComponent(officeAddress)}` : null
    },
    {
      icon: '📞',
      title: 'Phone Number',
      info: officePhone,
      link: officePhone ? `tel:${officePhone}` : null
    },
    {
      icon: '📧',
      title: 'Email Address',
      info: officeEmail,
      link: officeEmail ? `mailto:${officeEmail}` : null
    },
    {
      icon: '🕒',
      title: 'Office Hours',
      info: officeHours,
      link: null
    }
  ].filter(item => item.info); // Only show items that have information
  
  return (
    <section className={sectionClass}>
      <div className="rp-container">
        <div className="rp-section-header">
          <span className="rp-section-icon">{icon}</span>
          <h2 className="rp-section-title">{title}</h2>
          {subtitle && (
            <p className="rp-section-subtitle">{subtitle}</p>
          )}
          <div className="rp-underline"></div>
        </div>
        
        {contactItems.length > 0 ? (
          <div className="rp-contact-grid">
            {contactItems.map((item, index) => (
              <div key={index} className="rp-contact-card">
                <span className="rp-contact-icon">{item.icon}</span>
                <h3 className="rp-contact-title">{item.title}</h3>
                <div className="rp-contact-info">
                  {item.link ? (
                    <a 
                      href={item.link}
                      target={item.link.startsWith('http') ? '_blank' : '_self'}
                      rel={item.link.startsWith('http') ? 'noopener noreferrer' : undefined}
                    >
                      {item.info}
                    </a>
                  ) : (
                    <span>{item.info}</span>
                  )}
                </div>
              </div>
            ))}
          </div>
        ) : (
          <div style={{ 
            textAlign: 'center', 
            padding: '3rem 2rem',
            color: backgroundColor === 'navy' ? '#bae6fd' : '#64748b'
          }}>
            <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>📞</div>
            <p style={{ fontSize: '1.1rem', margin: 0 }}>
              Contact information will be available soon.
            </p>
          </div>
        )}
        
        {/* Additional Contact Methods */}
        {contactItems.length > 0 && (
          <div style={{ 
            marginTop: '3rem', 
            textAlign: 'center',
            padding: '2rem',
            background: backgroundColor === 'navy' ? 'rgba(255, 255, 255, 0.1)' : '#f8fafc',
            borderRadius: '12px'
          }}>
            <h3 style={{ 
              fontSize: '1.2rem', 
              fontWeight: '700', 
              color: backgroundColor === 'navy' ? '#ffffff' : '#0a1628',
              marginBottom: '1rem'
            }}>
              Get in Touch
            </h3>
            <p style={{ 
              color: backgroundColor === 'navy' ? '#bae6fd' : '#64748b',
              margin: '0 0 1.5rem',
              lineHeight: '1.6'
            }}>
              Have questions about our research projects? We're here to help. 
              Contact us using any of the methods above or visit our office during business hours.
            </p>
            
            <div style={{ 
              display: 'flex', 
              gap: '1rem', 
              justifyContent: 'center',
              flexWrap: 'wrap'
            }}>
              {officeEmail && (
                <a 
                  href={`mailto:${officeEmail}`}
                  style={{
                    padding: '0.75rem 1.5rem',
                    background: '#f59e0b',
                    color: '#0a1628',
                    textDecoration: 'none',
                    borderRadius: '8px',
                    fontWeight: '600',
                    display: 'inline-flex',
                    alignItems: 'center',
                    gap: '0.5rem',
                    transition: 'all 0.3s ease'
                  }}
                  onMouseOver={(e) => {
                    e.currentTarget.style.background = '#fbbf24';
                    e.currentTarget.style.transform = 'translateY(-2px)';
                  }}
                  onMouseOut={(e) => {
                    e.currentTarget.style.background = '#f59e0b';
                    e.currentTarget.style.transform = 'translateY(0)';
                  }}
                >
                  <span>📧</span>
                  Send Email
                </a>
              )}
              
              {officePhone && (
                <a 
                  href={`tel:${officePhone}`}
                  style={{
                    padding: '0.75rem 1.5rem',
                    background: 'transparent',
                    color: backgroundColor === 'navy' ? '#ffffff' : '#0a1628',
                    textDecoration: 'none',
                    border: `2px solid ${backgroundColor === 'navy' ? 'rgba(255, 255, 255, 0.5)' : '#e2e8f0'}`,
                    borderRadius: '8px',
                    fontWeight: '600',
                    display: 'inline-flex',
                    alignItems: 'center',
                    gap: '0.5rem',
                    transition: 'all 0.3s ease'
                  }}
                  onMouseOver={(e) => {
                    e.currentTarget.style.borderColor = '#f59e0b';
                    e.currentTarget.style.color = '#f59e0b';
                    e.currentTarget.style.transform = 'translateY(-2px)';
                  }}
                  onMouseOut={(e) => {
                    e.currentTarget.style.borderColor = backgroundColor === 'navy' ? 'rgba(255, 255, 255, 0.5)' : '#e2e8f0';
                    e.currentTarget.style.color = backgroundColor === 'navy' ? '#ffffff' : '#0a1628';
                    e.currentTarget.style.transform = 'translateY(0)';
                  }}
                >
                  <span>📞</span>
                  Call Us
                </a>
              )}
            </div>
          </div>
        )}
      </div>
    </section>
  );
};

export default ResearchProjectsContact;