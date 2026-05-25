# Design Document: Homepage Hero Redesign

## Overview

The homepage hero is being redesigned from a full-viewport fixed-position image carousel into a modern two-column section that sits in normal document flow below the fixed 100px header. The left column (`ContentPanel`) presents institutional identity content; the right column (`OvalSlider`) shows an ellipse-clipped image carousel. The component is extracted into `sphMmc/src/components/HeroSection.tsx` and receives all state as props from `App.tsx`, which retains ownership of `currentSlide` and the 5-second interval.

The key architectural shift is from `position: fixed` (full-viewport) to `position: relative` (in-flow), which means `.main-content`'s `padding-top` must be updated to match the new hero height instead of `100vh - 100px`.

---

## Architecture

### Component Tree

```
App.tsx
└── Home (inline component)
    └── HeroSection  ← new component (replaces <section className="hero-aau">)
        ├── ContentPanel  (left column, internal div)
        │   ├── subtitle span
        │   ├── h1 heading
        │   ├── description p
        │   ├── feature highlights ul
        │   └── CTA buttons div
        └── OvalSlider  (right column, internal div)
            ├── image stack (stacked absolutely-positioned imgs)
            ├── gradient overlay div
            ├── prev/next arrow buttons
            └── pagination dots div
```

### File Layout

```
sphMmc/src/
  components/
    HeroSection.tsx        ← new file
  App.tsx                  ← replace <section className="hero-aau"> block; add onPrev/onNext handlers
  App.css                  ← replace .hero-aau block; add new hero CSS rules
```

No new CSS file is created. All new styles are appended to `App.css` in a clearly delimited block.

---

## Components and Interfaces

### HeroSection Props

```typescript
interface HeroSectionProps {
  heroImages: string[];       // array of imported image URLs
  currentSlide: number;       // active slide index (0-based)
  onPrev: () => void;         // decrement currentSlide with wrap
  onNext: () => void;         // increment currentSlide with wrap
  navigate: (path: string) => void; // React Router navigate function
}
```

### HeroSection Component Skeleton

```typescript
// sphMmc/src/components/HeroSection.tsx
import React from 'react';

export default function HeroSection({
  heroImages,
  currentSlide,
  onPrev,
  onNext,
  navigate,
}: HeroSectionProps) {
  const hasImages = heroImages.length > 0;

  return (
    <section className="hero-section">
      {/* Left: ContentPanel */}
      <div className="hero-content-panel">
        <span className="hero-subtitle">Excellence in Medical Education</span>
        <h1 className="hero-heading">
          St. Paul's Hospital Millennium Medical College
        </h1>
        <p className="hero-description">…</p>
        <ul className="hero-features">…</ul>
        <div className="hero-cta-group">
          <button className="hero-btn hero-btn--primary" onClick={() => navigate('/academics/medicine/overview')}>
            Explore Academics
          </button>
          <button className="hero-btn hero-btn--secondary" onClick={() => navigate('/latests/news')}>
            Latest News
          </button>
        </div>
      </div>

      {/* Right: OvalSlider */}
      <div className="hero-oval-wrapper">
        <div className="hero-oval-slider">
          {hasImages ? heroImages.map((src, idx) => (
            <img
              key={idx}
              src={src}
              alt={`SPHMMC campus ${idx + 1}`}
              className={`hero-oval-img ${idx === currentSlide ? 'hero-oval-img--active' : ''}`}
            />
          )) : (
            <div className="hero-oval-placeholder" />
          )}
          <div className="hero-oval-overlay" />
          <button className="hero-arrow hero-arrow--prev" onClick={onPrev} aria-label="Previous image">&#8249;</button>
          <button className="hero-arrow hero-arrow--next" onClick={onNext} aria-label="Next image">&#8250;</button>
        </div>
        <div className="hero-dots">
          {heroImages.map((_, idx) => (
            <span key={idx} className={`hero-dot ${idx === currentSlide ? 'hero-dot--active' : ''}`} />
          ))}
        </div>
      </div>
    </section>
  );
}
```

### App.tsx Changes

1. Add `onPrev` and `onNext` handlers alongside the existing `currentSlide` state:

```typescript
const handlePrev = () =>
  setCurrentSlide((prev) => (prev - 1 + heroImages.length) % heroImages.length);
const handleNext = () =>
  setCurrentSlide((prev) => (prev + 1) % heroImages.length);
```

