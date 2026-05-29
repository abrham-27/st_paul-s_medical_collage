import type { HomeHeroSlide } from '../services/api';
import { sanitizeHtml } from '../utils/richText';

interface HeroSectionProps {
  slides: HomeHeroSlide[];
  currentSlide: number;
  onPrev: () => void;
  onNext: () => void;
  navigate: (path: string) => void;
}

// Helper function to determine if a link is external
function isExternalLink(url: string): boolean {
  try {
    // Check if it's a full URL with protocol
    if (url.startsWith('http://') || url.startsWith('https://')) {
      return true;
    }
    // Check if it's a protocol-relative URL
    if (url.startsWith('//')) {
      return true;
    }
    // Check if it contains a domain (basic check)
    if (url.includes('.com') || url.includes('.org') || url.includes('.net') || url.includes('.edu') || url.includes('.gov')) {
      return true;
    }
    return false;
  } catch {
    return false;
  }
}

// Helper function to handle navigation
function handleNavigation(url: string, navigate: (path: string) => void): void {
  if (!url) return;
  
  if (isExternalLink(url)) {
    // For external links, open in new tab
    window.open(url, '_blank', 'noopener,noreferrer');
  } else {
    // For local links, use React Router navigation
    navigate(url);
  }
}

export default function HeroSection({
  slides,
  currentSlide,
  onPrev,
  onNext,
  navigate,
}: HeroSectionProps) {
  const hasSlides = slides.length > 0;

  return (
    <section className="hero-section">
      <div className="hero-slides-track">
        {slides.map((slide, idx) => {
          const isActive = idx === currentSlide;
          return (
            <div
              key={slide.id}
              className={`hero-slide${isActive ? ' hero-slide--active' : ''}`}
              aria-hidden={!isActive}
            >
              <div className="hero-image-panel">
                <div className="hero-oval-frame">
                  {slide.image || slide.image_url ? (
                    <img
                      src={slide.image || slide.image_url || undefined}
                      alt={slide.title ?? `Hero slide ${idx + 1}`}
                      className="hero-slide-img"
                    />
                  ) : (
                    <div className="hero-img-placeholder" />
                  )}
                </div>
              </div>

              <div className="hero-content-panel">
                {slide.subtitle && <span className="hero-subtitle">{slide.subtitle}</span>}
                <h1 className="hero-heading">{slide.title}</h1>
                {slide.description && (
                  <div
                    className="hero-description"
                    dangerouslySetInnerHTML={{ __html: sanitizeHtml(slide.description) }}
                  />
                )}
                {slide.button_text && slide.button_link && (
                  <div className="hero-cta-group">
                    <button
                      className="hero-btn hero-btn--primary"
                      onClick={() => handleNavigation(slide.button_link ?? '/', navigate)}
                      title={isExternalLink(slide.button_link ?? '') ? 'Opens in new tab' : undefined}
                    >
                      {slide.button_text}
                      {isExternalLink(slide.button_link ?? '') && (
                        <span className="external-link-icon" style={{ marginLeft: '4px' }}>↗</span>
                      )}
                    </button>
                  </div>
                )}
              </div>
            </div>
          );
        })}

        {!hasSlides && (
          <div className="hero-slide hero-slide--active">
            <div className="hero-image-panel">
              <div className="hero-oval-frame">
                <div className="hero-img-placeholder" />
              </div>
            </div>
            <div className="hero-content-panel">
              <span className="hero-subtitle">Loading hero content…</span>
              <h1 className="hero-heading">SPHMMC — Learn, Heal, Lead</h1>
              <p className="hero-description">The home hero content is dynamically loaded from the backend database.</p>
            </div>
          </div>
        )}
      </div>

      <div className="hero-nav">
        <button className="hero-arrow" onClick={onPrev} aria-label="Previous slide">←</button>
        <div className="hero-dots">
          {slides.map((_, idx) => (
            <span
              key={idx}
              className={`hero-dot${idx === currentSlide ? ' hero-dot--active' : ''}`}
            />
          ))}
        </div>
        <button className="hero-arrow" onClick={onNext} aria-label="Next slide">→</button>
      </div>
    </section>
  );
}
