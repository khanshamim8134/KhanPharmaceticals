@echo off
REM Quick Database Verification Script
REM Checks if database and tables exist

echo.
echo ========================================
echo  Database Verification
echo ========================================
echo.

where mysql >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: MySQL not found in PATH
    echo Please install XAMPP or add MySQL to PATH
    pause
    exit /b 1
)

echo Checking database: khan_pharmaceuticals
echo.

mysql -u root --port=3306 -e "USE khan_pharmaceuticals; SELECT 'Database exists!' as Status;" 2>nul

if %ERRORLEVEL% EQU 0 (
    echo ✓ Database found!
    echo.
    echo Tables in database:
    mysql -u root --port=3306 -e "USE khan_pharmaceuticals; SHOW TABLES;"
    echo.
    echo Table details:
    mysql -u root --port=3306 -e "USE khan_pharmaceuticals; SELECT 'Users' as Table_Name, COUNT(*) as Row_Count FROM users UNION ALL SELECT 'Activity Log', COUNT(*) FROM activity_log;"
    echo.
) else (
    echo ✗ Database NOT found!
    echo.
    echo Run setup_database.bat to create the database.
)

echo.
pause
