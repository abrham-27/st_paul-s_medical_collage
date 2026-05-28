import React from 'react';
import { sanitizeHtml } from '../utils/richText';

interface TeamMember {
  id: number;
  name: string;
  role: string;
  bio?: string;
  image?: string;
  email?: string;
  phone?: string;
}

interface TeamProps {
  title: string;
  subtitle?: string;
  members: TeamMember[];
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsTeam: React.FC<TeamProps> = ({
  title,
  subtitle,
  members,
  icon = '👥',
  backgroundColor = 'light'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  
  const getImageUrl = (imagePath?: string): string | null => {
    if (!imagePath) return null;
    
    if (imagePath.startsWith('http')) {
      return imagePath;
    }
    
    const apiUrl = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';
    const storageBase = apiUrl.replace(/\/+$/, '').replace(/\/api$/, '') + '/storage';
    const normalized = imagePath.replace(/^\/+/, '').replace(/^storage\/+/, '');
    return `${storageBase}/${normalized}`;
  };
  
  const getInitials = (name: string): string => {
    return name
      .split(' ')
      .map(word => word.charAt(0))
      .join('')
      .toUpperCase()
      .slice(0, 2);
  };
  
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
        
        {members.length > 0 ? (
          <div className="rp-team-grid">
            {members.map((member) => {
              const imageUrl = getImageUrl(member.image);
              
              return (
                <div key={member.id} className="rp-team-card">
                  <div className="rp-team-avatar">
                    {imageUrl ? (
                      <img 
                        src={imageUrl} 
                        alt={member.name}
                        onError={(e) => {
                          // Fallback to initials if image fails to load
                          const target = e.target as HTMLImageElement;
                          target.style.display = 'none';
                          const parent = target.parentElement;
                          if (parent) {
                            parent.innerHTML = getInitials(member.name);
                            parent.style.fontSize = '2rem';
                            parent.style.fontWeight = '700';
                            parent.style.color = '#0ea5e9';
                          }
                        }}
                      />
                    ) : (
                      <span style={{ 
                        fontSize: '2rem', 
                        fontWeight: '700', 
                        color: '#0ea5e9' 
                      }}>
                        {getInitials(member.name)}
                      </span>
                    )}
                  </div>
                  
                  <h3 className="rp-team-name">{member.name}</h3>
                  <p className="rp-team-role">{member.role}</p>
                  
                  {member.bio && (
                    <div 
                      className="rp-team-bio"
                      dangerouslySetInnerHTML={{ __html: sanitizeHtml(member.bio) }}
                    />
                  )}
                  
                  <div className="rp-team-contact">
                    {member.email && (
                      <a 
                        href={`mailto:${member.email}`}
                        title={`Email ${member.name}`}
                        style={{ textDecoration: 'none' }}
                      >
                        📧
                      </a>
                    )}
                    {member.phone && (
                      <a 
                        href={`tel:${member.phone}`}
                        title={`Call ${member.name}`}
                        style={{ textDecoration: 'none' }}
                      >
                        📞
                      </a>
                    )}
                  </div>
                </div>
              );
            })}
          </div>
        ) : (
          <div style={{ 
            textAlign: 'center', 
            padding: '3rem 2rem',
            color: backgroundColor === 'navy' ? '#bae6fd' : '#64748b'
          }}>
            <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>👥</div>
            <p style={{ fontSize: '1.1rem', margin: 0 }}>
              Team member information will be available soon.
            </p>
          </div>
        )}
      </div>
    </section>
  );
};

export default ResearchProjectsTeam;