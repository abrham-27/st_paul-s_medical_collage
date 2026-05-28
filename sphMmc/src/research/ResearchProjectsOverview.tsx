import React from 'react';
import { sanitizeHtml } from '../utils/richText';

interface OverviewProps {
  title: string;
  content: string;
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsOverview: React.FC<OverviewProps> = ({
  title,
  content,
  icon = '📋',
  backgroundColor = 'white'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  
  return (
    <section className={sectionClass}>
      <div className="rp-container">
        <div className="rp-section-header">
          <span className="rp-section-icon">{icon}</span>
          <h2 className="rp-section-title">{title}</h2>
          <div className="rp-underline"></div>
        </div>
        
        <div 
          className="rp-section-content"
          style={{
            fontSize: '1.125rem',
            lineHeight: '1.8',
            color: backgroundColor === 'navy' ? '#bae6fd' : '#475569',
            maxWidth: '800px',
            margin: '0 auto',
            textAlign: 'center'
          }}
          dangerouslySetInnerHTML={{ __html: sanitizeHtml(content) }}
        />
      </div>
    </section>
  );
};

export default ResearchProjectsOverview;