-- SecureShop Database Setup
-- Run this in phpMyAdmin or MySQL command line



-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    is_admin TINYINT(1) DEFAULT 0,
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Reviews table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    user_id INT,
    review_text TEXT,
    rating INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert default users
INSERT INTO users (username, password, email, is_admin, bio) VALUES 
('admin', 'admin123', 'admin@secureshop.com', 1, 'Administrator Account - FLAG{1ns3cur3_D1r3ct_0bj3ct_R3f3r3nc3}'),
('john_doe', 'password123', 'john@example.com', 0, 'Regular user account'),
('jane_smith', 'pass456', 'jane@example.com', 0, 'Another regular user'),
('bob_wilson', 'bob2024', 'bob@example.com', 0, 'Test user account');

-- Insert sample products
INSERT INTO products (name, description, price, image) VALUES 
('Laptop Pro 15', 'High-performance laptop with 16GB RAM and 512GB SSD', 1299.99, 'laptop.jpg'),
('Wireless Mouse', 'Ergonomic wireless mouse with precision tracking', 29.99, 'mouse.jpg'),
('Mechanical Keyboard', 'RGB backlit mechanical keyboard for gaming', 89.99, 'keyboard.jpg'),
('USB-C Hub', '7-in-1 USB-C hub with HDMI and card reader', 49.99, 'usbhub.jpg');

-- Insert sample reviews
INSERT INTO reviews (product_id, user_id, review_text, rating) VALUES 
(1, 2, 'Great laptop! Very fast and reliable.', 5),
(1, 3, 'Good value for money. Highly recommended.', 4),
(2, 2, 'Comfortable to use. Battery lasts long.', 5);