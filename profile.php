<?php
require_once 'config.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

// VULNERABLE: IDOR - No authorization check
$profile_id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = $profile_id";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $profile_user = $result->fetch_assoc();
} else {
    $error = "User not found!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - SecureShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">🛒 SecureShop</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="profile.php?id=<?php echo $_SESSION['user_id']; ?>">My Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li class="user-info">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($profile_user)): ?>
            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-avatar">👤</div>
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($profile_user['username']); ?></h2>
                        <?php if ($profile_user['is_admin']): ?>
                            <span class="admin-badge">Administrator</span>
                        <?php endif; ?>
                        <p class="profile-email">📧 <?php echo htmlspecialchars($profile_user['email']); ?></p>
                    </div>
                </div>
                
                <div class="profile-details">
                    <h3>About Me</h3>
                    <p><?php echo htmlspecialchars($profile_user['bio']); ?></p>
                    
                    <div class="profile-meta">
                        <p><strong>User ID:</strong> <?php echo $profile_user['id']; ?></p>
                        <p><strong>Member Since:</strong> <?php echo date('F Y', strtotime($profile_user['created_at'])); ?></p>
                    </div>
                </div>
                
                <?php if ($profile_id != $_SESSION['user_id']): ?>
                    <div class="hint-box">
                        🎉 You're viewing another user's profile! This is an IDOR vulnerability.
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="error">User profile not found!</div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 SecureShop. All rights reserved.</p>
    </footer>
</body>
</html>