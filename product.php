<?php
require_once 'config.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Get product details
$query = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isLoggedIn()) {
    $review_text = $_POST['review_text'];  // VULNERABLE: XSS - No sanitization
    $rating = intval($_POST['rating']);
    $user_id = $_SESSION['user_id'];
    
    $insert = "INSERT INTO reviews (product_id, user_id, review_text, rating) VALUES ($product_id, $user_id, '$review_text', $rating)";
    $conn->query($insert);
    
    header("Location: product.php?id=$product_id");
    exit();
}

// Get reviews
$reviews_query = "SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = $product_id ORDER BY r.created_at DESC";
$reviews_result = $conn->query($reviews_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - SecureShop</title>
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
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if ($product): ?>
            <div class="product-detail">
                <div class="product-detail-image">📦</div>
                <div class="product-detail-info">
                    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                    <p class="product-detail-price">$<?php echo number_format($product['price'], 2); ?></p>
                    <p class="product-detail-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    <button class="btn btn-primary">Add to Cart</button>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="reviews-section">
                <h2>Customer Reviews</h2>
                
                <!-- XSS Flag hidden in HTML comment -->
                <!-- FLAG{XSS_c4n_st34l_c00k13s} -->
                
                <?php if (isLoggedIn()): ?>
                    <div class="review-form">
                        <h3>Leave a Review</h3>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label>Rating:</label>
                                <select name="rating" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5 stars)</option>
                                    <option value="4">⭐⭐⭐⭐ (4 stars)</option>
                                    <option value="3">⭐⭐⭐ (3 stars)</option>
                                    <option value="2">⭐⭐ (2 stars)</option>
                                    <option value="1">⭐ (1 star)</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Your Review:</label>
                                <textarea name="review_text" rows="4" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn">Submit Review</button>
                        </form>
                    </div>
                <?php else: ?>
                    <p><a href="login.php">Login</a> to leave a review.</p>
                <?php endif; ?>

                <div class="reviews-list">
                    <?php while ($review = $reviews_result->fetch_assoc()): ?>
                        <div class="review-card">
                            <div class="review-header">
                                <strong><?php echo htmlspecialchars($review['username']); ?></strong>
                                <span class="review-rating">
                                    <?php echo str_repeat('⭐', $review['rating']); ?>
                                </span>
                            </div>
                            <!-- VULNERABLE: XSS - review_text is NOT escaped -->
                            <p class="review-text"><?php echo $review['review_text']; ?></p>
                            <p class="review-date"><?php echo date('F j, Y', strtotime($review['created_at'])); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="error">Product not found!</div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 SecureShop. All rights reserved.</p>
    </footer>
</body>
</html>