2. Import `HeroSection` and replace the `<section className="hero-aau">` block in `Home`:

```tsx
import HeroSection from './components/HeroSection';

// Inside Home JSX, replace the hero-aau section:
<HeroSection
  heroImages={heroImages}
  currentSlide={currentSlide}
  onPrev={onPrev}
  onNext={onNext}
  navigate={navigate}
/>
```

3. Pass `onPrev` and `onNext` through `HomeProps` to `Home`.

---

## Data Models

### Slide State (owned by App.tsx — unchanged)

```typescript
const [currentSlide, setCurrentSlide] = useState<number>(0);
const heroImages: string[] = [paul1, paul2, paul3, paul4, paul5]; // imported URLs
```

The `HeroSection` component is stateless with respect to slides. It receives `currentSlide` as a number and `heroImages` as a string array. No internal state is needed for the slider.

### Feature Highlights (static data, defined inside HeroSection.tsx)

```typescript
const FEATURE_HIGHLIGHTS = [
  { icon: '🎓', label: 'Medical Education' },
  { icon: '🏥', label: 'Clinical Services' },
  { icon: '🔬', label: 'Research & Innovation' },
  { icon: '🤝', label: 'Community Service' },
] as const;
```

---

## Layout Design

### Desktop (≥ 1024px) — Two-Column Grid

```
┌─────────────────────────────────────────────────────────┐
│  header (fixed, 100px)                                  │
├──────────────────────────┬──────────────────────────────┤
│  ContentPanel  (55%)     │  OvalSlider  (45%)           │
│                          │                              │
│  subtitle                │    ╭──────────────╮          │
│  H1 heading              │   /  hero image   \         │
│  description             │  │   (oval clip)   │         │
│  feature highlights      │   \               /         │
│  [Explore] [News]        │    ╰──────────────╯          │
│                          │   ◀  ● ○ ○ ○ ○  ▶           │
└──────────────────────────┴──────────────────────────────┘
```

Implementation: CSS Grid with `grid-template-columns: 55fr 45fr` on `.hero-section`. The section is `position: relative` (in-flow), sits directly below the fixed header via `margin-top: 100px` on `.main-content` (or the section itself is the first child of `.main-content` which already has `padding-top`).

The new `.main-content` `padding-top` will be the hero's rendered height. Since the hero height is defined by its content (min-height: 560px on desktop), we set:

```css
.main-content {
  padding-top: 0; /* hero is now in-flow, no offset needed */
}
```

The hero section itself handles its own top spacing by being the first element inside `.main-content`.

### Tablet (768px – 1023px) — Single Column, Stacked

ContentPanel stacks above OvalSlider. Grid becomes `grid-template-columns: 1fr`. Oval height reduces to ~360px. Spacing tightens.

### Mobile (< 768px) — Single Column, Centered

ContentPanel text-align: center. Feature highlights wrap to 2×2 grid. Oval scales to `min(80vw, 320px)` width. CTA buttons stack vertically.

---

## OvalSlider Design

### Shape

The oval is achieved with `border-radius: 50%` on a fixed-aspect-ratio container, combined with `overflow: hidden`:

```css
.hero-oval-slider {
  width: 420px;
  height: 520px;
  border-radius: 50%;
  overflow: hidden;
  position: relative;
}
```

On tablet: `width: 320px; height: 400px`.
On mobile: `width: min(80vw, 300px); height: calc(min(80vw, 300px) * 1.24)` (same ~1:1.24 aspect ratio).

### Image Stacking and Transition

All images are stacked absolutely at `top:0; left:0; width:100%; height:100%; object-fit: cover`. Inactive images have `opacity: 0`; the active image has `opacity: 1`. The transition is `opacity 1.0s ease-in-out` (within the 0.8–1.5s requirement).

```css
.hero-oval-img {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  object-fit: cover;
  opacity: 0;
  transition: opacity 1.0s ease-in-out;
}
.hero-oval-img--active { opacity: 1; }
```

### Gradient Overlay

A subtle radial/linear gradient overlay sits above the images but below the arrows:

```css
.hero-oval-overlay {
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at center, transparent 55%, rgba(0,0,128,0.25) 100%);
  pointer-events: none;
  z-index: 1;
}
```

### Navigation Arrows

