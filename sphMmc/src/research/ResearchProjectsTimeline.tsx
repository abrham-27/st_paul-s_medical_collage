import React from 'react';
import { sanitizeHtml } from '../utils/richText';

interface WorkflowStep {
  id: number;
  title: string;
  description: string;
  step_number: number;
  icon?: string;
  estimated_time?: string;
  requirements?: string[];
}

interface TimelineProps {
  title: string;
  subtitle?: string;
  steps: WorkflowStep[];
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsTimeline: React.FC<TimelineProps> = ({
  title,
  subtitle,
  steps,
  icon = '📋',
  backgroundColor = 'white'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  
  // Sort steps by step_number
  const sortedSteps = [...steps].sort((a, b) => a.step_number - b.step_number);
  
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
        
        <div className="rp-timeline">
          {sortedSteps.map((step, index) => (
            <div key={step.id} className="rp-timeline-item">
              <div className="rp-timeline-number">
                {step.step_number}
              </div>
              <div className="rp-timeline-content">
                <h3 className="rp-timeline-title">
                  {step.icon && <span style={{ marginRight: '0.5rem' }}>{step.icon}</span>}
                  {step.title}
                </h3>
                <div 
                  className="rp-timeline-description"
                  dangerouslySetInnerHTML={{ __html: sanitizeHtml(step.description) }}
                />
                {step.estimated_time && (
                  <div className="rp-timeline-time">
                    ⏱️ Estimated Time: {step.estimated_time}
                  </div>
                )}
                {step.requirements && step.requirements.length > 0 && (
                  <div style={{ marginTop: '1rem' }}>
                    <strong style={{ color: '#0a1628', fontSize: '0.9rem' }}>Requirements:</strong>
                    <ul style={{ 
                      margin: '0.5rem 0 0 0', 
                      paddingLeft: '1.5rem',
                      fontSize: '0.875rem',
                      color: '#64748b'
                    }}>
                      {step.requirements.map((req, reqIndex) => (
                        <li key={reqIndex}>{req}</li>
                      ))}
                    </ul>
                  </div>
                )}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default ResearchProjectsTimeline;