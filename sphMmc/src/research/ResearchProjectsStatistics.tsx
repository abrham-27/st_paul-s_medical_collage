import React, { useState, useEffect, useRef } from 'react';

interface Statistic {
  id: number;
  label: string;
  value: string;
  description?: string;
  icon?: string;
  color?: string;
}

interface StatisticsProps {
  title: string;
  subtitle?: string;
  statistics: Statistic[];
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsStatistics: React.FC<StatisticsProps> = ({
  title,
  subtitle,
  statistics,
  icon = '📊',
  backgroundColor = 'white'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  const [isVisible, setIsVisible] = useState(false);
  const sectionRef = useRef<HTMLElement>(null);
  
  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true);
        }
      },
      { threshold: 0.3 }
    );
    
    if (sectionRef.current) {
      observer.observe(sectionRef.current);
    }
    
    return () => observer.disconnect();
  }, []);
  
  const extractNumericValue = (value: string): number => {
    // Extract numeric value from string like "150+", "2.5K", etc.
    const cleaned = value.replace(/[^\d.]/g, '');
    let numValue = parseFloat(cleaned) || 0;
    
    // Handle K, M suffixes
    if (value.toUpperCase().includes('K')) {
      numValue *= 1000;
    } else if (value.toUpperCase().includes('M')) {
      numValue *= 1000000;
    }
    
    return numValue;
  };
  
  const AnimatedCounter: React.FC<{ 
    targetValue: string; 
    isVisible: boolean;
    duration?: number;
  }> = ({ targetValue, isVisible, duration = 2000 }) => {
    const [currentValue, setCurrentValue] = useState(0);
    const numericTarget = extractNumericValue(targetValue);
    
    useEffect(() => {
      if (!isVisible) return;
      
      const startTime = Date.now();
      const animate = () => {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function for smooth animation
        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
        const current = Math.floor(numericTarget * easeOutQuart);
        
        setCurrentValue(current);
        
        if (progress < 1) {
          requestAnimationFrame(animate);
        }
      };
      
      requestAnimationFrame(animate);
    }, [isVisible, numericTarget, duration]);
    
    const formatValue = (num: number): string => {
      if (targetValue.includes('+')) {
        return num >= 1000 ? `${(num / 1000).toFixed(1)}K+` : `${num}+`;
      }
      if (targetValue.toUpperCase().includes('K')) {
        return `${(num / 1000).toFixed(1)}K`;
      }
      if (targetValue.toUpperCase().includes('M')) {
        return `${(num / 1000000).toFixed(1)}M`;
      }
      if (targetValue.includes('weeks') || targetValue.includes('days')) {
        return targetValue; // Return original for time-based values
      }
      return num.toString();
    };
    
    return <span>{formatValue(currentValue)}</span>;
  };
  
  return (
    <section ref={sectionRef} className={sectionClass}>
      <div className="rp-container">
        <div className="rp-section-header">
          <span className="rp-section-icon">{icon}</span>
          <h2 className="rp-section-title">{title}</h2>
          {subtitle && (
            <p className="rp-section-subtitle">{subtitle}</p>
          )}
          <div className="rp-underline"></div>
        </div>
        
        {statistics.length > 0 ? (
          <div className="rp-stats-grid">
            {statistics.map((stat) => (
              <div 
                key={stat.id} 
                className="rp-stat-card"
                style={{
                  animationDelay: `${statistics.indexOf(stat) * 0.1}s`
                }}
              >
                {stat.icon && (
                  <span className="rp-stat-icon">{stat.icon}</span>
                )}
                
                <div 
                  className="rp-stat-value"
                  style={{ color: stat.color || '#0ea5e9' }}
                >
                  <AnimatedCounter 
                    targetValue={stat.value} 
                    isVisible={isVisible}
                  />
                </div>
                
                <h3 className="rp-stat-label">{stat.label}</h3>
                
                {stat.description && (
                  <p className="rp-stat-description">{stat.description}</p>
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
            <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>📊</div>
            <p style={{ fontSize: '1.1rem', margin: 0 }}>
              Statistics and key metrics will be available soon.
            </p>
          </div>
        )}
      </div>
    </section>
  );
};

export default ResearchProjectsStatistics;