Arrows are positioned outside the oval container (on the `.hero-oval-wrapper`) so they are never clipped:

```css
.hero-oval-wrapper {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.hero-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,0.15);
  border: 2px solid rgba(255,255,255,0.5);
  color: #fff;
  border-radius: 50%;
  width: 40px; height: 40px;
  font-size: 1.4rem;
  cursor: pointer;
  z-index: 10;
  transition: background 0.2s, border-color 0.2s;
}
.hero-arrow--prev { left: -24px; }
.hero-arrow--next { right: -24px; }
.hero-arrow:hover {
  background: var(--golden-yellow);
  border-color: var(--golden-yellow);
  color: var(--navy);
}
```

### Pagination Dots

Dots sit below the oval wrapper, centered:

```css
.hero-dots {
  display: flex;
  gap: 0.5rem;
  justify-content: center;
}
.hero-dot {
  width: 8px; height: 8px;
  border-radius: 50%;
  background: rgba(255,255,255,0.35);
  transition: background 0.3s, transform 0.3s;
}
.hero-dot--active {
  background: var(--golden-yellow);
  transform: scale(1.4);
}
```

---

## ContentPanel Design

### Typography Hierarchy

| Element | Font | Size | Weight | Color |
|---|---|---|---|---|
| Subtitle | `--font-sans` | `0.85rem` | 600 | `--golden-yellow` |
| H1 Heading | `--font-serif` | `clamp(2rem, 3vw, 3.5rem)` | 700 | `--white` |
| Description | `--font-sans` | `1rem` | 400 | `rgba(255,255,255,0.85)` |
| Feature label | `--font-sans` | `0.9rem` | 500 | `--white` |

### Feature Highlights Layout

Four items in a 2×2 grid on desktop/tablet, 2×2 on mobile:

```css
.hero-features {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.75rem 1.5rem;
  list-style: none;
  padding: 0;
  margin: 1.5rem 0;
}
.hero-feature-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  color: var(--white);
  font-family: var(--font-sans);
}
.hero-feature-icon {
  font-size: 1.1rem;
}
```

### CTA Buttons

```css
.hero-cta-group {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}
.hero-btn {
  padding: 0.75rem 1.75rem;
  border-radius: 8px;
  font-family: var(--font-sans);
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  border: 2px solid transparent;
  transition: background 0.25s, color 0.25s, transform 0.2s, box-shadow 0.2s;
  letter-radius: 0.02em;
}
.hero-btn--primary {
  background: var(--golden-yellow);
  color: var(--navy);
  border-color: var(--golden-yellow);
}
.hero-btn--primary:hover {
  background: #e6c200;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(255,215,0,0.35);
}
.hero-btn--secondary {
  background: transparent;
  color: var(--white);
  border-color: rgba(255,255,255,0.6);
}
.hero-btn--secondary:hover {
  background: rgba(255,255,255,0.12);
  border-color: var(--white);
}
```

---

## CSS Class Naming Conventions

All new classes use the `hero-` prefix to avoid collisions with existing `.hero-aau`, `.hero-slide`, `.hero-dot`, `.hero-dots`, `.hero-overlay`, `.hero-text-content`, `.hero-btns` classes (which will be removed from the `.hero-aau` block).

| New Class | Purpose |
|---|---|
| `.hero-section` | Root section element (replaces `.hero-aau`) |
| `.hero-content-panel` | Left column wrapper |
| `.hero-subtitle` | "Excellence in Medical Education" label |
| `.hero-heading` | H1 institution name |
| `.hero-description` | Body paragraph |
| `.hero-features` | Feature highlights `<ul>` |
| `.hero-feature-item` | Single feature `<li>` |
| `.hero-feature-icon` | Icon span inside feature item |
| `.hero-cta-group` | Button row wrapper |
| `.hero-btn` | Base button style |
| `.hero-btn--primary` | Gold fill button |
| `.hero-btn--secondary` | Outline button |
| `.hero-oval-wrapper` | Outer wrapper for oval + dots + arrows |
| `.hero-oval-slider` | The clipped oval container |
| `.hero-oval-img` | Each stacked image |
| `.hero-oval-img--active` | Active (visible) image |
| `.hero-oval-overlay` | Gradient overlay inside oval |
| `.hero-oval-placeholder` | Navy background when no images |
| `.hero-arrow` | Base arrow button |
| `.hero-arrow--prev` | Left arrow |
| `.hero-arrow--next` | Right arrow |
| `.hero-dots` | Dots row (reuses existing name but scoped to new component) |
| `.hero-dot` | Single dot |
| `.hero-dot--active` | Active dot |

