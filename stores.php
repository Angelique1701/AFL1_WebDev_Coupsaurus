<?php
require_once 'config.php';
require_once 'model_Store.php';

requireAdmin(); // Only admin can access

$storeModel = new StoreModel();
$action = $_GET['action'] ?? 'list';
$message = '';

// Handle actions
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $storeModel->addStore($_POST['store_name'], $_POST['location'], $_POST['description']);
    header('Location: stores.php?message=added');
    exit();
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $storeModel->updateStore($_POST['store_id'], $_POST['store_name'], $_POST['location'], $_POST['description']);
    header('Location: stores.php?message=updated');
    exit();
}

if ($action === 'delete' && isset($_GET['id'])) {
    $storeModel->deleteStore($_GET['id']);
    header('Location: stores.php?message=deleted');
    exit();
}

// Get data for forms
if ($action === 'edit' && isset($_GET['id'])) {
    $store = $storeModel->getStoreById($_GET['id']);
}

$stores = $storeModel->getAllStores();

if (isset($_GET['message'])) {
    $messages = [
        'added' => 'Toko berhasil ditambahkan!',
        'updated' => 'Toko berhasil diupdate!',
        'deleted' => 'Toko berhasil dihapus!'
    ];
    $message = $messages[$_GET['message']] ?? '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Toko - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Kelola Toko</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Toko</button>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Toko</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stores as $store): ?>
                        <tr>
                            <td><?= htmlspecialchars($store['store_id']) ?></td>
                            <td><?= htmlspecialchars($store['store_name']) ?></td>
                            <td><?= htmlspecialchars($store['location']) ?></td>
                            <td><?= htmlspecialchars(substr($store['description'], 0, 50)) ?>...</td>
                            <td>
                                <a href="stores.php?action=edit&id=<?= $store['store_id'] ?>" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $store['store_id'] ?>">Edit</a>
                                <a href="stores.php?action=delete&id=<?= $store['store_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $store['store_id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="stores.php?action=update">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Toko</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="store_id" value="<?= $store['store_id'] ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Toko</label>
                                                <input type="text" class="form-control" name="store_name" value="<?= htmlspecialchars($store['store_name']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Lokasi</label>
                                                <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($store['location']) ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($store['description']) ?></textarea>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="stores.php?action=add">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Toko Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" name="store_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="location">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
