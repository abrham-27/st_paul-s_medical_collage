#!/bin/bash
# Master script to fix routing and create database tables

echo "=========================================="
echo "Fixing Roles & Responsibility Module"
echo "=========================================="
echo ""

cd "$(dirname "$0")"

# Fix frontend routing
echo "Step 1: Fixing frontend routing..."
php fix_frontend_routing.php
if [ $? -ne 0 ]; then
    echo "Failed to fix frontend routing"
    exit 1
fi

echo ""
echo "Step 2: Creating database tables..."
php migrate_tables.php
if [ $? -ne 0 ]; then
    echo "Failed to create database tables"
    exit 1
fi

echo ""
echo "=========================================="
echo "✓ All fixes completed successfully!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Restart your development server (npm run dev in sphMmc/)"
echo "2. Restart Laravel (php artisan serve in BsphMmc/)"
echo "3. Visit http://localhost:5173/research/roles-responsibilities"
echo "4. Visit admin panel to manage content"
