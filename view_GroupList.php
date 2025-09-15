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
        
        <div class="d-flex">
            <?php if (!empty($groups)): ?>
                <!-- Kalau ada group, ambil agency_id dari grup pertama -->
                <a href="controller.php?controller=agency&action=list" 
                class="btn btn-secondary me-2">Back to Agency List</a>

                <a href="controller.php?controller=group&action=showAddForm&agency_id=<?= $groups[0]['company_id']; ?>" 
                class="btn btn-success">Add New Group</a>

            <?php elseif (isset($_GET['agency_id'])): ?>
                <!-- Kalau belum ada grup, tetap bisa add dengan agency_id dari URL -->
                <a href="controller.php?controller=agency&action=list" 
                class="btn btn-secondary me-2">Back to Agency List</a>

                <a href="controller.php?controller=group&action=showAddForm&agency_id=<?= $_GET['agency_id']; ?>" 
                class="btn btn-success">Add New Group</a>
            <?php endif; ?>
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
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($groups)): ?>
                        <?php foreach ($groups as $group): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($group['group_id']); ?></td>
                            <td><?= htmlspecialchars($group['group_name']); ?></td>
                            <td><?= htmlspecialchars($group['gdebut_date']); ?></td>
                            <td class="text-center"><?= htmlspecialchars($group['status']); ?></td>
                            <td class="text-center">
                                <!-- Edit bawa id group + agency_id -->
                                <a href="controller.php?controller=group&action=showUpdateForm&id=<?= $group['group_id']; ?>&agency_id=<?= $group['company_id']; ?>" 
                                class="btn btn-sm btn-warning me-1">Edit</a>

                                <!-- Delete bawa id group + agency_id -->
                                <a href="controller.php?controller=group&action=delete&id=<?= $group['group_id']; ?>&agency_id=<?= $group['company_id']; ?>" 
                                class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this group?');">Delete</a>                        
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No groups available for this agency</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
