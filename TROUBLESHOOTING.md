# Sign Up Error Troubleshooting

## Quick Fix - Use Test Version First

If you're getting "An error occurred. Please try again", try this first:

### Step 1: Update signup.html temporarily
Change this line in signup.html (around line 124):
```html
<form id="signupForm" method="POST" action="process_signup.php">
```

To this (if you want to test without database):
```html
<form id="signupForm" method="POST" action="process_signup_test.php">
```

Note: The form is now configured to use process_signup.php by default.

### Step 2: Test the form
- Click Sign Up
- Fill in the form
- Click Sign Up button
- You should see a success message

---

## If That Works - Set Up Database Version

### Step 1: Verify MySQL is Running
- Start XAMPP, WAMP, or MAMP
- Open phpMyAdmin
- Make sure MySQL shows green/running status

### Step 2: Create Database
Go to phpMyAdmin and run this SQL:
```sql
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
    status VARCHAR(20) DEFAULT 'active'
);
```

### Step 3: Update Database Credentials
Edit config.php and process_signup.php:
```php
$db_host = 'localhost';      // Change if needed
$db_username = 'root';       // Your username
$db_password = '';           // Your password
$db_name = 'khan_pharmaceuticals';
```

### Step 4: Update signup.html Back
Change back to original action in signup.html:
```html
<form id="signupForm" method="POST" action="process_signup.php">
```

### Step 5: Test Again
- Fill in form
- Click Sign Up
- Should see success and redirect to home

---

## Common Issues & Solutions

### Issue: "Network error. Please check your connection..."
**Solution:** 
- Check if process_signup.php exists in same folder
- Check if your server is running (XAMPP/WAMP)
- Open browser console (F12) and check Network tab

### Issue: "Server error. Please check the console..."
**Solution:**
- Open browser F12 → Console tab
- Look for error messages
- Verify PHP file path is correct

### Issue: "Database connection failed"
**Solution:**
- MySQL/XAMPP not running
- Wrong database credentials in config.php
- Database 'khan_pharmaceuticals' doesn't exist
- Database table 'users' doesn't exist

### Issue: "Email already registered"
**Solution:**
- Use a different email address
- Or delete the user from database:
```sql
DELETE FROM users WHERE email = 'test@example.com';
```

---

## Debug Mode - Check What's Being Sent

Open browser Developer Tools (F12) and go to Network tab:
1. Fill form and submit
2. Look for "process_signup.php" request
3. Click it and check:
   - Request body (should show form fields)
   - Response (should be JSON)
   - Response code (should be 200)

---

## Files Reference

- **signup.html** - Form page
- **signup.js** - Form handler (this sends data)
- **process_signup.php** - Database version (requires MySQL)
- **process_signup_test.php** - Test version (no database needed)
- **config.php** - Database configuration
- **database_setup.sql** - SQL to create database

---

## Still Having Issues?

1. Check that you're using http://localhost not just file://
2. Verify all files are in same directory
3. Use test version first to isolate the issue
4. Check browser console for JavaScript errors (F12)
5. Check server error log if available
