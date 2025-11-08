<?php
require_once 'config.php';
requireLogin();

$role = getCurrentUserRole();
$username = $_SESSION['username'];
$full_name = $_SESSION['full_name'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="mb-4">Selamat Datang, <?= htmlspecialchars($full_name) ?>!</h2>
                        <p class="lead">Role: <span class="badge bg-<?= $role === 'admin' ? 'danger' : 'primary' ?>"><?= strtoupper($role) ?></span></p>
                        
                        <hr>
                        
                        <?php if ($role === 'admin'): ?>
                            <h4 class="mb-3">Menu Admin</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Kelola Toko</h5>
                                            <p class="card-text">Tambah, edit, dan hapus data toko</p>
                                            <a href="stores.php" class="btn btn-light">Kelola Toko</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Kelola Produk</h5>
                                            <p class="card-text">Tambah, edit, dan hapus data produk</p>
                                            <a href="products.php" class="btn btn-light">Kelola Produk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <h4 class="mb-3">Menu Pembeli</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Lihat Produk</h5>
                                            <p class="card-text">Browse semua produk yang tersedia</p>
                                            <a href="products.php" class="btn btn-light">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-warning text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Review Saya</h5>
                                            <p class="card-text">Kelola review produk Anda</p>
                                            <a href="reviews.php" class="btn btn-light">Kelola Review</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
