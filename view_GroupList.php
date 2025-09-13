<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Group List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <!-- Header + tombol -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Group List</h1>
        <div>
            <a href="view_GroupAdd.php" class="btn btn-primary me-2">Add New Group</a>
        </div>
    </div>

    <!-- Tabel -->
    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Group ID</th>
                        <th>Group Name</th>
                        <th>Debut Date</th>
                        <th>Status</th>
                        <th>Agency ID</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groups as $group): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($group['id']); ?></td>
                        <td><?= htmlspecialchars($group['group_name']); ?></td>
                        <td><?= htmlspecialchars($group['debut_date']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($group['status']); ?></td>
                        <td><?= htmlspecialchars($group['agency_id']); ?></td>
                        <td class="text-center">
                            <a href="edit_group.php?id=<?= $group['id']; ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                            <a href="delete_group.php?id=<?= $group['id']; ?>" 
                            class="btn btn-sm btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this group?');">Delete</a>
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
