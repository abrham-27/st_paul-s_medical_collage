# Database Setup Instructions for Roles & Responsibility Module

The database tables for the Roles & Responsibility module need to be created before the admin panel can function. Follow one of these methods:

## Method 1: Via Web Browser (Easiest)

1. **Start your Laravel application** (if not already running):
   - Open a terminal/command prompt in the `BsphMmc` directory
   - Run: `php artisan serve`
   - This will start the application at `http://localhost:8000`

2. **Navigate to the setup page**:
   - Open your browser and go to: **http://localhost:8000/setup-tables**
   - The page will automatically create all required database tables
   - You should see a green success message

3. **Access the admin panel**:
   - Go to: **http://localhost:8000/admin**
   - Login with your admin credentials
   - Navigate to: **Research → Roles & Responsibility**
   - Everything should now work!

## Method 2: Via PHP CLI

If you prefer to run this from the command line:

1. **Navigate to the project root**:
   ```bash
   cd C:\Users\tesfa\Desktop\allprojects\F_sphMmc
   ```

2. **Run the setup script**:
   ```bash
   php setup_role_responsibility_tables.php
   ```

3. **You should see output** showing all tables created:
   ```
   ✓ role_responsibility_content
   ✓ role_responsibility_categories
   ✓ role_responsibility_processes
   ✓ role_responsibility_policies
   ✓ role_responsibility_faqs
   ✓ role_responsibility_statistics
   ✓ role_responsibility_contact
   ```

## Method 3: Via PHP Artisan (After Laravel Setup)

If you have a proper Laravel Artisan command, you can run:

```bash
php artisan migrate
```

This will execute the migration file at:
`BsphMmc/database/migrations/2026_05_28_000001_create_role_responsibility_tables.php`

## Tables Created

The following 7 tables will be created:

- **role_responsibility_content** - Hero and overview section content
- **role_responsibility_categories** - Responsibility categories with detailed content
- **role_responsibility_processes** - Workflow/process steps
- **role_responsibility_policies** - Policy documents and guidelines
- **role_responsibility_faqs** - Frequently asked questions
- **role_responsibility_statistics** - Statistics and highlight counters
- **role_responsibility_contact** - Contact information

## Troubleshooting

### Error: "Table already exists"
This is fine! The script checks for existing tables and won't overwrite them.

### Error: "Database connection failed"
Make sure:
- MySQL server is running
- Database name matches the .env file (default: `sphmmc_db`)
- Database username/password are correct in .env

### Error: "Permission denied"
The script needs to write to the database. Make sure:
- Your MySQL user has `CREATE TABLE` permissions
- Your MySQL user has permissions on the `sphmmc_db` database

## Next Steps

Once the tables are created:

1. **Access the admin panel**: http://localhost:8000/admin
2. **Navigate to Research section** in the sidebar
3. **Click on "Roles & Responsibility"**
4. **Start adding content**:
   - Hero Section
   - Overview
   - Categories
   - Process Steps
   - Policies & Documents
   - FAQs
   - Statistics
   - Contact Information

The frontend page will automatically pull this data from the database and display it at: **http://localhost:8000/research/roles-and-responsibility**

---

Need help? Check that:
- Laravel is running (`php artisan serve`)
- The `/setup-tables` route is accessible
- MySQL server is running
- `.env` file has correct database credentials
