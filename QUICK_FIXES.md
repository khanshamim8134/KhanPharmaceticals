# Quick Troubleshooting Guide

## Common Issues & Solutions

### ❌ Issue: "Network error: Make sure you are running a local server"

**Solution:**
1. Make sure you're accessing via `http://localhost:8000/Project.html`
2. NOT via `file:///d:/Projects/...`
3. Start the server first:
   ```powershell
   cd "d:\Projects\Shamim vai"
   php -S localhost:8000
   ```

---

### ❌ Issue: "Database connection failed"

**Solution:**
1. Check if MySQL is running (XAMPP Control Panel → MySQL → Start)
2. Create database if it doesn't exist:
   - Open phpMyAdmin
   - Run SQL from `database_setup.sql`
3. Verify credentials in `config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');  // Change if you have a password
   define('DB_NAME', 'khan_pharmaceuticals');
   ```

---

### ❌ Issue: "Email already registered"

**Solution:**
- This means the email is already in the database
- Use a different email or login with existing credentials
- To reset: Delete user from phpMyAdmin → users table

---

### ❌ Issue: Login redirects but shows blank page

**Solution:**
1. Make sure `dashboard.php` exists
2. Check browser console (F12) for errors
3. Verify session is working:
   - Login should redirect to `dashboard.php` (not dashboard.html)

---

### ❌ Issue: "php is not recognized"

**Solution:**
1. Install XAMPP from https://www.apachefriends.org
2. Add PHP to system PATH:
   - Windows: `C:\xampp\php`
3. Or use XAMPP's Apache server instead

---

### ❌ Issue: Forms not submitting

**Solution:**
1. Check browser console (F12) for JavaScript errors
2. Make sure JavaScript files are loaded:
   - `signup.js` for signup page
   - `login.js` for login page
3. Verify you're using `http://localhost` (not `file://`)

---

### ❌ Issue: Signup works but can't login

**Solution:**
1. Verify email is lowercase (database stores emails in lowercase)
2. Check password is correct (minimum 6 characters)
3. Verify user exists in database:
   - phpMyAdmin → khan_pharmaceuticals → users table

---

### ❌ Issue: Page styling broken

**Solution:**
1. Verify `styl.css` exists in the same folder
2. Check browser console for 404 errors
3. Hard refresh: Ctrl+F5

---

## Quick Verification Steps

1. ✅ **Check Server Running:**
   - Look for terminal showing "Development Server started"
   - Or XAMPP shows Apache (green)

2. ✅ **Check Database:**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Database `khan_pharmaceuticals` should exist
   - Table `users` should exist

3. ✅ **Check Files:**
   - All .php files in project folder
   - All .js files in project folder
   - `styl.css` exists

4. ✅ **Check Access:**
   - URL should be: `http://localhost:8000/Project.html`
   - NOT: `file:///d:/Projects/...`

---

## Still Having Issues?

1. Check `TROUBLESHOOTING.md` for detailed solutions
2. Check `FIX_NETWORK_ERROR.md` for server setup
3. Check `SIGNUP_SETUP_GUIDE.md` for database setup
4. Read `README.md` for complete documentation

---

## Test the System

### Test Signup:
1. Go to http://localhost:8000/signup.html
2. Fill in form with test data
3. Click Sign Up
4. Should see "Account created successfully!"

### Test Login:
1. Go to http://localhost:8000/login.html
2. Enter email and password from signup
3. Click Login
4. Should redirect to dashboard

### Test Logout:
1. From dashboard, click Logout
2. Should redirect to Project.html

---

## Need Help?

All documentation files:
- `README.md` - Complete project overview
- `FIXES_APPLIED.md` - All recent fixes
- `TROUBLESHOOTING.md` - Detailed troubleshooting
- `FIX_NETWORK_ERROR.md` - Server setup guide
- `SIGNUP_SETUP_GUIDE.md` - Authentication setup

**Emergency Reset:**
```sql
-- Run in phpMyAdmin to reset everything
DROP DATABASE IF EXISTS khan_pharmaceuticals;
-- Then run database_setup.sql again
```
