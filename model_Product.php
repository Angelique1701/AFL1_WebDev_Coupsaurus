<?php
require_once 'config.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = getDBConnection();
    }

    // Get all products with store info
    public function getAllProducts() {
        $sql = "SELECT p.*, s.store_name 
                FROM products p 
                LEFT JOIN stores s ON p.store_id = s.store_id 
                ORDER BY p.created_at DESC";
        $result = $this->conn->query($sql);
        
        $products = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    // Get product by ID
    public function getProductById($product_id) {
        $stmt = $this->conn->prepare("SELECT p.*, s.store_name FROM products p LEFT JOIN stores s ON p.store_id = s.store_id WHERE p.product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Add new product (Admin only)
    public function addProduct($store_id, $product_name, $description, $price, $stock) {
        $stmt = $this->conn->prepare("INSERT INTO products (store_id, product_name, description, price, stock) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issdi", $store_id, $product_name, $description, $price, $stock);
        return $stmt->execute();
    }

    // Update product (Admin only)
    public function updateProduct($product_id, $store_id, $product_name, $description, $price, $stock) {
        $stmt = $this->conn->prepare("UPDATE products SET store_id = ?, product_name = ?, description = ?, price = ?, stock = ? WHERE product_id = ?");
        $stmt->bind_param("issdii", $store_id, $product_name, $description, $price, $stock, $product_id);
        return $stmt->execute();
    }

    // Delete product (Admin only)
    public function deleteProduct($product_id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        return $stmt->execute();
    }

    // Get products by store
    public function getProductsByStore($store_id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE store_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $store_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $products = [];
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
}
?>
