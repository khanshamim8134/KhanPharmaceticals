# =====================================================
# KHAN Pharmaceuticals - Database Setup Script (PowerShell)
# Automatically creates database and tables
# =====================================================

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host " KHAN Pharmaceuticals Database Setup" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if MySQL is accessible
$mysqlPath = Get-Command mysql -ErrorAction SilentlyContinue

if (-not $mysqlPath) {
    Write-Host "ERROR: MySQL command not found!" -ForegroundColor Red
    Write-Host ""
    Write-Host "Solutions:" -ForegroundColor Yellow
    Write-Host "1. Make sure XAMPP/WAMP is installed"
    Write-Host "2. Add MySQL to system PATH, example:"
    Write-Host "   - XAMPP: C:\xampp\mysql\bin"
    Write-Host "   - WAMP: C:\wamp64\bin\mysql\mysql8.x.x\bin"
    Write-Host ""
    Write-Host "Or use XAMPP Control Panel to start MySQL and import manually." -ForegroundColor Yellow
    Write-Host ""
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host "[1/4] MySQL found! Checking connection..." -ForegroundColor Green
Write-Host ""

# Test MySQL connection
$testConnection = mysql -u root --port=3306 -e "SELECT 1;" 2>&1

if ($LASTEXITCODE -ne 0) {
    Write-Host "WARNING: Cannot connect with default credentials" -ForegroundColor Yellow
    Write-Host "Attempting connection with password prompt..." -ForegroundColor Yellow
    Write-Host ""
    
    # Prompt for password
    Write-Host "Please enter your MySQL root password when prompted."
    Write-Host "If you don't have a password, just press Enter."
    Write-Host ""
    
    mysql -u root --port=3306 -p < database_complete_setup.sql
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host ""
        Write-Host "[SUCCESS] Database setup completed!" -ForegroundColor Green
        Write-Host ""
        Write-Host "IMPORTANT: Update your config.php with the password you used." -ForegroundColor Yellow
        Write-Host "Open config.php and change:" -ForegroundColor Yellow
        Write-Host "  define('DB_PASSWORD', '');  // to your password" -ForegroundColor Yellow
        Write-Host ""
    } else {
        Write-Host ""
        Write-Host "ERROR: Failed to create database!" -ForegroundColor Red
        Write-Host ""
        Read-Host "Press Enter to exit"
        exit 1
    }
} else {
    Write-Host "[2/4] Connection successful (no password)" -ForegroundColor Green
    Write-Host "[3/4] Creating database and tables..." -ForegroundColor Green
    Write-Host ""
    
    # Execute the SQL file
    mysql -u root --port=3306 < database_complete_setup.sql
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "[4/4] Database setup completed successfully!" -ForegroundColor Green
        Write-Host ""
        Write-Host "========================================" -ForegroundColor Cyan
        Write-Host " Setup Summary" -ForegroundColor Cyan
        Write-Host "========================================" -ForegroundColor Cyan
        Write-Host "Database Name: khan_pharmaceuticals" -ForegroundColor White
        Write-Host "Tables Created:" -ForegroundColor White
        Write-Host "  - users" -ForegroundColor Gray
        Write-Host "  - activity_log" -ForegroundColor Gray
        Write-Host "  - products" -ForegroundColor Gray
        Write-Host "  - orders" -ForegroundColor Gray
        Write-Host "  - sessions" -ForegroundColor Gray
        Write-Host ""
        Write-Host "You can now:" -ForegroundColor Green
        Write-Host "1. Start your PHP server: .\start_server.ps1" -ForegroundColor White
        Write-Host "2. Access the website: http://localhost:8000/Project.html" -ForegroundColor White
        Write-Host "3. Sign up new users: http://localhost:8000/signup.html" -ForegroundColor White
        Write-Host ""
    } else {
        Write-Host "ERROR: Failed to create database!" -ForegroundColor Red
        Write-Host "Please check the error messages above." -ForegroundColor Red
        Write-Host ""
    }
}

# Verify database was created
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Verifying database..." -ForegroundColor Cyan

$verification = mysql -u root --port=3306 -e "USE khan_pharmaceuticals; SHOW TABLES;" 2>&1

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "✓ Database verified successfully!" -ForegroundColor Green
    Write-Host ""
    Write-Host $verification
} else {
    Write-Host ""
    Write-Host "✗ Database verification failed. Please check errors above." -ForegroundColor Red
}

Write-Host ""
Read-Host "Press Enter to exit"
