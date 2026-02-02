@echo off
REM Start PHP Local Server for KHAN Pharmaceuticals
REM This script starts a local web server on http://localhost:8000

echo.
echo ========================================
echo KHAN Pharmaceuticals - Local Server
echo ========================================
echo.

REM Check if PHP is available
php -v >nul 2>&1
if errorlevel 1 (
    REM Try XAMPP installation
    if exist "C:\Xampp\php\php.exe" (
        echo Using XAMPP PHP from C:\Xampp
        set PHP_PATH="C:\xampp\php\php.exe"
        goto :start_server
    )
    echo ERROR: PHP is not installed or not in PATH
    echo.
    echo Solutions:
    echo 1. Install XAMPP from https://www.apachefriends.org
    echo 2. Or install PHP from https://www.php.net/downloads
    echo 3. Add PHP to your system PATH
    echo.
    pause
    exit /b 1
) else (
    set PHP_PATH=php
)

:start_server
echo PHP found! Starting local server...
echo.
echo Server starting on: http://localhost:8000
echo.
echo Your website: http://localhost:8000/Project.html
echo Sign Up Page: http://localhost:8000/signup.html
echo Products Page: http://localhost:8000/products.php
echo Setup Check: http://localhost:8000/setup_check.html
echo.
echo Press CTRL+C to stop the server
echo.

REM Start PHP built-in server
%PHP_PATH% -S localhost:8000

pause
