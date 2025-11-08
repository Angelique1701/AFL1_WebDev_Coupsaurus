-- Database setup untuk sistem login dengan role Admin dan Pembeli

-- Tabel users untuk authentication
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'pembeli') NOT NULL DEFAULT 'pembeli',
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel stores (untuk Admin)
CREATE TABLE IF NOT EXISTS stores (
    store_id INT AUTO_INCREMENT PRIMARY KEY,
    store_name VARCHAR(100) NOT NULL,
    location VARCHAR(200),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel products (untuk Admin)
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES stores(store_id) ON DELETE CASCADE
);

-- Tabel reviews (untuk Pembeli)
CREATE TABLE IF NOT EXISTS reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Insert default admin user (password: admin123)
-- Note: Jika login gagal, jalankan generate_password.php untuk mendapatkan hash baru
INSERT INTO users (username, email, password, role, full_name) VALUES 
('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administrator')
ON DUPLICATE KEY UPDATE username=username;

-- Insert sample pembeli user (password: pembeli123)
INSERT INTO users (username, email, password, role, full_name) VALUES 
('pembeli1', 'pembeli@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pembeli', 'Pembeli Satu')
ON DUPLICATE KEY UPDATE username=username;

-- Insert sample stores
INSERT INTO stores (store_name, location, description) VALUES 
('Toko Elektronik', 'Jakarta', 'Toko elektronik terlengkap'),
('Toko Fashion', 'Bandung', 'Fashion terkini dan trendy');

-- Insert sample products
INSERT INTO products (store_id, product_name, description, price, stock) VALUES 
(1, 'Laptop ASUS', 'Laptop gaming high performance', 15000000.00, 10),
(1, 'Mouse Gaming', 'Mouse gaming RGB', 500000.00, 50),
(2, 'Kaos Polos', 'Kaos polos berbagai warna', 75000.00, 100);
