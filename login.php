<?php
require_once 'config.php';

$error = '';
$success = '';
$debug_query = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // VULNERABLE: SQL Injection - Direct concatenation
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    
    // Store query for debugging
    $debug_query = $query;
    
    // Execute query
    $result = $conn->query($query);
    
    // Debug: Check for SQL errors
    if (!$result) {
        $error = "SQL Error: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        
        // Show flag page
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Success - SecureShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">🛒 SecureShop</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <div class="flag-alert">
                <h2>🎉 Congratulations!</h2>
                <p>You successfully exploited SQL Injection!</p>
                <h3>FLAG{SQL_1nj3ct10n_1s_d4ng3r0us}</h3>
                <p style="margin-top: 20px;">Logged in as: <strong>' . htmlspecialchars($user['username']) . '</strong></p>
                <p>User ID: ' . $user['id'] . ' | Admin: ' . ($user['is_admin'] ? 'Yes' : 'No') . '</p>
                <br>
                <a href="index.php" class="btn btn-primary">Continue to Dashboard</a>
            </div>
            
            <div class="hint-box" style="margin-top: 20px;">
                <strong>🔍 SQL Query Executed:</strong><br>
                <code style="background: #f5f5f5; padding: 10px; display: block; margin-top: 10px; word-break: break-all;">' . htmlspecialchars($query) . '</code>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 SecureShop. All rights reserved.</p>
    </footer>
</body>
</html>';
        exit();
    } else {
        $error = "Invalid username or password! (Query returned 0 rows)";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SecureShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">🛒 SecureShop</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2>Login to SecureShop</h2>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($debug_query): ?>
                <div class="hint-box" style="background: #fff3cd; border-color: #ffc107; color: #856404;">
                    <strong>🐛 Debug - SQL Query:</strong><br>
                    <code style="background: #fff; padding: 5px; display: block; margin-top: 5px; word-break: break-all;"><?php echo htmlspecialchars($debug_query); ?></code>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password">
                </div>
                
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            
            <p class="form-footer">Don't have an account? <a href="register.php">Register here</a></p>
            
            <div class="hint-box">
                <strong>💡 SQL Injection Hints:</strong><br><br>
                <strong>Try these payloads in the Username field:</strong><br>
                1. <code>admin' OR 1=1--</code> (with any password)<br>
                2. <code>admin' OR '1'='1</code> (two dashes, no password needed)<br>
                3. <code>' OR '1'='1</code> (starts with quote)<br>
                4. <code>admin'#</code> (hash comment)<br><br>
                <strong>Password field:</strong> Can be anything or leave empty
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 SecureShop. All rights reserved.</p>
    </footer>
</body>
</html>