# SecureShop - Vulnerable Web Application

## ⚠️ DISCLAIMER
This application is intentionally vulnerable and designed for educational purposes only. 
DO NOT deploy this to a production environment or publicly accessible server.

## 🎯 Purpose
This application is created for the IE2062 Web Security Assignment (Part 2 - TryHackMe Room).
It contains 4 intentional vulnerabilities for students to discover and exploit.

## 🚀 Installation Steps

### 1. Prerequisites
- XAMPP installed on your system
- Basic knowledge of PHP and MySQL

### 2. Setup Instructions

1. **Copy Files**
   - Extract all files to `C:\xampp\htdocs\secureshop\`

2. **Start Services**
   - Open XAMPP Control Panel
   - Start Apache
   - Start MySQL

3. **Create Database**
   - Open browser: `http://localhost/phpmyadmin`
   - Click "New" to create database
   - Name it: `secureshop`
   - Go to "Import" tab
   - Select `database.sql` file
   - Click "Go" to import

4. **Access Application**
   - Open browser: `http://localhost/secureshop`
   - The application should now be running!

## 🔑 Default Credentials

- **Admin Account**: 
  - Username: `admin`
  - Password: `admin123`

- **Regular User**: 
  - Username: `john_doe`
  - Password: `password123`

## 🎮 Challenges (Flags to Find)

1. **SQL Injection** - `FLAG{SQL_1nj3ct10n_1s_d4ng3r0us}`
2. **IDOR (Broken Access Control)** - `FLAG{1ns3cur3_D1r3ct_0bj3ct_R3f3r3nc3}`
3. **XSS (Cross-Site Scripting)** - `FLAG{XSS_c4n_st34l_c00k13s}`
4. **Sensitive Data Exposure** - `FLAG{b4ckup_f1l3s_4r3_d4ng3r0us}`

## 🛠️ Troubleshooting

### Database Connection Error
- Verify MySQL is running in XAMPP
- Check database name is `secureshop`
- Ensure credentials in `config.php` match your setup

### Pages Not Loading
- Verify Apache is running
- Check that files are in correct directory
- Clear browser cache

### Blank Pages
- Check PHP error logs in `C:\xampp\apache\logs\error.log`
- Enable error reporting by adding to `config.php`:
```php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);