# KHAN Pharmaceuticals - Sign Up Setup Guide

## Steps to Set Up Sign Up with Database

### 1. Database Setup
- Open phpMyAdmin or MySQL command line
- Run the SQL commands from `database_setup.sql`:
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
  
  CREATE INDEX idx_email ON users(email);
  CREATE INDEX idx_userType ON users(userType);
  ```

### 2. Server Setup
- Use a local server like XAMPP, WAMP, or MAMP
- Place all files in the htdocs (XAMPP) or www (WAMP) folder
- Update `config.php` with your database credentials if different

### 3. File Structure
```
Shamim vai/
├── Project.html          (Main page - Updated with Sign Up link)
├── signup.html           (Sign Up page)
├── signup.js             (Sign Up form handler)
├── login.html            (Login page)
├── login.js              (Login form handler)
├── dashboard.php         (User dashboard after login)
├── process_signup.php    (Backend form processor)
├── process_login.php     (Backend login processor)
├── config.php            (Database configuration)
├── database_setup.sql    (Database schema)
├── logout.php            (Logout handler)
├── styl.css
└── project.js
```

### 4. Configuration
Edit `config.php` to match your database credentials:
```php
define('DB_HOST', 'localhost');      // Your database host
define('DB_USERNAME', 'root');       // Your database username
define('DB_PASSWORD', '');           // Your database password
define('DB_NAME', 'khan_pharmaceuticals');
```

### 5. Access the Sign Up Page
- Navigate to: `http://localhost/project/signup.html`
- Or click the "Sign Up" link in the navigation menu

## Features

✓ User-friendly form with validation
✓ Secure password hashing (PHP password_hash)
✓ Email validation and duplicate check
✓ Different user types (Doctor, Pharmacist, Patient, Distributor)
✓ Client-side and server-side validation
✓ Success/error messages
✓ Auto-redirect after successful signup
✓ Database storage with timestamps

## Form Fields

- First Name (Required)
- Last Name (Required)
- Email Address (Required, must be unique)
- Phone Number (Optional)
- User Type (Required: Doctor, Pharmacist, Patient, Distributor, Other)
- Password (Required, minimum 6 characters)
- Confirm Password (Required, must match)
- Company/Organization (Optional)

## Troubleshooting

**Issue: "Connection failed"**
- Check if your database server is running
- Verify database credentials in config.php
- Make sure database `khan_pharmaceuticals` exists

**Issue: "Email already registered"**
- The email is already in the database
- Use a different email address

**Issue: Form not submitting**
- Check browser console for JavaScript errors
- Verify process_signup.php is in the same directory
- Check if PHP is enabled on your server

## Database Queries

View all registered users:
```sql
SELECT firstName, lastName, email, userType, created_date FROM users ORDER BY created_date DESC;
```

Find users by type:
```sql
SELECT * FROM users WHERE userType = 'Doctor';
```

Update user status:
```sql
UPDATE users SET status = 'active' WHERE id = 1;
```
