import React from 'react';
import { sanitizeHtml } from '../utils/richText';

interface FunctionItem {
  id: number;
  title: string;
  description: string;
  icon?: string;
  features?: string[];
}

interface FunctionsProps {
  title: string;
  subtitle?: string;
  functions: FunctionItem[];
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsFunctions: React.FC<FunctionsProps> = ({
  title,
  subtitle,
  functions,
  icon = '⚙️',
  backgroundColor = 'light'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  
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
        
        <div className="rp-card-grid">
          {functions.map((func) => (
            <div key={func.id} className="rp-card-modern">
              <div className="rp-card-header">
                <div className="rp-card-icon">
                  {func.icon || '🔧'}
                </div>
                <h3 className="rp-card-title">{func.title}</h3>
              </div>
              
              <div 
                className="rp-card-description"
                dangerouslySetInnerHTML={{ __html: sanitizeHtml(func.description) }}
              />
              
              {func.features && func.features.length > 0 && (
                <ul className="rp-card-features">
                  {func.features.map((feature, index) => (
                    <li key={index}>{feature}</li>
                  ))}
                </ul>
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default ResearchProjectsFunctions;