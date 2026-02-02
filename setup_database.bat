@echo off
REM =====================================================
REM KHAN Pharmaceuticals - Database Setup Script
REM Automatically creates database and tables
REM =====================================================

echo.
echo ========================================
echo  KHAN Pharmaceuticals Database Setup
echo ========================================
echo.

REM Check if MySQL is accessible
where mysql >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: MySQL command not found!
    echo.
    echo Solutions:
    echo 1. Make sure XAMPP/WAMP is installed
    echo 2. Add MySQL to system PATH, example:
    echo    - XAMPP: C:\xampp\mysql\bin
    echo    - WAMP: C:\wamp64\bin\mysql\mysql8.x.x\bin
    echo.
    echo Or use XAMPP Control Panel to start MySQL and import manually.
    echo.
    pause
    exit /b 1
)

echo [1/4] MySQL found! Checking connection...
echo.

REM Test MySQL connection
mysql -u root --port=3306 -e "SELECT 1;" >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo WARNING: Cannot connect with default credentials
    echo Attempting connection with password prompt...
    echo.
    goto :with_password
)

echo [2/4] Connection successful (no password)
@echo off
REM =====================================================
REM KHAN Pharmaceuticals - Database Setup Script (improved)
REM Auto-detects MySQL (XAMPP/WAMP/MySQL) and imports SQL
REM =====================================================

setlocal enabledelayedexpansion
echo.
echo ========================================
echo  KHAN Pharmaceuticals Database Setup
echo ========================================
echo.

REM Try mysql in PATH first
where mysql >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    set "MYSQL_CMD=mysql"
) else (
    REM Common install locations to check
    set "MYSQL_CMD="

    if exist "C:\xampp\mysql\bin\mysql.exe" set "MYSQL_CMD=C:\xampp\mysql\bin\mysql.exe"

    if not defined MYSQL_CMD (
        for /d %%D in ("C:\wamp64\bin\mysql\mysql*") do (
            if exist "%%~fD\bin\mysql.exe" (
                set "MYSQL_CMD=%%~fD\bin\mysql.exe"
                goto :found_mysql
            )
        )
    )

    if not defined MYSQL_CMD (
        for /d %%D in ("C:\Program Files\MySQL\MySQL Server *") do (
            if exist "%%~fD\bin\mysql.exe" (
                set "MYSQL_CMD=%%~fD\bin\mysql.exe"
                goto :found_mysql
            )
        )
    )

    if not defined MYSQL_CMD (
        for /d %%D in ("C:\Program Files (x86)\MySQL\MySQL Server *") do (
            if exist "%%~fD\bin\mysql.exe" (
                set "MYSQL_CMD=%%~fD\bin\mysql.exe"
                goto :found_mysql
            )
        )
    )

:found_mysql
    if defined MYSQL_CMD (
        echo Found mysql at: %MYSQL_CMD%
    ) else (
        echo ERROR: MySQL command not found!
        echo.
        echo Solutions:
        echo 1. Install XAMPP/WAMP and start MySQL
        echo 2. Add MySQL bin folder to your PATH (example: C:\xampp\mysql\bin)
        echo 3. Or import database_complete_setup.sql via phpMyAdmin
        echo.
        pause
        exit /b 1
    )
)

echo [1/5] MySQL client resolved.
echo.

REM Test MySQL connection (no password)
%MYSQL_CMD% -u root --port=3306 -e "SELECT 1;" >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo WARNING: Cannot connect using root without password.
    echo Will prompt for password and attempt import interactively.
    echo.
    goto :with_password
)

echo [2/5] Connection successful (no password).
echo [3/5] Importing database and tables...
echo.

%MYSQL_CMD% -u root --port=3306 < database_complete_setup.sql
if %ERRORLEVEL% EQU 0 (
    echo [4/5] Database setup completed successfully!
    echo.
    echo ========================================
    echo  Setup Summary
    echo ========================================
    echo Database Name: khan_pharmaceuticals
    echo Tables Created: users, activity_log, products, orders, sessions
    echo.
    echo Next steps:
    echo 1. Start your PHP server: start_server.bat
    echo 2. Access the website: http://localhost:8000/Project.html
    echo 3. Sign up new users: http://localhost:8000/signup.html
    echo.
) else (
    echo ERROR: Failed to import database automatically.
    echo Please check MySQL server status and credentials, then import database_complete_setup.sql manually.
)

goto :verify

:with_password
echo.
echo Please enter your MySQL root password when prompted. If none, just press Enter.
echo.

%MYSQL_CMD% -u root --port=3306 -p < database_complete_setup.sql
if %ERRORLEVEL% EQU 0 (
    echo.
    echo [SUCCESS] Database setup completed with password.
    echo.
    echo IMPORTANT: If you used a root password, update `config.php` define('DB_PASSWORD', 'your_password');
    echo.
) else (
    echo.
    echo ERROR: Failed to create database using provided password.
    echo.
)

:verify
echo ========================================
echo.
echo Verifying database...
%MYSQL_CMD% -u root --port=3306 -e "USE khan_pharmaceuticals; SHOW TABLES;" 2>nul
if %ERRORLEVEL% EQU 0 (
    echo.
    echo ✓ Database verified successfully!
) else (
    echo.
    echo ✗ Database verification failed. Please check errors above.
)

echo.
pause
endlocal
