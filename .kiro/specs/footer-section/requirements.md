# Requirements Document

## Introduction

This feature adds a site-wide Footer section to the SPHMMC website. The footer displays three content columns — Contact Us, About Us, and Quick Links — and is rendered on every page of the React/TypeScript frontend. All footer content (social media links, contact details, physical location, and quick links) is managed by administrators through the existing Laravel admin panel and served to the frontend via a dedicated REST API. The implementation must not break or alter any existing sections of the site.

## Glossary

- **Footer**: The persistent bottom section rendered on every page of the SPHMMC website.
- **Footer_API**: The Laravel REST API endpoint that returns the current footer configuration as JSON.
- **Admin_Panel**: The existing Laravel-based administration interface at `/admin`.
- **FooterData**: The JSON structure returned by Footer_API containing contact info, social links, location, about links, and quick links.
- **Social_Link**: A record containing a platform name, URL, and display order for a social media channel.
- **Quick_Link**: A record containing a label, URL, and display order for a quick-access navigation item.
- **Contact_Section**: The footer column displaying social media links, email address, and physical location.
- **About_Section**: The footer column displaying navigational links to About Us, Gallery, and Leaders pages.
- **QuickLinks_Section**: The footer column displaying configurable quick-access links.
- **Footer_Component**: The React/TypeScript component rendered at the bottom of every page.

---

## Requirements

### Requirement 1: Footer Component Rendering

**User Story:** As a site visitor, I want to see a consistent footer on every page of the SPHMMC website, so that I always have access to contact information and key navigation links regardless of which page I am viewing.

#### Acceptance Criteria

1. THE Footer_Component SHALL be rendered at the bottom of every page route defined in the React application.
2. THE Footer_Component SHALL display three columns: Contact_Section, About_Section, and QuickLinks_Section.
3. THE Footer_Component SHALL display the SPHMMC institution name and a copyright notice.
4. WHEN the Footer_API returns valid FooterData, THE Footer_Component SHALL render content from FooterData.
5. IF the Footer_API request fails, THEN THE Footer_Component SHALL render a static fallback with default contact information, about links, and quick links so the footer remains visible.
6. WHILE the Footer_API response is loading, THE Footer_Component SHALL display a skeleton or placeholder that preserves the footer layout.

---

### Requirement 2: Contact Us Section

**User Story:** As a site visitor, I want to see SPHMMC's contact details in the footer, so that I can reach the institution through social media, email, or by visiting in person.

#### Acceptance Criteria

1. THE Contact_Section SHALL display social media icons and links for the following platforms: LinkedIn, Facebook, YouTube, Telegram, TikTok, and Instagram.
2. WHEN a social media URL is empty or null in FooterData, THE Contact_Section SHALL hide that platform's icon and link.
3. THE Contact_Section SHALL display the institutional email address from FooterData.
4. THE Contact_Section SHALL display the physical location of SPHMMC from FooterData.
5. WHEN a visitor clicks a social media link, THE Footer_Component SHALL open that link in a new browser tab.
6. WHEN a visitor clicks the email address, THE Footer_Component SHALL open the default mail client with the address pre-populated.

---

### Requirement 3: About Us Section

**User Story:** As a site visitor, I want to see navigational links to key About section pages in the footer, so that I can quickly access information about the institution.

#### Acceptance Criteria

1. THE About_Section SHALL display a link to the About Us page (`/about`).
2. THE About_Section SHALL display a link to the Gallery page (`/gallery`).
3. THE About_Section SHALL display a link to the Leaders page (`/about/leaders/provost`).
4. WHEN a visitor clicks any About_Section link, THE Footer_Component SHALL navigate to the corresponding internal route without a full page reload.

---

### Requirement 4: Quick Links Section

**User Story:** As a site visitor, I want to see a set of quick-access links in the footer, so that I can navigate directly to frequently visited sections of the site.

#### Acceptance Criteria

1. THE QuickLinks_Section SHALL display quick links fetched from FooterData.
2. THE Footer_Component SHALL display quick links in ascending sort order as defined by each Quick_Link record's display order value.
3. WHEN FooterData contains no Quick_Link records, THE QuickLinks_Section SHALL display a default set of links: Health Tips (`/health/tips`), Specialized Centers (`/centers/specialized`), Library (`/offices/library`), and Portal.
4. WHEN a visitor clicks a quick link, THE Footer_Component SHALL navigate to the link's configured URL.

---

### Requirement 5: Admin Panel — Footer Management

**User Story:** As an administrator, I want a dedicated Footer section in the admin panel sidebar, so that I can manage all footer content from a single location.

#### Acceptance Criteria

1. THE Admin_Panel SHALL display a "Footer" entry in the sidebar navigation under a clearly labelled section.
2. WHEN an administrator clicks the Footer sidebar entry, THE Admin_Panel SHALL display the footer management page.
3. THE Admin_Panel footer management page SHALL allow administrators to update the institutional email address.
4. THE Admin_Panel footer management page SHALL allow administrators to update the physical location text.
5. THE Admin_Panel footer management page SHALL allow administrators to add, edit, reorder, and delete Social_Link records.
6. THE Admin_Panel footer management page SHALL allow administrators to add, edit, reorder, and delete Quick_Link records.
7. WHEN an administrator saves footer changes, THE Admin_Panel SHALL display a success message confirming the update.
8. IF saving footer changes fails due to a server error, THEN THE Admin_Panel SHALL display a descriptive error message without losing the administrator's unsaved input.

---

### Requirement 6: Footer API Endpoint

**User Story:** As a frontend developer, I want a single API endpoint that returns all footer content, so that the Footer_Component can fetch everything it needs in one request.

#### Acceptance Criteria

1. THE Footer_API SHALL expose a `GET /api/footer` endpoint that returns FooterData as a JSON object.
2. THE Footer_API SHALL return FooterData containing: email, location, an array of Social_Link records, an array of Quick_Link records, and the about links configuration.
3. WHEN the footer data has not been configured by an administrator, THE Footer_API SHALL return a response containing sensible default values so the frontend always receives a valid FooterData object.
4. THE Footer_API SHALL respond with HTTP 200 and a JSON body structured as `{ "success": true, "data": FooterData }` on success.
5. IF a database error occurs, THEN THE Footer_API SHALL return HTTP 500 with `{ "success": false, "message": "..." }`.

---

### Requirement 7: Non-Interference with Existing Sections

**User Story:** As a developer, I want the footer implementation to be fully isolated, so that it does not break or alter any existing functionality of the website.

#### Acceptance Criteria

1. THE Footer_Component SHALL be added to the existing React application without modifying any existing page component, route, or shared component other than the root `App.tsx` render output.
2. THE Footer_API database migration SHALL create new tables and SHALL NOT modify any existing database table.
3. THE Admin_Panel Footer sidebar entry SHALL be added to the existing layout template without removing or reordering any existing sidebar items.
4. WHEN the Footer_Component is rendered, THE Footer_Component SHALL not alter the layout, styling, or behaviour of any other component on the page.
