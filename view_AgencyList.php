<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agency List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <!-- Header + tombol -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Agency List</h1>
        <div>
            <a href="view_AgencyAdd.php" class="btn btn-primary me-2">Add New Agency</a>
        </div>
    </div>

    <!-- Tabel -->
    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Founding Year</th>
                        <th>CEO</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agencies as $agency): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($agency['id']); ?></td>
                        <td><?= htmlspecialchars($agency['name']); ?></td>
                        <td><?= htmlspecialchars($agency['address']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($agency['year']); ?></td>
                        <td><?= htmlspecialchars($agency['ceo']); ?></td>
                        <td class="text-center">
                            <a href="edit_agency.php?id=<?= $agency['id']; ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                            <a href="delete_agency.php?id=<?= $agency['id']; ?>" 
                            class="btn btn-sm btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this agency?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
