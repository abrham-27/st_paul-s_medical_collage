import React, { useEffect, useState } from 'react';
import AboutUs from './AboutUs';
import QuickLinks from './QuickLinks';
import ContactUs from './ContactUs';
import LegalInfo from './LegalInfo';
import FooterBottom from './FooterBottom';
import './footer.css';

interface FooterLink {
  label: string;
  href: string;
}

interface SocialLink {
  platform: string;
  url: string;
  icon: string;
}

interface FooterSections {
  about: {
    title: string;
    links: FooterLink[];
  };
  quickLinks: {
    title: string;
    links: FooterLink[];
  };
  contact: {
    title: string;
    address: string;
    po_box: string;
    short_code: string;
    email: string;
    socials: SocialLink[];
  };
  legal: {
    title: string;
    links: FooterLink[];
  };
}

const Footer: React.FC = () => {
  const [sections, setSections] = useState<FooterSections | null>(null);

  const getStaticDefaults = (): FooterSections => ({
    about: {
      title: 'About SPHMMC',
      links: [
        { label: 'About Us', href: '/about' },
        { label: 'Leaders', href: '/leaders' },
        { label: 'Gallery', href: '/gallery' }
      ]
    },
    quickLinks: {
      title: 'Quick Links',
      links: [
        { label: 'Academic Calendar', href: '#' },
        { label: 'Admission Portal', href: '#' },
        { label: 'Online Journal', href: '#' },
        { label: 'Careers', href: '#' },
        { label: 'Health Tips', href: '/health-tips' },
        { label: 'Specialised Center', href: '/specialized-centers' },
        { label: 'Alumni', href: '/alumni' }
      ]
    },
    contact: {
      title: 'Contact Us',
      address: 'Gulele Sub-City, Addis Ababa, Ethiopia',
      po_box: 'PO Box 1271',
      short_code: '976',
      email: 'info@sphmmc.edu.et',
      socials: [
        { platform: 'LinkedIn', url: 'https://www.linkedin.com', icon: 'fa-brands fa-linkedin' },
        { platform: 'Facebook', url: 'https://www.facebook.com', icon: 'fa-brands fa-facebook' },
        { platform: 'YouTube', url: 'https://www.youtube.com', icon: 'fa-brands fa-youtube' },
        { platform: 'Telegram', url: 'https://t.me/', icon: 'fa-brands fa-telegram' },
        { platform: 'TikTok', url: 'https://www.tiktok.com', icon: 'fa-brands fa-tiktok' },
        { platform: 'Instagram', url: 'https://www.instagram.com', icon: 'fa-brands fa-instagram' }
      ]
    },
    legal: {
      title: 'Legal Info',
      links: [
        { label: 'Privacy Policy', href: '/privacy' },
        { label: 'Terms of Service', href: '/terms' },
        { label: 'Contact', href: '/contact' }
      ]
    }
  });

  useEffect(() => {
    // Fetch footer data from backend API if available, otherwise use static defaults
    const apiBase = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';
    fetch(`${apiBase}/footer`)
      .then(res => (res.ok ? res.json() : null))
      .then(data => {
        if (data && data.sections) {
          setSections(data.sections);
        } else {
          setSections(getStaticDefaults());
        }
      })
      .catch(() => {
        setSections(getStaticDefaults());
      });
  }, []);

  if (!sections) return null;

  return (
    <footer className="main-footer">
      <div className="container">
        <div className="footer-grid">
          <AboutUs title={sections.about.title} links={sections.about.links} />
          <QuickLinks title={sections.quickLinks.title} links={sections.quickLinks.links} />
          <ContactUs 
            title={sections.contact.title} 
            address={sections.contact.address}
            po_box={sections.contact.po_box}
            short_code={sections.contact.short_code}
            email={sections.contact.email}
            socials={sections.contact.socials}
          />
          <LegalInfo title={sections.legal.title} links={sections.legal.links} />
        </div>
        <FooterBottom />
      </div>
    </footer>
  );
};

export default Footer;
