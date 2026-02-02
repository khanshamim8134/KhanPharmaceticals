@echo off
REM =====================================================
REM KHAN Pharmaceuticals - Database Reset Script
REM WARNING: This will DELETE all data and recreate tables
REM =====================================================

echo.
echo ========================================
echo  DATABASE RESET - WARNING!
echo ========================================
echo.
echo This will:
echo  - DROP the database khan_pharmaceuticals
echo  - DELETE all user accounts
echo  - DELETE all activity logs
echo  - DELETE all data permanently
echo.
echo ========================================
echo.

set /p confirm="Are you sure? Type YES to continue: "

if /i NOT "%confirm%"=="YES" (
    echo.
    echo Reset cancelled.
    pause
    exit /b 0
)

echo.
echo Resetting database...
echo.

where mysql >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: MySQL not found!
    pause
    exit /b 1
)

REM Drop and recreate database
mysql -u root --port=3306 -e "DROP DATABASE IF EXISTS khan_pharmaceuticals;" 2>nul

if %ERRORLEVEL% EQU 0 (
    echo ✓ Old database removed
    echo.
    echo Creating fresh database...
    
    mysql -u root --port=3306 < database_complete_setup.sql
    
    if %ERRORLEVEL% EQU 0 (
        echo.
        echo ✓ Database reset completed successfully!
        echo.
        echo All tables have been recreated.
        echo You can now create new users.
    ) else (
        echo.
        echo ERROR: Failed to create new database
    )
) else (
    echo.
    echo Attempting with password...
    mysql -u root --port=3306 -p -e "DROP DATABASE IF EXISTS khan_pharmaceuticals;"
    mysql -u root --port=3306 -p < database_complete_setup.sql
)

echo.
pause
