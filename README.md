# KHAN Pharmaceuticals PLC - Project Documentation

## Project Overview
This is a pharmaceutical company website with user authentication system built with HTML, CSS, JavaScript, and PHP.
![image](https://github.com/khanshamim8134/KhanPharmaceticals/blob/main/Screenshot%202026-02-02%20122552.png)
## Recent Fixes and Improvements (January 30, 2026)

### ✅ Fixed Issues

1. **Hardcoded URLs Fixed**
   - Removed all hardcoded `http://127.0.0.1:5500` URLs from:
     - login.html
     - signup.html
     - quality.html
     - career - Copy.html
   - All links now use relative paths for better portability

2. **Missing Files Created**
   - Created `career.html` (was referenced everywhere but didn't exist)
   - File includes Sign Up and Login links in navigation

3. **Database Integration**
   - Updated `signup.js` to use `process_signup.php` (real database) instead of test version
   - Updated `login.js` to redirect to `dashboard.php` instead of non-existent dashboard.html

4. **Session Management**
   - Fixed `process_login.php` to call `session_start()` at the top before any output
   - Properly configured session variables for user authentication

5. **Code Organization**
   - Updated `config.php` with function-based connection (`getDBConnection()`)
   - Both `process_signup.php` and `process_login.php` now use `config.php` instead of duplicate code
   - Eliminated code duplication

6. **Security Improvements**
   - Added security headers to PHP files:
     - X-Content-Type-Options: nosniff
     - X-Frame-Options: DENY
     - X-XSS-Protection: 1; mode=block
   - Added input sanitization with `htmlspecialchars()` for firstName, lastName, company
   - Email addresses converted to lowercase for consistency
   - Password hashing already implemented with `password_hash()`

7. **Navigation and Footer Consistency**
   - Fixed all footer links in:
     - Project.html
     - login.html
     - signup.html
     - dashboard.php
   - All pages now have consistent navigation with proper file paths

8. **Documentation Updates**
   - Updated `FIX_NETWORK_ERROR.md` with correct project path
   - Updated `SIGNUP_SETUP_GUIDE.md` with complete file structure
   - Updated `TROUBLESHOOTING.md` with current configuration

## File Structure

```
Shamim vai/
├── Project.html              Main homepage
├── login.html                User login page
├── signup.html               User registration page
├── dashboard.php             User dashboard (after login)
├── career.html               Career page
├── quality.html              Quality information page
├── contact.html              Contact page
├── 
├── login.js                  Login form handler
├── signup.js                 Signup form handler
├── project.js                Main site JavaScript
├── 
├── process_login.php         Backend login processor
├── process_signup.php        Backend signup processor
├── process_signup_test.php   Test version (no database)
├── logout.php                Logout handler
├── config.php                Database configuration
├── 
├── database_setup.sql        Database schema
├── styl.css                  Main stylesheet
├── style.css                 Additional styles
├── 
├── FIX_NETWORK_ERROR.md      Server setup guide
├── TROUBLESHOOTING.md        Common issues and fixes
├── SIGNUP_SETUP_GUIDE.md     Signup system documentation
├── XAMPP_SETUP.txt           XAMPP installation guide
└── start_server.bat/ps1      Server startup scripts
```

## Database Setup

### Quick Setup (Automatic - Recommended)

**Just run one of these scripts:**
- Double-click **`setup_database.bat`** (Windows)
- Or run **`setup_database.ps1`** (PowerShell)

The script will automatically:
- Create database `khan_pharmaceuticals`
- Create all 5 required tables (users, activity_log, products, orders, sessions)
- Set up indexes for performance
- Verify installation

### Manual Setup (Alternative)

If automatic setup doesn't work:

#### Option 1: Using phpMyAdmin
1. Open http://localhost/phpmyadmin
2. Click "Import" tab
3. Choose file: `database_complete_setup.sql`
4. Click "Go"

#### Option 2: Using MySQL Command Line
CREATE DATABASE IF NOT EXISTS khan_pharmaceuticals;
USE khan_pharmaceuticals;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    userType VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    company VARCHAR(150),
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login DATETIME NULL,
    status VARCHAR(20) DEFAULT 'active'
);
```

### 2. Configure Database Connection
Edit `config.php` if your database credentials are different:

```php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'khan_pharmaceuticals');
```

## Running the Project

### Option 1: Using Built-in PHP Server (Recommended)
```powershell
cd "d:\Projects\Shamim vai"
php -S localhost:8000
```

Then open: http://localhost:8000/Project.html

### Option 2: Using XAMPP
1. Install XAMPP
2. Copy project folder to `C:\xampp\htdocs\`
3. Start Apache and MySQL from XAMPP Control Panel
4. Open: http://localhost/Shamim%20vai/Project.html

### Option 3: Using Start Scripts
Double-click `start_server.bat` or run `.\start_server.ps1`

## Features

- ✅ User Registration with validation
- ✅ User Login with session management
- ✅ User Dashboard
- ✅ Secure password hashing
- ✅ Input sanitization
- ✅ Responsive design
- ✅ Form validation (client and server side)
- ✅ Error handling
- ✅ Session-based authentication
- ✅ Logout functionality

## Security Features

1. **Password Security**
   - Passwords hashed using `password_hash()` with bcrypt
   - Password verification with `password_verify()`
   - Minimum 6 characters required

2. **Input Validation**
   - Email validation
   - XSS protection with `htmlspecialchars()`
   - SQL injection protection with prepared statements
   - CSRF protection via session management

3. **Session Security**
   - Session-based authentication
   - Proper session initialization
   - Session cleanup on logout

4. **HTTP Security Headers**
   - X-Content-Type-Options
   - X-Frame-Options
   - X-XSS-Protection

## Known Configuration

- Database: `khan_pharmaceuticals`
- Default Port: 8000 (for PHP built-in server)
- Default DB User: `root` (no password)

## Testing

### Test User Creation
Use `create_test_user.php` to create a test account

### Test Without Database
Use `process_signup_test.php` for testing signup form without database

## Browser Compatibility

- Chrome (recommended)
- Firefox
- Edge
- Safari

## Support

For issues, check:
1. `TROUBLESHOOTING.md` - Common problems
2. `FIX_NETWORK_ERROR.md` - Server setup issues
3. `SIGNUP_SETUP_GUIDE.md` - Authentication system

## License

© 2025 KHAN Pharmaceuticals PLC. All rights reserved.

