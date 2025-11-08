<?php
require_once 'config.php';
require_once 'model_Product.php';
require_once 'model_Review.php';

requireLogin();

$product_id = $_GET['id'] ?? null;
if (!$product_id) {
    header('Location: products.php');
    exit();
}

$productModel = new ProductModel();
$reviewModel = new ReviewModel();

$product = $productModel->getProductById($product_id);
$reviews = $reviewModel->getReviewsByProduct($product_id);

if (!$product) {
    header('Location: products.php');
    exit();
}

// Calculate average rating
$total_rating = 0;
$review_count = count($reviews);
if ($review_count > 0) {
    foreach ($reviews as $review) {
        $total_rating += $review['rating'];
    }
    $avg_rating = round($total_rating / $review_count, 1);
} else {
    $avg_rating = 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['product_name']) ?> - Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star-rating {
            color: #ffc107;
            font-size: 1.5rem;
        }
        .review-star {
            color: #ffc107;
        }
    </style>
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="products.php">Produk</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($product['product_name']) ?></li>
            </ol>
        </nav>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h2 class="mb-3"><?= htmlspecialchars($product['product_name']) ?></h2>
                        <p class="text-muted mb-3">
                            <strong>Toko:</strong> <?= htmlspecialchars($product['store_name']) ?>
                        </p>
                        
                        <div class="star-rating mb-3">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?= $i <= $avg_rating ? '★' : '☆' ?>
                            <?php endfor ?>
                            <span class="text-muted ms-2"><?= $avg_rating ?>/5 (<?= $review_count ?> review)</span>
                        </div>
                        
                        <h3 class="text-primary mb-3">Rp <?= number_format($product['price'], 0, ',', '.') ?></h3>
                        
                        <p class="mb-3">
                            <strong>Stok:</strong> 
                            <span class="badge bg-<?= $product['stock'] > 0 ? 'success' : 'danger' ?>">
                                <?= $product['stock'] > 0 ? $product['stock'] . ' tersedia' : 'Habis' ?>
                            </span>
                        </p>
                        
                        <h5>Deskripsi Produk</h5>
                        <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="mb-4">Review Produk (<?= $review_count ?>)</h4>
                        
                        <?php if (empty($reviews)): ?>
                            <p class="text-muted">Belum ada review untuk produk ini.</p>
                        <?php else: ?>
                            <?php foreach ($reviews as $review): ?>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><?= htmlspecialchars($review['full_name'] ?? $review['username']) ?></h6>
                                        <div class="review-star mb-2">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <?= $i <= $review['rating'] ? '★' : '☆' ?>
                                            <?php endfor ?>
                                        </div>
                                    </div>
                                    <small class="text-muted"><?= date('d M Y', strtotime($review['created_at'])) ?></small>
                                </div>
                                <p class="mb-0"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <?php if (isPembeli()): ?>
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Tulis Review</h5>
                        <p class="card-text">Sudah membeli produk ini? Berikan review Anda!</p>
                        <a href="reviews.php" class="btn btn-primary w-100">Tulis Review</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
