<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

    <div class="container mt-5">
    <h1 class="h3 mb-4">Delete Group</h1>

    <div class="card shadow">
        <div class="card-body p-0">
        <table class="table table-hover table-bordered mb-0">
            <thead class="table-light">
            <tr class="text-center">
                <th>Group ID</th>
                <th>Group Name</th>
                <th>Debut Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($groups as $group): ?>
            <tr>
                <td class="text-center"><?= htmlspecialchars($group['group_id']); ?></td>
                <td><?= htmlspecialchars($group['group_name']); ?></td>
                <td><?= htmlspecialchars($group['gdebut_date']); ?></td>
                <td><?= htmlspecialchars($group['status']); ?></td>
                <td class="text-center">
                <a href="view_GroupDelete.php?id=<?= $group['group_id']; ?>" 
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars($group['group_name']); ?>?');">
                    Delete
                </a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>

</body>
</html>

