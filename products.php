<?php
require_once 'config.php';
require_once 'model_Product.php';
require_once 'model_Store.php';

requireLogin();

$productModel = new ProductModel();
$storeModel = new StoreModel();
$action = $_GET['action'] ?? 'list';
$message = '';

// Admin actions
if (isAdmin()) {
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $productModel->addProduct($_POST['store_id'], $_POST['product_name'], $_POST['description'], $_POST['price'], $_POST['stock']);
        header('Location: products.php?message=added');
        exit();
    }

    if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $productModel->updateProduct($_POST['product_id'], $_POST['store_id'], $_POST['product_name'], $_POST['description'], $_POST['price'], $_POST['stock']);
        header('Location: products.php?message=updated');
        exit();
    }

    if ($action === 'delete' && isset($_GET['id'])) {
        $productModel->deleteProduct($_GET['id']);
        header('Location: products.php?message=deleted');
        exit();
    }
}

$products = $productModel->getAllProducts();
$stores = $storeModel->getAllStores();

if (isset($_GET['message'])) {
    $messages = [
        'added' => 'Produk berhasil ditambahkan!',
        'updated' => 'Produk berhasil diupdate!',
        'deleted' => 'Produk berhasil dihapus!'
    ];
    $message = $messages[$_GET['message']] ?? '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isAdmin() ? 'Kelola Produk - Admin' : 'Daftar Produk' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= isAdmin() ? 'Kelola Produk' : 'Daftar Produk' ?></h2>
            <?php if (isAdmin()): ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Produk</button>
            <?php endif; ?>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                        <p class="text-muted mb-2">
                            <small>Toko: <?= htmlspecialchars($product['store_name']) ?></small>
                        </p>
                        <p class="card-text"><?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...</p>
                        <p class="mb-2">
                            <strong>Harga:</strong> Rp <?= number_format($product['price'], 0, ',', '.') ?><br>
                            <strong>Stok:</strong> <?= htmlspecialchars($product['stock']) ?>
                        </p>
                        
                        <?php if (isAdmin()): ?>
                            <div class="btn-group w-100">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['product_id'] ?>">Edit</button>
                                <a href="products.php?action=delete&id=<?= $product['product_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </div>
                        <?php else: ?>
                            <a href="product_detail.php?id=<?= $product['product_id'] ?>" class="btn btn-sm btn-primary w-100">Lihat Detail & Review</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <?php if (isAdmin()): ?>
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?= $product['product_id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="products.php?action=update">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <div class="mb-3">
                                    <label class="form-label">Toko</label>
                                    <select class="form-select" name="store_id" required>
                                        <?php foreach ($stores as $store): ?>
                                            <option value="<?= $store['store_id'] ?>" <?= $store['store_id'] == $product['store_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($store['store_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" class="form-control" name="stock" value="<?= $product['stock'] ?>" required>
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
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php if (isAdmin()): ?>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="products.php?action=add">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Produk Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Toko</label>
                            <select class="form-select" name="store_id" required>
                                <option value="">Pilih Toko</option>
                                <?php foreach ($stores as $store): ?>
                                    <option value="<?= $store['store_id'] ?>"><?= htmlspecialchars($store['store_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stock" value="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
