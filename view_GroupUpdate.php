<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">Update Group</h4>
        </div>
        <div class="card-body">
        <?php

            $agency = [
            "group_id" => $_GET['group_id'],
            "group_name" => $_GET['group_name'],
            "debut_date" => $_GET['gdebut_date'],
            "status" => $_GET['status'],
            "company_id" => $_GET['company_id']
            ];
            
        ?>

        <form action="view_GroupUpdate.php" method="POST">
            <!-- hidden id -->
            <input type="hidden" name="group_id" value="<?php echo $group['group_id']; ?>">

            <div class="mb-3">
            <label for="group_name" class="form-label">Group Name</label>
            <input type="text" class="form-control" id="group_name" name="group_name"
                    value="<?php echo htmlspecialchars($group['group_name']); ?>" required>
            </div>

            <div class="mb-3">
            <label for="gdebut_date" class="form-label">Debut Date</label>
            <input type="text" class="form-control" id="gdebut_date" name="gdebut_date"
                    value="<?php echo htmlspecialchars($group['gdebut_date']); ?>" required>
            </div>

            <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" name="status"
                    value="<?php echo htmlspecialchars($group['status']); ?>" required>
            </div>

        <div class="mb-3">
        <label for="company_id" class="form-label">Company</label>
        <select class="form-select" id="company_id" name="company_id" required>
                <option value="">-- Pilih Company --</option>
                <?php foreach ($companies as $company): ?>
                <option value="<?= htmlspecialchars($company['company_id']); ?>"
                        <?= ($company['company_id'] == $group['company_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($company['company_id']) . " - " . htmlspecialchars($company['company_name']); ?>
                </option>
                <?php endforeach; ?>
        </select>
        </div>
