import React from 'react';
import { sanitizeHtml } from '../utils/richText';

interface HeroProps {
  title: string;
  subtitle?: string;
  description: string;
  badge: {
    icon: string;
    text: string;
  };
  heroImage?: string;
  onLearnMore?: () => void;
  onContact?: () => void;
}

const ResearchProjectsHero: React.FC<HeroProps> = ({
  title,
  subtitle,
  description,
  badge,
  heroImage,
  onLearnMore,
  onContact
}) => {
  return (
    <section className="rp-hero-modern">
      <div className="rp-hero-content">
        <div className="rp-hero-badge">
          <span>{badge.icon}</span>
          <span>{badge.text}</span>
        </div>
        
        <h1 className="rp-hero-title">{title}</h1>
        
        {subtitle && (
          <p className="rp-hero-subtitle">{subtitle}</p>
        )}
        
        <div 
          className="rp-hero-description"
          dangerouslySetInnerHTML={{ __html: sanitizeHtml(description) }}
        />
        
        <div className="rp-hero-cta">
          {onLearnMore && (
            <button className="rp-btn-primary" onClick={onLearnMore}>
              <span>📖</span>
              Learn More
            </button>
          )}
          {onContact && (
            <button className="rp-btn-secondary" onClick={onContact}>
              <span>📞</span>
              Contact Us
            </button>
          )}
        </div>
        
        {heroImage && (
          <div style={{ marginTop: '2rem' }}>
            <img 
              src={heroImage} 
              alt={title}
              style={{
                maxWidth: '600px',
                width: '100%',
                height: 'auto',
                borderRadius: '12px',
                boxShadow: '0 8px 32px rgba(0, 0, 0, 0.2)'
              }}
            />
          </div>
        )}
      </div>
    </section>
  );
};

export default ResearchProjectsHero;