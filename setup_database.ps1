#!/usr/bin/env pwsh
# Role Responsibility Module Database Setup Script
# PowerShell version

Write-Host ""
Write-Host "======================================" -ForegroundColor Cyan
Write-Host "Role Responsibility Module Setup" -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan
Write-Host ""

# Check if PHP is installed
try {
    $phpVersion = php -v 2>$null
    if ($LASTEXITCODE -eq 0) {
        Write-Host "PHP found: OK" -ForegroundColor Green
    } else {
        throw "PHP not found"
    }
} catch {
    Write-Host "Error: PHP is not installed or not in PATH" -ForegroundColor Red
    Write-Host "Please ensure PHP is installed and accessible from PowerShell" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host ""

# Get the script directory
$scriptDir = Split-Path -Parent -Path $MyInvocation.MyCommand.Definition
Set-Location $scriptDir

Write-Host "Executing database setup script..." -ForegroundColor Yellow
Write-Host ""

# Run the PHP setup script
& php setup_role_responsibility_tables.php

if ($LASTEXITCODE -ne 0) {
    Write-Host ""
    Write-Host "Setup failed! Please check the errors above." -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host ""
Write-Host "======================================" -ForegroundColor Green
Write-Host "Setup Completed Successfully!" -ForegroundColor Green
Write-Host "======================================" -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Start Laravel: php artisan serve (in BsphMmc directory)" -ForegroundColor White
Write-Host "2. Access Admin: http://localhost:8000/admin" -ForegroundColor White
Write-Host "3. Navigate to: Research > Roles & Responsibility" -ForegroundColor White
Write-Host ""
Read-Host "Press Enter to exit"
