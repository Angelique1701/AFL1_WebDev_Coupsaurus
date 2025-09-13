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
    <a href="view_AgencyAdd.php" class="btn btn-primary">Add New Agency</a>
    <a href="view_AgencyDelete.php" class="btn btn-primary">Delete Agency</a>
    <a href="view_AgencyUpdate.php" class="btn btn-primary">Update Agency</a>
</div>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Founding Year</th>
            <th>CEO</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($agencies as $agency): ?>
        <tr>
            <td><?php echo htmlspecialchars($agency['id']); ?></td>
            <td><?php echo htmlspecialchars($agency['name']); ?></td>
            <td><?php echo htmlspecialchars($agency['address']); ?></td>
            <td><?php echo htmlspecialchars($agency['Founding Year']); ?></td>
            <td><?php echo htmlspecialchars($agency['CEO']); ?></td>
            <td>
                <a href="edit_agency.php?id=<?php echo $agency['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete_agency.php?id=<?php echo $agency['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this agency?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>