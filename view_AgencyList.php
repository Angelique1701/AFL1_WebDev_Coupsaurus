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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Agency List</h1>
        <div>
            <a href="view_AgencyAdd.php" class="btn btn-primary me-2">Add New Agency</a>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Agency ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Founding Year</th>
                        <th>CEO</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agencies as $agency): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($agency['company_id']); ?></td>
                        <td><?= htmlspecialchars($agency['company_name']); ?></td>
                        <td><?= htmlspecialchars($agency['location']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($agency['founding_year']); ?></td>
                        <td><?= htmlspecialchars($agency['ceo_name']); ?></td>
                        <td class="text-center">
                            <a href="view_AgencyUpdate.php?id=<?= $agency['company_id']; ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                            <a href="view_AgencyDelete.php?id=<?= $agency['company_id']; ?>" 
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
