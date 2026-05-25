# Implementation Plan: Homepage Hero Redesign

## Overview

Replace the fixed full-viewport `.hero-aau` carousel with a stateless `HeroSection` component featuring a two-column layout (ContentPanel + OvalSlider). State ownership stays in `App.tsx`; `HeroSection` receives all data and handlers as props.

## Tasks

- [x] 1. Install fast-check and create the HeroSection component file
  - Run `npm install --save-dev fast-check` inside `sphMmc/`
  - Create `sphMmc/src/components/HeroSection.tsx` with the `HeroSectionProps` interface and component skeleton
  - Define `FEATURE_HIGHLIGHTS` static array inside the component file
  - Export the component as a named default export
  - _Requirements: 6.1, 6.2_

- [x] 2. Implement the ContentPanel markup and static content
  - [x] 2.1 Render the subtitle, heading, description, and feature highlights
    - Add `<span className="hero-subtitle">Excellence in Medical Education</span>`
    - Add `<h1 className="hero-heading">` with `clamp(2rem, 3vw, 3.5rem)` sizing via CSS
    - Add description `<p>` (≤ 3 sentences)
    - Map `FEATURE_HIGHLIGHTS` to `<ul className="hero-features">` with icon + label `<li>` items
    - _Requirements: 2.1, 2.2, 2.3, 2.4_

  - [x] 2.2 Render the CTA buttons
    - Add `<button className="hero-btn hero-btn--primary">Explore Academics</button>` calling `navigate('/academics/medicine/overview')`
    - Add `<button className="hero-btn hero-btn--secondary">Latest News</button>` calling `navigate('/latests/news')`
    - _Requirements: 2.5, 2.6_

  - [ ]* 2.3 Write unit tests for ContentPanel static content
    - Verify subtitle text "Excellence in Medical Education" is present
    - Verify heading "St. Paul's Hospital Millennium Medical College" is present
    - Verify exactly 4 feature highlight items are rendered
    - Verify "Explore Academics" and "Latest News" button labels are present
    - _Requirements: 2.1, 2.2, 2.4, 2.5, 2.6_

- [x] 3. Implement the OvalSlider markup
  - [x] 3.1 Render the image stack and empty-array guard
    - Use `hasImages` guard: render `.hero-oval-placeholder` div when `heroImages` is empty
    - Map `heroImages` to absolutely-stacked `<img>` elements with `hero-oval-img` class
    - Apply `hero-oval-img--active` class when `idx === currentSlide`
    - Add `.hero-oval-overlay` gradient div inside the oval
    - _Requirements: 1.1, 1.2, 1.8, 6.7_

  - [x] 3.2 Render navigation arrows and pagination dots
    - Add `<button className="hero-arrow hero-arrow--prev">` on `.hero-oval-wrapper` calling `onPrev`
    - Add `<button className="hero-arrow hero-arrow--next">` on `.hero-oval-wrapper` calling `onNext`
    - Map `heroImages` to `<span className="hero-dot">` elements; apply `hero-dot--active` when `idx === currentSlide`
    - _Requirements: 1.4, 1.5, 1.6_

  - [ ]* 3.3 Write property test — Property 1: active image class applied to exactly one image
    - **Property 1: Active image class is applied to exactly one image**
    - **Validates: Requirements 1.2**
    - Use `fc.array(fc.string(), { minLength: 1, maxLength: 10 })` and `fc.nat()` for inputs
    - Assert exactly one `.hero-oval-img--active` element exists and matches `heroImages[currentSlide]`
    - `numRuns: 100`

  - [ ]* 3.4 Write property test — Property 3: dot count matches image count with exactly one active dot
    - **Property 3: Dot count matches image count with exactly one active dot**
    - **Validates: Requirements 1.6**
    - Use `fc.array(fc.string(), { minLength: 1, maxLength: 10 })` and `fc.nat()` for inputs
    - Assert `.hero-dot` count equals `heroImages.length` and exactly one `.hero-dot--active` exists
    - `numRuns: 100`

  - [ ]* 3.5 Write property test — Property 4: CTA buttons call navigate with correct paths
    - **Property 4: CTA buttons call navigate with the correct paths**
    - **Validates: Requirements 2.5, 2.6**
    - Use a mock `navigate` that captures calls; click both buttons and assert paths
    - Assert first call is `/academics/medicine/overview` and second is `/latests/news`
    - `numRuns: 100`

- [x] 4. Checkpoint — Ensure all tests pass
  - Ensure all tests pass, ask the user if questions arise.

