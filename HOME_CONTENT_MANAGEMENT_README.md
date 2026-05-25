# Home Content Management Module Documentation

## Overview

The **Home Content Management Module** has been successfully implemented as a new section within the Admin Dashboard. It allows administrators to manage all dynamic homepage content from the backend without modifying the frontend design.

## Module Structure

### Sidebar Navigation

The new module is accessible from the Admin Dashboard sidebar under:
```
Content
  ├── Posts
  ├── Gallery
  └── Home Content (NEW)
       ├── Hero Section
       └── Featured Section
```

## Database Tables

### 1. `home_hero_sections`
Manages the hero section displayed at the top of the homepage.

**Fields:**
- `id` - Primary key
- `title` - Hero section main title
- `subtitle` - Secondary heading text
- `description` - Long-form description text
- `background_image` - Path to background image (storage/app/public/home/hero)
- `side_image` - Path to side/accent image (storage/app/public/home/hero)
- `button_text` - CTA button label
- `button_link` - CTA button destination URL
- `status` - Boolean flag to enable/disable section
- `timestamps` - Created and updated timestamps

**Key Features:**
- Single record design (one hero section at a time)
- Support for background and accent images
- Optional CTA button configuration
- Easy activation/deactivation

### 2. `home_featured_sections`
Manages multiple announcement/featured content slides.

**Fields:**
- `id` - Primary key
- `title` - Slide title
- `subtitle` - Optional secondary title
- `description` - Slide description
- `image` - Path to slide image (storage/app/public/home/featured)
- `button_text` - CTA button text
- `button_link` - CTA button link
- `display_order` - Ordering sequence (0 = first)
- `status` - Boolean flag to activate/deactivate
- `timestamps` - Created and updated timestamps

**Key Features:**
- Multiple slides support
- Flexible ordering system
- Per-slide activation control
- Image storage in dedicated folder

## Admin Views & Controllers

### Hero Section Management

**URL:** `/admin/content/home-content/hero`

**Routes:**
- `GET /admin/content/home-content/hero` - View hero section (index)
- `GET /admin/content/home-content/hero/{hero}/edit` - Edit hero section
- `PUT /admin/content/home-content/hero/{hero}` - Save hero changes
- `POST /admin/content/home-content/hero/{hero}/reset-images` - Remove images

**Features:**
- Live preview of current hero settings
- Background image upload (max 5MB, recommended 1920×1080px)
- Side/accent image upload (max 5MB, recommended 500×500px)
- CTA button text and link configuration
- Status toggle (active/inactive)
- Image reset functionality
- Success notifications

**Controller:** `App\Http\Controllers\Admin\HomeHeroController`

### Featured Section Management

**URL:** `/admin/content/home-content/featured`

**Routes:**
- `GET /admin/content/home-content/featured` - List all slides
- `GET /admin/content/home-content/featured/create` - Create slide form
- `POST /admin/content/home-content/featured` - Store new slide
- `GET /admin/content/home-content/featured/{featured}/edit` - Edit slide
- `PUT /admin/content/home-content/featured/{featured}` - Save slide changes
- `DELETE /admin/content/home-content/featured/{featured}` - Delete slide
- `POST /admin/content/home-content/featured/reorder` - Reorder slides

**Features:**
- Add unlimited slides
- Edit existing slides
- Delete slides with confirmation
- Reorder slides using display_order field
- Activate/deactivate individual slides
- Image upload support (max 5MB, recommended 1200×600px)
- Optional CTA buttons per slide
- Success notifications

**Controller:** `App\Http\Controllers\Admin\HomeFeaturedController`

## Models

### HomeHero Model
```php
App\Models\HomeHero
```
- Table: `home_hero_sections`
- Fillable fields: title, subtitle, description, background_image, side_image, button_text, button_link, status
- Boolean casting for status field

### HomeFeatured Model
```php
App\Models\HomeFeatured
```
- Table: `home_featured_sections`
- Fillable fields: title, subtitle, description, image, button_text, button_link, display_order, status
- Boolean casting for status field
- Scopes:
  - `active()` - Get active slides ordered by display_order
  - `ordered()` - Get all slides ordered by display_order

