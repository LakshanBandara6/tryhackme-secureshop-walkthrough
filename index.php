<?php
require_once 'config.php';
$current_user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureShop - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">🛒 SecureShop</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <?php if (isLoggedIn()): ?>
                    <li><a href="profile.php?id=<?php echo $_SESSION['user_id']; ?>">My Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li class="user-info">Welcome, <?php echo htmlspecialchars($current_user['username']); ?>!</li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="hero">
        <h1>Welcome to SecureShop</h1>
        <p>Your trusted online store for electronics and gadgets</p>
    </div>

    <div class="container">
        <h2>Featured Products</h2>
        <div class="products-grid">
            <?php
            $query = "SELECT * FROM products LIMIT 4";
            $result = $conn->query($query);
            
            while ($product = $result->fetch_assoc()):
            ?>
            <div class="product-card">
                <div class="product-image">📦</div>
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 SecureShop. All rights reserved.</p>
    </footer>
</body>
</html>