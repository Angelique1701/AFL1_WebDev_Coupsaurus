<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agency List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Agency List</h1>
    <a href="view_GroupAdd.php" class="btn btn-primary">Add New Group</a>
    <a href="view_GroupDelete.php" class="btn btn-primary">Delete Group</a>
    <a href="view_GroupUpdate.php" class="btn btn-primary">Update Group</a>
</div>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Debut Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($groups as $group): ?>
        <tr>
            <td><?php echo htmlspecialchars($group['group_id']); ?></td>
            <td><?php echo htmlspecialchars($group['group_name']); ?></td>
            <td><?php echo htmlspecialchars($group['gdebut_date']); ?></td>
            <td><?php echo htmlspecialchars($group['status']); ?></td>
            <td>
                <a href="edit_group.php?id=<?php echo $group['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete_group.php?id=<?php echo $group['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this group?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>