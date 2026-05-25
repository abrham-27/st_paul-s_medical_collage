# Admin Dashboard Setup Guide

## Overview
Professional admin panel for St. Paul's Hospital Millennium Medical College website.

## Features
- ✅ Secure authentication with role-based access (admin/editor/user)
- ✅ Dashboard with statistics and quick actions
- ✅ Posts management (news, announcements, events, documents)
- ✅ Gallery management with image upload
- ✅ Academic programs management
- ✅ Statistics management
- ✅ Profile & password management
- ✅ Dark mode support
- ✅ Responsive mobile-friendly design
- ✅ Modern Tailwind CSS UI with Alpine.js

## Installation Steps

### 1. Run Migrations
```bash
cd BsphMmc
php artisan migrate
```

This will create:
- `role` column in `users` table
- `galleries` table
- `academics` table

### 2. Create Storage Link
```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public` for image uploads.

### 3. Seed Admin User
```bash
php artisan db:seed --class=AdminUserSeeder
```

This creates the first admin user:
- **Email:** admin@sphmmc.edu.et
- **Password:** Admin@123456

⚠️ **IMPORTANT:** Change this password immediately after first login!

### 4. (Optional) Seed Sample Data
```bash
php artisan db:seed --class=StatisticSeeder
php artisan db:seed --class=LatestPostSeeder
```

## Access the Admin Panel

### Admin Login
Navigate to: `http://your-domain.com/login`

Use the credentials:
- Email: `admin@sphmmc.edu.et`
- Password: `Admin@123456`

After login, you'll be redirected to `/admin` dashboard.

### Admin Routes
- Dashboard: `/admin`
- Posts: `/admin/posts`
- Gallery: `/admin/gallery`
- Academics: `/admin/academics`
- Statistics: `/admin/statistics`
- Profile: `/admin/profile`

## User Roles

### Admin
- Full access to all features
- Can create, edit, delete all content
- Access to all admin routes

### Editor
- Can create and edit content
- Cannot delete content (can be customized)
- Access to admin routes

### User
- Regular website user
- No admin access

## Creating Additional Admin Users

### Via Tinker
```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Editor Name',
    'email' => 'editor@sphmmc.edu.et',
    'password' => Hash::make('SecurePassword123'),
    'role' => 'editor'
]);
```

### Via Database
Manually insert into `users` table with `role` set to `'admin'` or `'editor'`.

## File Upload Configuration

### Storage Directories
Images are stored in:
- Posts: `storage/app/public/posts/`
- Gallery: `storage/app/public/gallery/`
- Academics: `storage/app/public/academics/`

### Upload Limits
Default limits (can be adjusted in controllers):
- Post images: 2MB
- Gallery images: 4MB per image
- Academic images: 2MB

### Adjusting PHP Upload Limits
Edit `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

## Security Features

### Middleware Protection
- All admin routes protected by `auth` and `admin` middleware
- Non-admin users get 403 Forbidden error
- Unauthenticated users redirected to login

### CSRF Protection
- All forms include CSRF tokens
- Laravel's built-in CSRF protection enabled

### Password Requirements
- Minimum 8 characters
- Must be confirmed when changing

## Customization

### Changing Colors
Edit `BsphMmc/resources/views/admin/layouts/app.blade.php`:
- Sidebar: `bg-blue-900` → change to your color
- Buttons: `bg-blue-600` → change to your color

### Adding More Roles
1. Update migration: `2026_04_27_000001_add_role_to_users_table.php`
2. Add role to enum: `enum('role', ['admin', 'editor', 'user', 'your_role'])`
3. Update `IsAdmin` middleware logic if needed

### Adding Rich Text Editor
Install a package like TinyMCE or CKEditor:

```bash
npm install tinymce
```

Then integrate in post create/edit forms.

## Troubleshooting

### Images Not Displaying
```bash
php artisan storage:link
```

### Permission Denied Errors
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Can't Access Admin Panel
1. Check if user has `role` = `'admin'` or `'editor'`
2. Clear cache: `php artisan cache:clear`
3. Check middleware is registered in `app/Http/Kernel.php`

### 404 on Admin Routes
```bash
php artisan route:clear
php artisan route:cache
```

## Production Deployment

### Before Deploying
1. Change admin password
2. Set `APP_ENV=production` in `.env`
3. Set `APP_DEBUG=false` in `.env`
4. Run `php artisan config:cache`
5. Run `php artisan route:cache`
6. Run `php artisan view:cache`

### Security Checklist
- ✅ Strong admin passwords
- ✅ HTTPS enabled
- ✅ Database credentials secured
- ✅ `.env` file not in version control
- ✅ File upload validation enabled
- ✅ CSRF protection enabled

## API Integration

The existing API routes (`/api/latest-posts`, `/api/statistics`) remain unchanged and work alongside the admin panel.

## Support

For issues or questions:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Enable debug mode temporarily: `APP_DEBUG=true`
3. Check browser console for JavaScript errors

## Tech Stack

- **Backend:** Laravel 10
- **Frontend:** Blade Templates
- **CSS:** Tailwind CSS
- **JavaScript:** Alpine.js
- **Icons:** Font Awesome 6
- **Authentication:** Laravel Breeze

---

**Built for St. Paul's Hospital Millennium Medical College**
