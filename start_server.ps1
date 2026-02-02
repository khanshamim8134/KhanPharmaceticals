# Start PHP Local Server for KHAN Pharmaceuticals
# Run this in PowerShell

Write-Host "========================================"
Write-Host "KHAN Pharmaceuticals - Local Server"
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if PHP is available
try {
    $phpVersion = php -v 2>$null
    if ($LASTEXITCODE -ne 0) {
        throw "PHP not found"
    }
} catch {
    Write-Host "ERROR: PHP is not installed or not in PATH" -ForegroundColor Red
    Write-Host ""
    Write-Host "Solutions:" -ForegroundColor Yellow
    Write-Host "1. Install XAMPP from https://www.apachefriends.org"
    Write-Host "2. Or install PHP from https://www.php.net/downloads"
    Write-Host "3. Add PHP to your system PATH"
    Write-Host ""
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host "PHP found! Starting local server..." -ForegroundColor Green
Write-Host ""
Write-Host "Server starting on: http://localhost:8000" -ForegroundColor Cyan
Write-Host ""
Write-Host "Your website:      http://localhost:8000/Project.html" -ForegroundColor Yellow
Write-Host "Sign Up Page:      http://localhost:8000/signup.html" -ForegroundColor Yellow
Write-Host "Setup Check:       http://localhost:8000/setup_check.html" -ForegroundColor Yellow
Write-Host ""
Write-Host "Press CTRL+C to stop the server" -ForegroundColor Yellow
Write-Host ""

# Start PHP built-in server
php -S localhost:8000

Read-Host "Press Enter to exit"
