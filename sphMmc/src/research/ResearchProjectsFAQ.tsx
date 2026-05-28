import React, { useState } from 'react';
import { sanitizeHtml } from '../utils/richText';

interface FAQ {
  id: number;
  question: string;
  answer: string;
}

interface FAQProps {
  title: string;
  subtitle?: string;
  faqs: FAQ[];
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsFAQ: React.FC<FAQProps> = ({
  title,
  subtitle,
  faqs,
  icon = '❓',
  backgroundColor = 'white'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  const [activeIndex, setActiveIndex] = useState<number | null>(null);
  
  const toggleFAQ = (index: number) => {
    setActiveIndex(activeIndex === index ? null : index);
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
        
        {faqs.length > 0 ? (
          <div className="rp-faq-list">
            {faqs.map((faq, index) => (
              <div 
                key={faq.id} 
                className={`rp-faq-item ${activeIndex === index ? 'active' : ''}`}
              >
                <button
                  className="rp-faq-question"
                  onClick={() => toggleFAQ(index)}
                  aria-expanded={activeIndex === index}
                >
                  <span>{faq.question}</span>
                  <span className="rp-faq-icon">
                    {activeIndex === index ? '▲' : '▼'}
                  </span>
                </button>
                
                {activeIndex === index && (
                  <div 
                    className="rp-faq-answer"
                    dangerouslySetInnerHTML={{ __html: sanitizeHtml(faq.answer) }}
                  />
                )}
              </div>
            ))}
          </div>
        ) : (
          <div style={{ 
            textAlign: 'center', 
            padding: '3rem 2rem',
            color: backgroundColor === 'navy' ? '#bae6fd' : '#64748b'
          }}>
            <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>❓</div>
            <p style={{ fontSize: '1.1rem', margin: 0 }}>
              Frequently asked questions will be available soon.
            </p>
          </div>
        )}
      </div>
    </section>
  );
};

export default ResearchProjectsFAQ;