# Manual Migration Execution Guide

Since PowerShell is not available in this environment, here are multiple ways to run the migration:

## Option 1: Using PHP CLI Directly

From your project root (C:\Users\tesfa\Desktop\allprojects\F_sphMmc\), open Command Prompt and run:

```cmd
cd BsphMmc
php artisan migrate --step
```

## Option 2: Using Web Server

1. Place a migration runner file in your public directory:

```php
<?php
// public/migrate.php
chdir(__DIR__ . '/..');
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArrayInput(['command' => 'migrate', '--step']),
    $output = new Symfony\Component\Console\Output\BufferedOutput()
);
echo '<pre>';
echo $output->fetch();
echo '</pre>';
exit($status);
?>
```

2. Visit: `http://yoursite/migrate.php`

## Option 3: Using Tinker

From BsphMmc directory:

```cmd
php artisan tinker
```

Then in Tinker shell:

```php
>>> Artisan::call('migrate --step')
```

## Option 4: Direct Database Query

If migrations fail, you can manually create the tables using raw SQL in your database client:

The migration file is located at:
`BsphMmc/database/migrations/2026_05_28_000001_create_role_responsibility_tables.php`

View it to see all CREATE TABLE statements and execute them in your database.

## Verification After Migration

After running the migration, verify the tables were created:

```cmd
php artisan tinker
>>> DB::table('role_responsibility_contents')->count()
>>> DB::table('role_responsibility_categories')->count()
>>> DB::table('role_responsibility_contacts')->count()
```

All should return 0 (empty tables) which is correct.

## Check Migration Status

```cmd
php artisan migrate:status
```

Should show the 2026_05_28_000001_create_role_responsibility_tables migration as "Ran".

## If Migration Fails

### Error: "Table already exists"
The tables may have been created in a previous run. This is safe to ignore. Check:
```cmd
php artisan migrate:status
```

### Error: "Syntax error in migration"
This shouldn't happen, but if it does:
1. Check the migration file for syntax errors
2. Ensure all closing semicolons and parentheses are present
3. Try rolling back: `php artisan migrate:rollback --step=1`

### Error: "SQLSTATE[HY000]: General error"
Usually a database connection issue:
1. Verify .env file has correct DB credentials
2. Test database connection in Tinker: `>>> DB::connection()->getPdo()`
3. Ensure Laravel cache is cleared: `php artisan cache:clear`

## Testing API After Migration

Once migration is complete, test the API:

```cmd
# Get all data
curl http://localhost:8000/api/research/roles-responsibility/all

# Get specific sections
curl http://localhost:8000/api/research/roles-responsibility/hero
curl http://localhost:8000/api/research/roles-responsibility/categories
curl http://localhost:8000/api/research/roles-responsibility/faqs
```

All should return empty arrays (since no data has been added yet) but with proper structure.

## Testing Admin Panel

After migration succeeds:

1. Navigate to: `http://yoursite/admin/research/roles-responsibility/`
2. You should see the admin dashboard
3. Click "Edit Hero Section"
4. Add some content and save
5. Click "Add Category"
6. Create a category

## Troubleshooting Check List

- ✅ Is php.exe in your PATH?
- ✅ Is your .env file configured correctly?
- ✅ Does the database exist?
- ✅ Can you connect to the database?
- ✅ Are the migration files readable?
- ✅ Is artisan executable?

```cmd
# Test PHP
php -v

# Test Artisan
php artisan --version

# Test database connection
php artisan tinker
>>> DB::connection()->getPdo()
```

## Final Step: Add Sample Data

After migration and verification, add some sample data via the admin panel:

1. Go to `/admin/research/roles-responsibility/`
2. Edit Hero Section
3. Enter:
   - Title: "Roles and Responsibilities"
   - Subtitle: "Research Excellence through Clear Roles"
4. Click Save
5. Add categories, processes, FAQs, etc.

Then visit `/research/roles-responsibilities` to see the page!

## Additional Resources

- Migration file: `BsphMmc/database/migrations/2026_05_28_000001_create_role_responsibility_tables.php`
- API Controller: `BsphMmc/app/Http/Controllers/ResearchRolesResponsibilityApiController.php`
- Admin Controller: `BsphMmc/app/Http/Controllers/Admin/ResearchRolesResponsibilityAdminController.php`
- Frontend: `sphMmc/src/research/RolesResponsibilities.tsx`
- Styles: `sphMmc/src/research/RolesResponsibilities.css`

---

**Status**: Ready for manual migration execution
**Last Updated**: 2026-05-28