- [x] 5. Add all hero CSS to App.css
  - [x] 5.1 Remove the old `.hero-aau` block and its child rules
    - Delete `.hero-aau`, `.hero-slide`, `.hero-overlay`, `.hero-text-content`, `.hero-btns` blocks
    - Delete the old `.hero-dots` and `.hero-dot` rules (scoped to the old fixed hero)
    - _Requirements: 6.6_

  - [x] 5.2 Update `.main-content` padding-top
    - Change `padding-top: calc(100vh - 100px + 52px)` to `padding-top: 0`
    - _Requirements: 3.5, 6.6_

  - [x] 5.3 Add hero layout and animation CSS
    - Add `.hero-section` grid (`55fr 45fr`), gradient background, `min-height: 560px`
    - Add `@keyframes hero-fade-in-up` (0.7s) and `@keyframes hero-float` (4s infinite, ≤10px)
    - Apply `hero-fade-in-up` to `.hero-content-panel` and `hero-float` to `.hero-oval-wrapper`
    - _Requirements: 4.1, 5.1, 5.3, 5.4_

  - [x] 5.4 Add OvalSlider CSS
    - Add `.hero-oval-slider` with `width: 420px; height: 520px; border-radius: 50%; overflow: hidden`
    - Add `.hero-oval-img` with `opacity: 0; transition: opacity 1.0s ease-in-out` and `.hero-oval-img--active` with `opacity: 1`
    - Add `.hero-oval-overlay` radial gradient, `.hero-oval-placeholder` navy background
    - Add `.hero-arrow` base, `--prev` (`left: -24px`), `--next` (`right: -24px`), and hover styles
    - Add `.hero-dots` flex row and `.hero-dot` / `.hero-dot--active` styles
    - _Requirements: 1.1, 1.2, 1.7, 4.4, 5.2_

  - [x] 5.5 Add ContentPanel CSS
    - Add `.hero-subtitle`, `.hero-heading` (`clamp(2rem, 3vw, 3.5rem)`, `--font-serif`), `.hero-description`
    - Add `.hero-features` 2×2 grid and `.hero-feature-item` / `.hero-feature-icon` styles
    - Add `.hero-cta-group`, `.hero-btn`, `.hero-btn--primary`, `.hero-btn--secondary` with hover transitions
    - _Requirements: 2.1, 2.2, 2.7, 4.2, 4.3, 5.2_

  - [x] 5.6 Add responsive breakpoints
    - Add `@media (max-width: 1023px)` — single column, oval `320×400px`
    - Add `@media (max-width: 767px)` — centered text, stacked CTAs, oval `min(80vw, 300px)`
    - _Requirements: 3.1, 3.2, 3.3, 3.4_

- [x] 6. Wire HeroSection into App.tsx
  - [x] 6.1 Add onPrev and onNext handlers in App.tsx
    - Add `handlePrev` using `(prev - 1 + heroImages.length) % heroImages.length`
    - Add `handleNext` using `(prev + 1) % heroImages.length`
    - _Requirements: 1.4, 1.5, 6.4_

  - [x] 6.2 Update HomeProps and Home component
    - Add `onPrev: () => void` and `onNext: () => void` to `HomeProps` interface
    - Import `HeroSection` from `./components/HeroSection`
    - Replace `<section className="hero-aau">…</section>` with `<HeroSection heroImages={heroImages} currentSlide={currentSlide} onPrev={onPrev} onNext={onNext} navigate={navigate} />`
    - Pass `onPrev` and `onNext` through from `App` to `Home`
    - _Requirements: 6.3, 6.4, 6.5_

  - [ ]* 6.3 Write property test — Property 2: navigation always stays in bounds
    - **Property 2: Navigation always stays in bounds**
    - **Validates: Requirements 1.4, 1.5**
    - Use `fc.integer({ min: 1, max: 20 })` for N and `fc.nat()` for slide index
    - Assert `(slide - 1 + N) % N` and `(slide + 1) % N` are both in `[0, N-1]`
    - `numRuns: 100`

- [x] 7. Final checkpoint — Ensure all tests pass
  - Ensure all tests pass, ask the user if questions arise.

## Notes

- Tasks marked with `*` are optional and can be skipped for a faster MVP
- All property tests live in `sphMmc/src/components/__tests__/HeroSection.test.tsx`
- `fast-check` must be installed before running property tests: `cd sphMmc && npm install --save-dev fast-check`
- The existing 5-second `setInterval` in `App.tsx` is untouched — it drives `currentSlide` automatically
- The `explore-bar`, `quick-links-bar`, health tips, announcements, doctors sections, and footer are structurally unchanged
