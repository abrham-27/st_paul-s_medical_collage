# Requirements Document

## Introduction

This feature redesigns the homepage hero section of the SPHMMC (St. Paul's Hospital Millennium Medical College) website. The current full-viewport rectangular sliding carousel (`.hero-aau`) is replaced with a modern two-column layout: descriptive institutional content on the left and an oval/ellipse-shaped image slider on the right. The redesign must be delivered as a reusable `HeroSection` component, integrate with the existing `currentSlide` state and `heroImages` array in `App.tsx`, and preserve all other homepage sections and layout logic.

## Glossary

- **HeroSection**: The new React component (`HeroSection.tsx`) that encapsulates the redesigned hero UI.
- **OvalSlider**: The oval/ellipse-shaped image carousel sub-element within HeroSection.
- **ContentPanel**: The left-side descriptive content area within HeroSection (subtitle, heading, description, feature highlights, CTA buttons).
- **HeroImages**: The array of imported image assets (`paul1.jpg` through `paul10.png`) passed as a prop to HeroSection.
- **CurrentSlide**: The integer index tracking the active slide, managed by `useState` in `App.tsx` and passed as a prop.
- **CTA**: Call-to-action button.
- **CSS Token**: A CSS custom property defined in `index.css` (e.g., `--navy`, `--blue`, `--golden-yellow`, `--white`).
- **ExploreBar**: The fixed bottom bar (`explore-bar` class) that prompts users to scroll down.
- **MainContent**: The `.main-content` wrapper whose `padding-top` creates space for the fixed hero.

---

## Requirements

### Requirement 1: Oval-Shaped Image Slider

**User Story:** As a site visitor, I want to see an elegantly shaped image slider, so that the hero section feels modern and visually distinctive compared to a standard rectangular carousel.

#### Acceptance Criteria

1. THE OvalSlider SHALL display images clipped to an oval/ellipse shape using CSS `clip-path` or `border-radius`.
2. WHEN the active slide index changes, THE OvalSlider SHALL transition between images using a smooth fade or slide CSS animation with a duration between 0.8s and 1.5s.
3. THE OvalSlider SHALL automatically advance to the next image every 5 seconds using the existing interval logic from `App.tsx`.
4. WHEN the user clicks the previous navigation arrow, THE OvalSlider SHALL display the preceding image in the `heroImages` array, wrapping from the first image to the last.
5. WHEN the user clicks the next navigation arrow, THE OvalSlider SHALL display the following image in the `heroImages` array, wrapping from the last image to the first.
6. THE OvalSlider SHALL render one pagination dot per image in `heroImages`, with the dot corresponding to `currentSlide` visually distinguished from inactive dots.
7. WHERE an overlay gradient is applied, THE OvalSlider SHALL render a CSS gradient overlay on top of the image without obscuring the navigation arrows or pagination dots.
8. THE OvalSlider SHALL accept `heroImages` and `currentSlide` as props so that the parent `App.tsx` retains ownership of slide state.

---

### Requirement 2: Institutional Content Panel

**User Story:** As a site visitor, I want to read a clear, professional description of SPHMMC alongside the image slider, so that I immediately understand the institution's identity and can navigate to key areas.

#### Acceptance Criteria

1. THE ContentPanel SHALL display the subtitle text "Excellence in Medical Education" in a visually smaller, accented style above the main heading.
2. THE ContentPanel SHALL display the heading "St. Paul's Hospital Millennium Medical College" using the `--font-serif` token and a large typographic size (`clamp` between 2rem and 3.5rem).
3. THE ContentPanel SHALL display a short professional description paragraph of no more than three sentences describing SPHMMC's mission.
4. THE ContentPanel SHALL render four feature highlight items, each consisting of an icon and a label: "Medical Education", "Clinical Services", "Research & Innovation", and "Community Service".
5. THE ContentPanel SHALL render a primary CTA button labelled "Explore Academics" that navigates to `/academics/medicine/overview` when clicked.
6. THE ContentPanel SHALL render a secondary CTA button labelled "Latest News" that navigates to `/latests/news` when clicked.
7. THE ContentPanel SHALL use only existing CSS tokens (`--navy`, `--blue`, `--golden-yellow`, `--white`) for all color values.

---

### Requirement 3: Two-Column Responsive Layout

**User Story:** As a site visitor on any device, I want the hero section to adapt its layout to my screen size, so that the content and slider are always readable and well-proportioned.

#### Acceptance Criteria

1. WHILE the viewport width is 1024px or greater, THE HeroSection SHALL display ContentPanel and OvalSlider side by side in a two-column CSS Grid or Flexbox layout.
2. WHILE the viewport width is between 768px and 1023px (tablet), THE HeroSection SHALL stack ContentPanel above OvalSlider in a single-column layout with reduced spacing.
3. WHILE the viewport width is below 768px (mobile), THE HeroSection SHALL stack ContentPanel above OvalSlider in a single-column layout with centered text alignment and a responsive oval image that scales to fit the viewport width.
4. THE HeroSection SHALL NOT use any external CSS framework or animation library; all layout and animation SHALL be implemented with plain CSS.
5. THE HeroSection SHALL remain compatible with the existing `.main-content` `padding-top` value so that the page scroll-over effect is preserved.

---

### Requirement 4: Design Style and Visual Theme

**User Story:** As a stakeholder, I want the hero section to reflect a modern, premium medical/academic aesthetic, so that the website conveys professionalism and institutional credibility.

#### Acceptance Criteria

1. THE HeroSection SHALL apply a soft gradient background using the `--navy` and `--blue` CSS tokens or their derived values.
2. THE HeroSection SHALL use `--font-serif` (`Source Serif 4`) for headings and `--font-sans` (`Inter`) for body text and labels, consistent with the existing site typography.
3. THE ContentPanel CTA buttons SHALL have rounded corners (`border-radius` of at least 6px) and use `--navy` or `--golden-yellow` for fill and border colors.
4. THE OvalSlider SHALL be the visual centerpiece of the hero, sized so that its height is at least 400px on desktop viewports.
5. THE HeroSection SHALL NOT introduce any color values outside the defined CSS token set (`--navy`, `--blue`, `--golden-yellow`, `--white`, `--light-grey`).

---

### Requirement 5: CSS Animations

**User Story:** As a site visitor, I want subtle animations on the hero section, so that the page feels polished and engaging without being distracting.

#### Acceptance Criteria

1. WHEN the HeroSection mounts, THE ContentPanel SHALL animate into view using a CSS `@keyframes` fade-in or slide-up animation with a duration between 0.5s and 1s.
2. WHEN the user hovers over a CTA button, THE button SHALL transition its background color or transform property using a CSS `transition` of 0.2s to 0.3s.
3. WHERE a floating animation is applied to the OvalSlider container, THE OvalSlider SHALL use a CSS `@keyframes` animation that gently moves the container vertically by no more than 12px in a continuous loop.
4. THE HeroSection SHALL implement all animations using CSS `@keyframes` and `transition` properties only, with no JavaScript animation libraries or inline style transitions driven by JavaScript.

---

### Requirement 6: Component Architecture and Integration Constraints

**User Story:** As a developer, I want the hero redesign delivered as a self-contained component that slots cleanly into the existing `App.tsx`, so that the rest of the homepage is unaffected.

#### Acceptance Criteria

1. THE HeroSection SHALL be implemented as a named React functional component exported from `sphMmc/src/components/HeroSection.tsx`.
2. THE HeroSection SHALL accept at minimum the following props: `heroImages: string[]`, `currentSlide: number`, `onPrev: () => void`, `onNext: () => void`, and `navigate: (path: string) => void`.
3. WHEN `App.tsx` renders the home route, THE App SHALL replace the existing `<section className="hero-aau">` block with `<HeroSection>` and pass the existing `heroImages`, `currentSlide`, and `navigate` values as props.
4. THE App.tsx `currentSlide` state and 5-second `setInterval` logic SHALL remain in `App.tsx` and SHALL NOT be moved into `HeroSection`.
5. THE existing `explore-bar`, `quick-links-bar`, health tips section, announcements section, doctors section, and footer SHALL remain structurally unchanged in `App.tsx`.
6. THE App.css file SHALL have the existing `.hero-aau` block replaced with new hero styles, while all other CSS rules SHALL remain intact.
7. IF the `heroImages` prop is an empty array, THEN THE HeroSection SHALL render a placeholder background using the `--navy` CSS token without throwing a runtime error.