---

## Animation Keyframes

All defined in `App.css`:

```css
/* ContentPanel mount fade-in (Requirement 5.1) */
@keyframes hero-fade-in-up {
  from { opacity: 0; transform: translateY(24px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* OvalSlider float loop (Requirement 5.3) */
@keyframes hero-float {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-10px); }
}
```

Applied:

```css
.hero-content-panel {
  animation: hero-fade-in-up 0.7s ease both;
}

.hero-oval-wrapper {
  animation: hero-float 4s ease-in-out infinite;
}
```

The float animation moves the oval by 10px (within the ≤12px requirement). The fade-in duration is 0.7s (within 0.5–1s).

---

## Responsive Breakpoints

```css
/* ── Hero Section ── */
.hero-section {
  display: grid;
  grid-template-columns: 55fr 45fr;
  align-items: center;
  gap: 3rem;
  padding: 4rem 5%;
  background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
  min-height: 560px;
}

/* Tablet: 768px – 1023px */
@media (max-width: 1023px) {
  .hero-section {
    grid-template-columns: 1fr;
    padding: 3rem 5%;
    min-height: auto;
    gap: 2rem;
  }
  .hero-oval-slider {
    width: 320px;
    height: 400px;
  }
  .hero-oval-wrapper {
    align-self: center;
    margin: 0 auto;
  }
}

/* Mobile: < 768px */
@media (max-width: 767px) {
  .hero-section {
    padding: 2rem 4%;
    gap: 1.5rem;
  }
  .hero-content-panel {
    text-align: center;
  }
  .hero-cta-group {
    flex-direction: column;
    align-items: center;
  }
  .hero-oval-slider {
    width: min(80vw, 300px);
    height: calc(min(80vw, 300px) * 1.24);
  }
  .hero-features {
    justify-items: center;
  }
}
```

---

## App.css Changes

### Remove

The entire `.hero-aau` block and its child rules (`.hero-slide`, `.hero-overlay`, `.hero-text-content`, `.hero-btns`, `.hero-dots`, `.hero-dot`) will be removed and replaced with the new `.hero-section` block.

The `.btn`, `.btn-primary`, `.btn-outline` classes remain untouched (used elsewhere).

### Update `.main-content`

```css
/* Before */
.main-content {
  padding-top: calc(100vh - 100px + 52px);
}

/* After — hero is now in-flow, no viewport offset needed */
.main-content {
  padding-top: 0;
}
```

The `explore-bar` is still `position: fixed` at the bottom and remains unchanged. Its `z-index` and behavior are unaffected.

### Add

New hero CSS block appended after the removed `.hero-aau` block, containing all `.hero-*` rules described above.

---

## Error Handling

**Empty `heroImages` array (Requirement 6.7):**
- The `hasImages` guard in `HeroSection` renders `.hero-oval-placeholder` (a `--navy` background div) instead of mapping images.
- No `heroImages[currentSlide]` direct access occurs; all access is via `.map()`.
- Arrow buttons and dots render nothing (empty array maps to nothing).

**`currentSlide` out of bounds:**
- The `onPrev`/`onNext` handlers in `App.tsx` use modulo arithmetic, so `currentSlide` is always in `[0, heroImages.length - 1]`.
- The active class check `idx === currentSlide` is safe even if `currentSlide` is 0 with an empty array (no items to map).

**Image load failure:**
- `<img>` elements have `alt` text for accessibility.
- No explicit `onError` handler is required by the spec; the oval background color (`--navy`) provides a fallback visual.

---

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system — essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

### Property 1: Active image class is applied to exactly one image

*For any* `heroImages` array of length ≥ 1 and any valid `currentSlide` index in `[0, heroImages.length - 1]`, rendering `HeroSection` should result in exactly one image element having the `hero-oval-img--active` class, and that element should correspond to the image at `currentSlide`.

**Validates: Requirements 1.2**

### Property 2: Navigation always stays in bounds

*For any* `heroImages` array of length N ≥ 1 and any `currentSlide` index in `[0, N-1]`, applying `onPrev` should yield `(currentSlide - 1 + N) % N` and applying `onNext` should yield `(currentSlide + 1) % N` — both always within `[0, N-1]`.