## File Uploads & Storage

All images are stored in:
```
storage/app/public/home/
  ├── hero/           (hero background and side images)
  └── featured/       (featured slide images)
```

**Image Access:**
```blade
asset('storage/' . $model->image_path)
```

## API Endpoints for Frontend

The module is backend-only and creates the structure for future API endpoints.

**Future API Structure:**
```
GET /api/home/hero              - Get hero section
GET /api/home/featured          - Get active featured slides
```

## Usage Instructions for Admins

### Managing Hero Section

1. Navigate to **Admin Dashboard → Content → Home Content → Hero Section**
2. Review current hero section preview
3. Click **Edit Hero Section**
4. Update:
   - Title and subtitle
   - Description text
   - Background image (upload new or keep existing)
   - Side image (upload new or keep existing)
   - CTA button text and link
   - Status toggle
5. Click **Save Changes**
6. Optionally reset images using **Reset Images** button

### Managing Featured Slides

1. Navigate to **Admin Dashboard → Content → Home Content → Featured Section**
2. To create a slide:
   - Click **Add New Slide**
   - Fill in all details (title, subtitle, description)
   - Upload image
   - Set display order (lower = appears first)
   - Toggle active status
   - Click **Create Slide**
3. To edit a slide:
   - Click the edit icon (pencil) on any slide
   - Update fields as needed
   - Click **Save Changes**
4. To delete a slide:
   - Click the delete icon (trash) on any slide
   - Confirm deletion
5. To reorder slides:
   - Edit a slide and change its display_order number
   - Lower numbers appear first

## Database Migrations

The following migrations have been created and executed:

1. `2026_05_19_000001_create_home_hero_sections_table.php`
   - Creates `home_hero_sections` table
   - Single record for hero section
   - Image paths and CTA configuration

2. `2026_05_19_000002_create_home_featured_sections_table.php`
   - Creates `home_featured_sections` table
   - Supports multiple slides
   - Includes ordering and status fields

## Seeding

A seeder has been created and executed to initialize the HomeHero section with default values.

**Seeder:** `Database\Seeders\HomeHeroSeeder`

Default initial data:
- **Title:** Welcome to SPHMMC
- **Subtitle:** Excellence in Medical Education and Healthcare
- **Button Text:** Learn More
- **Button Link:** /about
- **Status:** Active

## Frontend Integration (Ready)

The backend module is complete and ready for frontend integration. The frontend can fetch data using:

**Example (Blade):**
```blade
@php
    $hero = \App\Models\HomeHero::first();
    $featured = \App\Models\HomeFeatured::active()->get();
@endphp

<h1>{{ $hero->title }}</h1>
<img src="{{ asset('storage/' . $hero->background_image) }}" alt="">

@foreach($featured as $slide)
    <div>{{ $slide->title }}</div>
@endforeach
```

## Security & Validation

- All inputs are validated server-side
- File uploads are restricted to image types
- File size limits enforced (5MB)
- Delete operations require confirmation
- Unauthorized access prevented by middleware
- Image paths properly sanitized

## UI/UX Features

- Modern admin dashboard consistent with existing design
- Dark mode support
- Responsive layout (mobile-friendly)
- Success/error notifications
- Image preview before save
- Confirmation dialogs for destructive actions
- Clear form labels and help text
- Intuitive navigation

## Notes

- ✅ No existing modules were modified
- ✅ No frontend design changes
- ✅ Backend-only implementation
- ✅ Follows existing code patterns and conventions
- ✅ Professional admin forms with validation
- ✅ Full CRUD operations for featured slides
- ✅ Single editable hero section
- ✅ Image storage configured properly
- ✅ Database tables created and indexed

## Support for Future Development

The module is structured to easily support:
- REST API endpoints
- Webhook integrations
- Scheduled content
- A/B testing fields
- Analytics tracking
- Multi-language support

---

**Module Created:** May 19, 2026
**Status:** ✅ Complete and Ready for Use
