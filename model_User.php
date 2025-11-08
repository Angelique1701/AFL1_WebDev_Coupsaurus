<?php
require_once 'config.php';

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = getDBConnection();
    }

    // Register new user
    public function register($username, $email, $password, $full_name, $role = 'pembeli') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $hashed_password, $full_name, $role);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Login user
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT user_id, username, email, password, role, full_name FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['full_name'] = $user['full_name'];
                
                return true;
            }
        }
        return false;
    }

    // Logout user
    public function logout() {
        session_destroy();
        return true;
    }

    // Get user by ID
    public function getUserById($user_id) {
        $stmt = $this->conn->prepare("SELECT user_id, username, email, role, full_name, created_at FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
