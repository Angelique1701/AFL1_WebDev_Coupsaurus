<?php
require_once 'config.php';

class ReviewModel {
    private $conn;

    public function __construct() {
        $this->conn = getDBConnection();
    }

    // Get all reviews with product and user info
    public function getAllReviews() {
        $sql = "SELECT r.*, p.product_name, u.username, u.full_name 
                FROM reviews r 
                LEFT JOIN products p ON r.product_id = p.product_id 
                LEFT JOIN users u ON r.user_id = u.user_id 
                ORDER BY r.created_at DESC";
        $result = $this->conn->query($sql);
        
        $reviews = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
        }
        return $reviews;
    }

    // Get reviews by user (Pembeli can only see their own reviews)
    public function getReviewsByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT r.*, p.product_name FROM reviews r LEFT JOIN products p ON r.product_id = p.product_id WHERE r.user_id = ? ORDER BY r.created_at DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $reviews = [];
        while($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
        return $reviews;
    }

    // Get reviews by product
    public function getReviewsByProduct($product_id) {
        $stmt = $this->conn->prepare("SELECT r.*, u.username, u.full_name FROM reviews r LEFT JOIN users u ON r.user_id = u.user_id WHERE r.product_id = ? ORDER BY r.created_at DESC");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $reviews = [];
        while($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
        return $reviews;
    }

    // Get review by ID
    public function getReviewById($review_id) {
        $stmt = $this->conn->prepare("SELECT r.*, p.product_name FROM reviews r LEFT JOIN products p ON r.product_id = p.product_id WHERE r.review_id = ?");
        $stmt->bind_param("i", $review_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Add new review (Pembeli only)
    public function addReview($product_id, $user_id, $rating, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $product_id, $user_id, $rating, $comment);
        return $stmt->execute();
    }

    // Update review (Pembeli can only update their own review)
    public function updateReview($review_id, $rating, $comment, $user_id) {
        $stmt = $this->conn->prepare("UPDATE reviews SET rating = ?, comment = ? WHERE review_id = ? AND user_id = ?");
        $stmt->bind_param("isii", $rating, $comment, $review_id, $user_id);
        return $stmt->execute();
    }

    // Delete review (Pembeli can only delete their own review)
    public function deleteReview($review_id, $user_id) {
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE review_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $review_id, $user_id);
        return $stmt->execute();
    }

    // Check if review belongs to user
    public function isReviewOwner($review_id, $user_id) {
        $stmt = $this->conn->prepare("SELECT user_id FROM reviews WHERE review_id = ?");
        $stmt->bind_param("i", $review_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $review = $result->fetch_assoc();
            return $review['user_id'] == $user_id;
        }
        return false;
    }
}
?>