**Validates: Requirements 1.4, 1.5**

### Property 3: Dot count matches image count with exactly one active dot

*For any* `heroImages` array of length N ≥ 1 and any valid `currentSlide`, rendering `HeroSection` should produce exactly N dot elements, of which exactly one has the `hero-dot--active` class, corresponding to `currentSlide`.

**Validates: Requirements 1.6**

### Property 4: CTA buttons call navigate with the correct paths

*For any* mock `navigate` function, clicking the "Explore Academics" button should call `navigate` with `'/academics/medicine/overview'`, and clicking the "Latest News" button should call `navigate` with `'/latests/news'`.

**Validates: Requirements 2.5, 2.6**

---

## Testing Strategy

### Dual Approach

Both unit tests and property-based tests are required. They are complementary: unit tests catch concrete bugs in specific scenarios; property tests verify general correctness across all valid inputs.

### Unit Tests (specific examples and edge cases)

- Render with 5 images, `currentSlide=2` → verify image at index 2 has `hero-oval-img--active`, others do not.
- Render with `heroImages=[]` → verify no runtime error and `.hero-oval-placeholder` is in the DOM. *(edge case: Requirement 6.7)*
- Verify subtitle "Excellence in Medical Education" is present in rendered output.
- Verify heading "St. Paul's Hospital Millennium Medical College" is present.
- Verify exactly 4 feature highlight items are rendered.
- Verify "Explore Academics" and "Latest News" button labels are present.

### Property-Based Tests (fast-check, minimum 100 iterations each)

```typescript
// Feature: homepage-hero-redesign, Property 1: active image class applied to exactly one image
fc.assert(fc.property(
  fc.array(fc.string(), { minLength: 1, maxLength: 10 }),
  fc.nat(),
  (images, slideRaw) => {
    const slide = slideRaw % images.length;
    const { container } = render(<HeroSection heroImages={images} currentSlide={slide} onPrev={noop} onNext={noop} navigate={noop} />);
    const activeImgs = container.querySelectorAll('.hero-oval-img--active');
    return activeImgs.length === 1 && activeImgs[0] === container.querySelectorAll('.hero-oval-img')[slide];
  }
), { numRuns: 100 });

// Feature: homepage-hero-redesign, Property 2: navigation always stays in bounds
fc.assert(fc.property(
  fc.integer({ min: 1, max: 20 }),
  fc.nat(),
  (n, slideRaw) => {
    const slide = slideRaw % n;
    const prevResult = (slide - 1 + n) % n;
    const nextResult = (slide + 1) % n;
    return prevResult >= 0 && prevResult < n && nextResult >= 0 && nextResult < n;
  }
), { numRuns: 100 });

// Feature: homepage-hero-redesign, Property 3: dot count matches image count with exactly one active dot
fc.assert(fc.property(
  fc.array(fc.string(), { minLength: 1, maxLength: 10 }),
  fc.nat(),
  (images, slideRaw) => {
    const slide = slideRaw % images.length;
    const { container } = render(<HeroSection heroImages={images} currentSlide={slide} onPrev={noop} onNext={noop} navigate={noop} />);
    const dots = container.querySelectorAll('.hero-dot');
    const activeDots = container.querySelectorAll('.hero-dot--active');
    return dots.length === images.length && activeDots.length === 1;
  }
), { numRuns: 100 });

// Feature: homepage-hero-redesign, Property 4: CTA buttons call navigate with correct paths
fc.assert(fc.property(
  fc.constant(null), // no varying input needed; navigate mock captures calls
  () => {
    const calls: string[] = [];
    const mockNavigate = (path: string) => calls.push(path);
    const { getByText } = render(<HeroSection heroImages={['img1']} currentSlide={0} onPrev={noop} onNext={noop} navigate={mockNavigate} />);
    fireEvent.click(getByText('Explore Academics'));
    fireEvent.click(getByText('Latest News'));
    return calls[0] === '/academics/medicine/overview' && calls[1] === '/latests/news';
  }
), { numRuns: 100 });
```

### Property-Based Testing Library

**fast-check** (`npm install --save-dev fast-check`) — the standard PBT library for TypeScript. Works with Vitest (already used in the project via Vite).

Each property test must run a minimum of **100 iterations** (`numRuns: 100`).
