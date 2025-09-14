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
            "id" => $_GET['group_id'],
            "group_name" => $_GET['group_name'],
            "debut_date" => $_GET['gdebut_date'],
            "status" => $_GET['status'],
            "agency_id" => $_GET['company_id']
            ];
            
        ?>

        <form action="update_group.php" method="POST">
            <!-- hidden id -->
            <input type="hidden" name="id" value="<?php echo $agency['id']; ?>">

            <div class="mb-3">
            <label for="name" class="form-label">Nama Agensi</label>
            <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo htmlspecialchars($agency['name']); ?>" required>
            </div>

            <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address"
                    value="<?php echo htmlspecialchars($agency['address']); ?>" required>
            </div>

            <div class="mb-3">
            <label for="year" class="form-label">Tahun Berdiri</label>
            <input type="text" class="form-control" id="year" name="year"
                    value="<?php echo htmlspecialchars($agency['year']); ?>" required>
            </div>

            <div class="mb-3">
            <label for="ceo" class="form-label">CEO</label>
            <input type="text" class="form-control" id="ceo" name="ceo"
                    value="<?php echo htmlspecialchars($agency['ceo']); ?>" required>
