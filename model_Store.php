<?php
require_once 'config.php';

class StoreModel {
    private $conn;

    public function __construct() {
        $this->conn = getDBConnection();
    }

    // Get all stores
    public function getAllStores() {
        $sql = "SELECT * FROM stores ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
        
        $stores = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $stores[] = $row;
            }
        }
        return $stores;
    }

    // Get store by ID
    public function getStoreById($store_id) {
        $stmt = $this->conn->prepare("SELECT * FROM stores WHERE store_id = ?");
        $stmt->bind_param("i", $store_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Add new store (Admin only)
    public function addStore($store_name, $location, $description) {
        $stmt = $this->conn->prepare("INSERT INTO stores (store_name, location, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $store_name, $location, $description);
        return $stmt->execute();
    }

    // Update store (Admin only)
    public function updateStore($store_id, $store_name, $location, $description) {
        $stmt = $this->conn->prepare("UPDATE stores SET store_name = ?, location = ?, description = ? WHERE store_id = ?");
        $stmt->bind_param("sssi", $store_name, $location, $description, $store_id);
        return $stmt->execute();
    }

    // Delete store (Admin only)
    public function deleteStore($store_id) {
        $stmt = $this->conn->prepare("DELETE FROM stores WHERE store_id = ?");
        $stmt->bind_param("i", $store_id);
        return $stmt->execute();
    }
}
?>
