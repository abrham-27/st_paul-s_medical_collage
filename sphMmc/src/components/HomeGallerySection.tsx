import { useState, useEffect, useRef, useCallback } from 'react';
import { apiService, type GalleryItem } from '../services/api';

interface Props {
  navigate: (path: string) => void;
}

export default function HomeGallerySection({ navigate }: Props) {
  const [items, setItems] = useState<GalleryItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [lightbox, setLightbox] = useState<number | null>(null); // index
  const trackRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    apiService.getGallery()
      .then(res => {
        if (res.success && res.data.length > 0) {
          setItems(res.data);
        } else {
          setItems([]);
        }
      })
      .catch(() => setItems([]))
      .finally(() => setLoading(false));
  }, []);

  // Lightbox navigation
  const openLightbox = (idx: number) => setLightbox(idx);
  const closeLightbox = useCallback(() => setLightbox(null), []);
  const prevImage = useCallback(() => setLightbox(i => i !== null ? (i - 1 + items.length) % items.length : null), [items.length]);
  const nextImage = useCallback(() => setLightbox(i => i !== null ? (i + 1) % items.length : null), [items.length]);

  // Keyboard navigation
  useEffect(() => {
    if (lightbox === null) return;
    const handler = (e: KeyboardEvent) => {
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft') prevImage();
      if (e.key === 'ArrowRight') nextImage();
    };
    window.addEventListener('keydown', handler);
    return () => window.removeEventListener('keydown', handler);
  }, [lightbox, closeLightbox, prevImage, nextImage]);

  // Scroll track — scrolls the two-rows wrapper
  const scrollLeft = () => trackRef.current?.scrollBy({ left: -320, behavior: 'smooth' });
  const scrollRight = () => trackRef.current?.scrollBy({ left: 320, behavior: 'smooth' });

  const activeItem = lightbox !== null ? items[lightbox] : null;

  return (
    <section className="hg-section">
      <div className="hg-inner">
        {/* Header */}
        <div className="hg-header">
          <div className="hg-header-text">
            <span className="hg-label">SPHMMC · Visual</span>
            <h2 className="hg-title">Our Gallery</h2>
            <p className="hg-subtitle">Explore moments, events, and achievements at SPHMMC</p>
          </div>
          <button className="hg-view-all" onClick={() => navigate('/gallery')}>
            View Full Gallery ↗
          </button>
        </div>

        {/* Two-row horizontal scroll track */}
        <div className="hg-track-wrap">
          <button className="hg-scroll-btn hg-scroll-btn--left" onClick={scrollLeft} aria-label="Scroll left">‹</button>
          <div className="hg-two-rows" ref={trackRef}>
            {loading ? (
              <>
                <div className="hg-track">
                  {Array.from({ length: 5 }).map((_, i) => <div key={i} className="hg-card hg-card--skeleton" />)}
                </div>
                <div className="hg-track">
                  {Array.from({ length: 5 }).map((_, i) => <div key={i} className="hg-card hg-card--skeleton" />)}
                </div>
              </>
            ) : items.length === 0 ? (
              <div className="hg-empty-state">
                <p>No gallery images are available from the backend at the moment.</p>
              </div>
            ) : (
              <>
                {/* Row 1 — odd-indexed items */}
                <div className="hg-track">
                  {items.filter((_, i) => i % 2 === 0).map((item, idx) => (
                    <div
                      key={item.id}
                      className="hg-card"
                      onClick={() => openLightbox(items.indexOf(item))}
                      role="button"
                      tabIndex={0}
                      onKeyDown={e => e.key === 'Enter' && openLightbox(items.indexOf(item))}
                      aria-label={item.title || `Gallery image ${idx + 1}`}
                    >
                      <img
                        src={item.image}
                        alt={item.title || `SPHMMC gallery ${idx + 1}`}
                        className="hg-img"
                      />
                      <div className="hg-overlay">
                        {item.title && <span className="hg-img-title">{item.title}</span>}
                        <span className="hg-zoom-icon">⤢</span>
                      </div>
                    </div>
                  ))}
                </div>
                {/* Row 2 — even-indexed items */}
                <div className="hg-track">
                  {items.filter((_, i) => i % 2 === 1).map((item, idx) => (
                    <div
                      key={item.id}
                      className="hg-card"
                      onClick={() => openLightbox(items.indexOf(item))}
                      role="button"
                      tabIndex={0}
                      onKeyDown={e => e.key === 'Enter' && openLightbox(items.indexOf(item))}
                      aria-label={item.title || `Gallery image ${idx + 1}`}
                    >
                      <img
                        src={item.image}
                        alt={item.title || `SPHMMC gallery ${idx + 1}`}
                        className="hg-img"
                      />
                      <div className="hg-overlay">
                        {item.title && <span className="hg-img-title">{item.title}</span>}
                        <span className="hg-zoom-icon">⤢</span>
                      </div>
                    </div>
                  ))}
                </div>
              </>
            )}
          </div>
          <button className="hg-scroll-btn hg-scroll-btn--right" onClick={scrollRight} aria-label="Scroll right">›</button>
        </div>
      </div>

      {/* Lightbox */}
      {activeItem && (
        <div className="hg-lightbox" onClick={closeLightbox} role="dialog" aria-modal="true">
          <button className="hg-lb-close" onClick={closeLightbox} aria-label="Close">✕</button>
          <button className="hg-lb-prev" onClick={e => { e.stopPropagation(); prevImage(); }} aria-label="Previous">‹</button>
          <div className="hg-lb-content" onClick={e => e.stopPropagation()}>
            <img
              src={activeItem.image}
              alt={activeItem.title || 'Gallery image'}
              className="hg-lb-img"
            />
            {activeItem.title && (
              <div className="hg-lb-caption">
                <span>{activeItem.title}</span>
                {activeItem.category && <span className="hg-lb-cat">{activeItem.category}</span>}
              </div>
            )}
          </div>
          <button className="hg-lb-next" onClick={e => { e.stopPropagation(); nextImage(); }} aria-label="Next">›</button>
        </div>
      )}
    </section>
  );
}
