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