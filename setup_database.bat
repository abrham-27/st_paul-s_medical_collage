@echo off
REM Role Responsibility Module Database Setup Script
REM This batch file creates all required database tables

echo.
echo ======================================
echo Role Responsibility Module Setup
echo ======================================
echo.

REM Check if PHP is installed
php -v >nul 2>&1
if errorlevel 1 (
    echo Error: PHP is not installed or not in PATH
    echo Please ensure PHP is installed and accessible from command line
    pause
    exit /b 1
)

echo PHP found: OK
echo.

REM Change to project root directory
cd /d "%~dp0"

echo Executing database setup script...
echo.

REM Run the PHP setup script
php setup_role_responsibility_tables.php

if errorlevel 1 (
    echo.
    echo Setup failed! Please check the errors above.
    pause
    exit /b 1
)

echo.
echo ======================================
echo Setup Completed Successfully!
echo ======================================
echo.
echo Next steps:
echo 1. Start Laravel: php artisan serve (in BsphMmc directory)
echo 2. Access Admin: http://localhost:8000/admin
echo 3. Navigate to: Research ^> Roles ^& Responsibility
echo.
pause
