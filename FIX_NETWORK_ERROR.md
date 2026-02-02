# How to Fix the Network Error - Complete Guide

## The Problem
You're seeing: **"Network error: Make sure you are running a local server"**

This happens because PHP files must be served through a web server, not opened directly as files.

---

## Solution 1: Use the Easy Start Script (RECOMMENDED)

### Step 1: Check if PHP is Installed
Open PowerShell or Command Prompt and type:
```
php -v
```

If you see a version number, PHP is installed. Go to Step 2.

If it says "php is not recognized", see **Solution 2** below.

### Step 2: Start the Server

**Option A - Using Batch File (Easiest):**
1. Go to your project folder
2. Double-click `start_server.bat`
3. Wait for message: "Server starting on: http://localhost:8000"
4. Leave this window open

**Option B - Using PowerShell:**
1. Open PowerShell
2. Navigate to folder: `cd "d:\Projects\Shamim vai"`
3. Run: `.\start_server.ps1`
4. Wait for server to start
5. Leave this window open

### Step 3: Access Your Website
Open your browser and go to:
- **Main Site:** `http://localhost:8000/Project.html`
- **Sign Up:** `http://localhost:8000/signup.html`
- **Setup Check:** `http://localhost:8000/setup_check.html`

**Important:** Use `http://localhost:8000` NOT `file://C:/...`

---

## Solution 2: If PHP is Not Installed

### Option A: Install XAMPP (Easiest for Beginners)

1. **Download XAMPP**
   - Go to: https://www.apachefriends.org
   - Click "Download" (Windows version)
   - Choose latest version (e.g., 8.2.x)

2. **Install XAMPP**
   - Run the installer
   - Click Next through all screens
   - Use default installation location: `C:\xampp`
   - At end, check "Do you want to start the Control Panel?"

3. **Start Apache**
   - Open XAMPP Control Panel
   - Find "Apache"
   - Click "Start" button
   - You should see green text and port 80

4. **Move Your Files**
   - Cut your `Learning_HTML` folder
   - Paste it in: `C:\xampp\htdocs`
   - New path: `C:\xampp\htdocs\Learning_HTML`

5. **Access Your Site**
   - Open browser
   - Go to: `http://localhost/Learning_HTML/Project.html`

### Option B: Install PHP Standalone

1. **Download PHP**
   - Go to: https://www.php.net/downloads.php
   - Download "Windows ZIP"
   - Choose latest stable version

2. **Extract Files**
   - Unzip to: `C:\php`

3. **Add to PATH**
   - Right-click "This PC" → Properties
   - Click "Advanced system settings"
   - Click "Environment Variables"
   - Under "System variables", find "Path"
   - Click "Edit"
   - Click "New"
   - Add: `C:\php`
   - Click OK on all windows

4. **Restart Computer**
   - Restart your computer

5. **Start Server**
   - Use `start_server.bat` (now it should work)

---

## Troubleshooting

### Issue: "php is not recognized"
**Solution:** 
- Install XAMPP or PHP (see Solution 2)
- Or add PHP to system PATH

### Issue: "Port 8000 already in use"
**Solution:**
- Change port in `start_server.bat`
- Replace `8000` with `8080` or `3000`
- Access via `http://localhost:8080`

### Issue: Server starts but page won't load
**Solution:**
- Make sure `Learning_HTML` folder is in:
  - XAMPP: `C:\xampp\htdocs\Learning_HTML`
  - Or PHP: `f:\Learning_HTML` (if using start_server.bat)

### Issue: Still getting network error
**Solution:**
1. Run setup_check.html via http://localhost
2. This will tell you exactly what's wrong
3. Follow the error messages

---

## Quick Reference

### Correct URLs:
```
✓ http://localhost:8000/Project.html
✓ http://localhost:8000/signup.html
✓ http://localhost/Learning_HTML/Project.html (XAMPP)
```

### Wrong URLs:
```
✗ file:///f:/Learning_HTML/Project.html
✗ C:\Learning_HTML\Project.html
✗ file://localhost/Project.html
```

### How to Know Your Server URL:
- Look at your browser address bar
- Should start with: `http://` or `https://`
- NOT: `file://`

---

## What's Happening Behind the Scenes?

1. **Without Server (file://):**
   - You open HTML directly
   - JavaScript can load
   - PHP files are downloaded as text (don't execute)
   - Database connections fail
   - → Network error

2. **With Server (http://localhost):**
   - You request HTML from web server
   - JavaScript can load
   - PHP files execute on server
   - Response returns as JSON
   - Database connections work
   - → Success!

---

## Still Need Help?

1. Check browser console: Press F12 → Console tab
2. Look for red error messages
3. Take a screenshot
4. Share the error details

Common fixes:
- Restart server (close and reopen start_server.bat)
- Clear browser cache (Ctrl+Shift+Delete)
- Try different browser
- Check folder path is correct
