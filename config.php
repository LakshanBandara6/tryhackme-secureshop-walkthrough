<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Database configuration
define('DB_HOST', 'sql100.infinityfree.com');
define('DB_USER', 'if0_40076772');  // ← Change this
define('DB_PASS', 'W3HkOgeubz');       // ← Change this
define('DB_NAME', 'if0_40076772_secureshop');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Helper function to get current user
function getCurrentUser() {
    global $conn;
    if (isLoggedIn()) {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id = $user_id";
        $result = $conn->query($query);
        return $result->fetch_assoc();
    }
    return null;
}
?>