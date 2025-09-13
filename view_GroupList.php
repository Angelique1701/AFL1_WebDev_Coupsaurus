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
            <th>Agency ID</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($groups as $group): ?>
        <tr>
            <td><?php echo htmlspecialchars($group['id']); ?></td>
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