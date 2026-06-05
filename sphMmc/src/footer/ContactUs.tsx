import React from 'react';

interface SocialLink {
  platform: string;
  url: string;
  icon: string;
}

interface ContactUsProps {
  title: string;
  address?: string;
  po_box?: string;
  short_code?: string;
  email?: string;
  socials?: SocialLink[];
}

const ContactUs: React.FC<ContactUsProps> = ({
  title,
  address = 'Gulele Sub-City, Addis Ababa, Ethiopia',
  po_box = 'PO Box 1271',
  short_code = '976',
  email = 'info@sphmmc.edu.et',
  socials = []
}) => {
  // Safe fallback if socials list is empty
  const defaultSocials: SocialLink[] = [
    { platform: 'LinkedIn', url: 'https://www.linkedin.com', icon: 'fa-brands fa-linkedin' },
    { platform: 'Facebook', url: 'https://www.facebook.com', icon: 'fa-brands fa-facebook' },
    { platform: 'YouTube', url: 'https://www.youtube.com', icon: 'fa-brands fa-youtube' },
    { platform: 'Telegram', url: 'https://t.me/', icon: 'fa-brands fa-telegram' },
    { platform: 'TikTok', url: 'https://www.tiktok.com', icon: 'fa-brands fa-tiktok' },
    { platform: 'Instagram', url: 'https://www.instagram.com', icon: 'fa-brands fa-instagram' }
  ];

  const activeSocials = socials.length > 0 ? socials : defaultSocials;

  return (
    <div className="footer-section contact-section">
      <h3>{title}</h3>
      <div className="contact-info">
        <p className="contact-item">
          <i className="fa-solid fa-location-dot contact-icon"></i>
          <span>{address}</span>
        </p>
        <p className="contact-item">
          <i className="fa-solid fa-box-open contact-icon"></i>
          <span>{po_box}</span>
        </p>
        <p className="contact-item">
          <i className="fa-solid fa-phone contact-icon"></i>
          <span>Short Code: {short_code}</span>
        </p>
        <p className="contact-item">
          <i className="fa-solid fa-envelope contact-icon"></i>
          <a href={`mailto:${email}`}>{email}</a>
        </p>
      </div>

      <div className="social-links-container">
        {activeSocials.map((social, idx) => (
          <a
            key={idx}
            href={social.url}
            target="_blank"
            rel="noopener noreferrer"
            className="social-icon-btn"
            title={social.platform}
          >
            <i className={social.icon}></i>
          </a>
        ))}
      </div>
    </div>
  );
};

export default ContactUs;
