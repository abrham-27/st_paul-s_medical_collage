import { useState, useEffect, useRef, useCallback } from 'react';
import { apiService, type GalleryItem } from './services/api';
import './Gallery.css';

interface Props {
  onBack: () => void;
}

export default function Gallery({ onBack }: Props) {
  const [items, setItems] = useState<GalleryItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [lightbox, setLightbox] = useState<number | null>(null);
  const [selectedCategory, setSelectedCategory] = useState<string>('all');
  const containerRef = useRef<HTMLDivElement>(null);

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

  const categories = ['all', ...Array.from(new Set(items.map(item => item.category).filter(Boolean)))];
  const filteredItems = selectedCategory === 'all' 
    ? items 
    : items.filter(item => item.category === selectedCategory);

  const openLightbox = (idx: number) => setLightbox(idx);
  const closeLightbox = useCallback(() => setLightbox(null), []);
  const prevImage = useCallback(() => {
    setLightbox(i => {
      if (i === null) return null;
      const prev = i - 1;
      return prev < 0 ? filteredItems.length - 1 : prev;
    });
  }, [filteredItems.length]);
  const nextImage = useCallback(() => {
    setLightbox(i => {
      if (i === null) return null;
      return (i + 1) % filteredItems.length;
    });
  }, [filteredItems.length]);

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

  const activeItem = lightbox !== null && filteredItems[lightbox] ? filteredItems[lightbox] : null;

  return (
    <div className="gallery-page">
      <button className="gallery-back-btn" onClick={onBack} aria-label="Go back">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
          <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
        Back
      </button>

      <div className="gallery-container">
        {/* Header */}
        <div className="gallery-header">
          <h1 className="gallery-title">Our Gallery</h1>
          <p className="gallery-subtitle">Explore moments, events, and achievements at St. Paul's Hospital Millennium Medical College</p>
        </div>

        {/* Category Filter */}
        {categories.length > 1 && (
          <div className="gallery-filters">
            {categories.map(cat => (
              <button
                key={cat}
                className={`gallery-filter-btn ${selectedCategory === cat ? 'active' : ''}`}
                onClick={() => {
                  setSelectedCategory(cat);
                  setLightbox(null);
                }}
              >
                {cat === 'all' ? 'All Images' : cat}
              </button>
            ))}
          </div>
        )}

        {/* Gallery Grid */}
        {loading ? (
          <div className="gallery-grid">
            {Array.from({ length: 12 }).map((_, i) => (
              <div key={i} className="gallery-item gallery-item--skeleton" />
            ))}
          </div>
        ) : filteredItems.length === 0 ? (
          <div className="gallery-empty">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
              <rect x="3" y="3" width="18" height="18" rx="2" />
              <circle cx="8.5" cy="8.5" r="1.5" />
              <path d="M21 15l-5-5L5 21" />
            </svg>
            <h3>No images found</h3>
            <p>No gallery images available for this category.</p>
          </div>
        ) : (
          <div className="gallery-grid" ref={containerRef}>
            {filteredItems.map((item, idx) => (
              <div
                key={item.id}
                className="gallery-item"
                onClick={() => openLightbox(idx)}
                role="button"
                tabIndex={0}
                onKeyDown={e => e.key === 'Enter' && openLightbox(idx)}
                aria-label={item.title || `Gallery image ${idx + 1}`}
              >
                <img
                  src={item.image}
                  alt={item.title || `SPHMMC gallery ${idx + 1}`}
                  className="gallery-item-img"
                />
                <div className="gallery-item-overlay">
                  {item.title && <span className="gallery-item-title">{item.title}</span>}
                  <span className="gallery-item-zoom">⤢</span>
                </div>
              </div>
            ))}
          </div>
        )}

        {filteredItems.length > 0 && (
          <div className="gallery-stats">
            <p>Showing {filteredItems.length} image{filteredItems.length !== 1 ? 's' : ''}</p>
          </div>
        )}
      </div>

      {/* Lightbox */}
      {activeItem && (
        <div className="gallery-lightbox" onClick={closeLightbox} role="dialog" aria-modal="true">
          <button className="gallery-lb-close" onClick={closeLightbox} aria-label="Close">✕</button>
          <button 
            className="gallery-lb-prev" 
            onClick={e => { e.stopPropagation(); prevImage(); }} 
            aria-label="Previous"
          >
            ‹
          </button>
          <div className="gallery-lb-content" onClick={e => e.stopPropagation()}>
            <img
              src={activeItem.image}
              alt={activeItem.title || 'Gallery image'}
              className="gallery-lb-img"
            />
            {activeItem.title && (
              <div className="gallery-lb-caption">
                <span className="gallery-lb-title">{activeItem.title}</span>
                {activeItem.category && <span className="gallery-lb-category">{activeItem.category}</span>}
              </div>
            )}
          </div>
          <button 
            className="gallery-lb-next" 
            onClick={e => { e.stopPropagation(); nextImage(); }} 
            aria-label="Next"
          >
            ›
          </button>
          <div className="gallery-lb-counter">
            {items.findIndex(i => i.id === activeItem.id) + 1} / {items.length}
          </div>
        </div>
      )}
    </div>
  );
}
