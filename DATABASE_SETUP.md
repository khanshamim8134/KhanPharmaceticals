# Database Setup Guide

## Quick Setup (Recommended)

### Step 1: Start MySQL
- Open XAMPP Control Panel
- Click "Start" next to MySQL
- Wait for it to turn green

### Step 2: Run Database Setup
Double-click one of these files:
- **`setup_database.bat`** (Windows Command Prompt)
- **`setup_database.ps1`** (PowerShell - Right-click → Run with PowerShell)

That's it! The script will automatically:
- Create the database `khan_pharmaceuticals`
- Create all required tables
- Set up indexes for performance
- Verify the installation

---

## Manual Setup (Alternative)

If the automatic script doesn't work:

### Method 1: Using phpMyAdmin
1. Open http://localhost/phpmyadmin
2. Click "New" to create a database
3. Name it: `khan_pharmaceuticals`
4. Click "Import" tab
5. Choose file: `database_complete_setup.sql`
6. Click "Go"

### Method 2: Using MySQL Command Line
```bash
cd "d:\Projects\Shamim vai"
mysql -u root < database_complete_setup.sql
```

---

## Database Structure

The setup creates these tables:

### 1. **users** (Main user accounts)
- id, firstName, lastName, email
- phone, userType, password, company
- created_date, updated_date, last_login, status

### 2. **activity_log** (User activity tracking)
- id, user_id, action, description
- ip_address, user_agent, timestamp

### 3. **products** (Product catalog - optional)
- id, product_name, product_code, category
- description, price, stock_quantity
- manufacturer, status, dates

### 4. **orders** (Customer orders - optional)
- id, user_id, order_number
- total_amount, order_status, payment_status
- shipping_address, dates

### 5. **sessions** (Session management - optional)
- id, user_id, data, last_activity

---

## Verification

### Check if database exists:
Run: **`check_database.bat`**

Or manually:
```sql
SHOW DATABASES LIKE 'khan_pharmaceuticals';
USE khan_pharmaceuticals;
SHOW TABLES;
```

### Expected output:
```
+--------------------------------+
| Tables_in_khan_pharmaceuticals |
+--------------------------------+
| activity_log                   |
| orders                         |
| products                       |
| sessions                       |
| users                          |
+--------------------------------+
```

---

## Troubleshooting

### "MySQL command not found"
**Solution:** Add MySQL to your PATH
- XAMPP: `C:\xampp\mysql\bin`
- WAMP: `C:\wamp64\bin\mysql\mysql8.x.x\bin`

Or use phpMyAdmin instead (Method 1 above)

### "Access denied for user 'root'"
**Solution:** You have a MySQL password set
1. Run the script - it will prompt for password
2. Update `config.php`:
   ```php
   define('DB_PASSWORD', 'your_password_here');
   ```

### "Database already exists"
**Solution:** This is fine! The script uses `CREATE DATABASE IF NOT EXISTS`

To reset everything:
```sql
DROP DATABASE khan_pharmaceuticals;
-- Then run setup_database.bat again
```

### "Table already exists"
**Solution:** This is fine! The script uses `CREATE TABLE IF NOT EXISTS`

---

## Configuration

After database setup, verify `config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');        // MySQL default port
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');        // Change if you have a password
define('DB_NAME', 'khan_pharmaceuticals');
```

**Note:** If your MySQL runs on a different port, update `DB_PORT` in config.php.

---

## Testing the Setup

### Test 1: Database Connection
1. Start PHP server: `start_server.bat`
2. Go to: http://localhost:8000/setup_check.html
3. Should show all checks passing

### Test 2: User Registration
1. Go to: http://localhost:8000/signup.html
2. Fill the form and submit
3. Should see "Account created successfully!"

### Test 3: User Login
1. Go to: http://localhost:8000/login.html
2. Enter the credentials from signup
3. Should redirect to dashboard

---

## Sample Data (Optional)

To add test users manually:
```sql
INSERT INTO users (firstName, lastName, email, userType, password) 
VALUES 
('Test', 'User', 'test@example.com', 'customer', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
-- Password: password
```

---

## Files Created

- **`database_complete_setup.sql`** - Complete SQL schema
- **`setup_database.bat`** - Auto setup (Windows CMD)
- **`setup_database.ps1`** - Auto setup (PowerShell)
- **`check_database.bat`** - Verification script
- **`DATABASE_SETUP.md`** - This file

---

## Need Help?

Check these files:
- `README.md` - Main project documentation
- `QUICK_FIXES.md` - Common issues
- `TROUBLESHOOTING.md` - Detailed troubleshooting
