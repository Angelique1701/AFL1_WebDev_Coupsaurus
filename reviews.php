<?php
require_once 'config.php';
require_once 'model_Review.php';
require_once 'model_Product.php';

requirePembeli(); // Only pembeli can access

$reviewModel = new ReviewModel();
$productModel = new ProductModel();
$action = $_GET['action'] ?? 'list';
$message = '';
$user_id = getCurrentUserId();

// Handle actions
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewModel->addReview($_POST['product_id'], $user_id, $_POST['rating'], $_POST['comment']);
    header('Location: reviews.php?message=added');
    exit();
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewModel->updateReview($_POST['review_id'], $_POST['rating'], $_POST['comment'], $user_id);
    header('Location: reviews.php?message=updated');
    exit();
}

if ($action === 'delete' && isset($_GET['id'])) {
    // Check if review belongs to user
    if ($reviewModel->isReviewOwner($_GET['id'], $user_id)) {
        $reviewModel->deleteReview($_GET['id'], $user_id);
        header('Location: reviews.php?message=deleted');
    } else {
        header('Location: reviews.php?message=error');
    }
    exit();
}

$reviews = $reviewModel->getReviewsByUser($user_id);
$products = $productModel->getAllProducts();

if (isset($_GET['message'])) {
    $messages = [
        'added' => 'Review berhasil ditambahkan!',
        'updated' => 'Review berhasil diupdate!',
        'deleted' => 'Review berhasil dihapus!',
        'error' => 'Anda tidak memiliki akses untuk menghapus review ini!'
    ];
    $message = $messages[$_GET['message']] ?? '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Saya - Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star-rating {
            color: #ffc107;
        }
    </style>
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Review Saya</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Review</button>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-<?= $_GET['message'] === 'error' ? 'danger' : 'success' ?> alert-dismissible fade show">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (empty($reviews)): ?>
            <div class="alert alert-info">
                Anda belum memiliki review. Silakan tambah review untuk produk yang sudah Anda beli.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($reviews as $review): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($review['product_name']) ?></h5>
                            <div class="star-rating mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?= $i <= $review['rating'] ? '★' : '☆' ?>
                                <?php endfor ?>
                                <span class="text-muted">(<?= $review['rating'] ?>/5)</span>
                            </div>
                            <p class="card-text"><?= htmlspecialchars($review['comment']) ?></p>
                            <p class="text-muted small mb-3">
                                <small>Dibuat: <?= date('d M Y H:i', strtotime($review['created_at'])) ?></small>
                            </p>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $review['review_id'] ?>">Edit</button>
                                <a href="reviews.php?action=delete&id=<?= $review['review_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus review ini?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $review['review_id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="reviews.php?action=update">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="review_id" value="<?= $review['review_id'] ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Produk</label>
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($review['product_name']) ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <select class="form-select" name="rating" required>
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?= $i ?>" <?= $i == $review['rating'] ? 'selected' : '' ?>><?= $i ?> Bintang</option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Komentar</label>
                                        <textarea class="form-control" name="comment" rows="4" required><?= htmlspecialchars($review['comment']) ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="reviews.php?action=add">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Review Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih Produk</label>
                            <select class="form-select" name="product_id" required>
                                <option value="">Pilih Produk</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?> - <?= htmlspecialchars($product['store_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select class="form-select" name="rating" required>
                                <option value="">Pilih Rating</option>
                                <option value="5">5 Bintang - Sangat Bagus</option>
                                <option value="4">4 Bintang - Bagus</option>
                                <option value="3">3 Bintang - Cukup</option>
                                <option value="2">2 Bintang - Kurang</option>
                                <option value="1">1 Bintang - Sangat Kurang</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea class="form-control" name="comment" rows="4" placeholder="Tulis review Anda tentang produk ini..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
