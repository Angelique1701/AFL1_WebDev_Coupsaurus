<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Update Agency</h4>
        </div>
        <div class="card-body">
            <form action="controller.php?controller=agency&action=update" method="POST">
                <input type="hidden" name="company_id" value="<?= htmlspecialchars($agency['company_id']); ?>">

                <div class="mb-3">
                    <label for="company_name" class="form-label">Agency Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        value="<?= htmlspecialchars($agency['company_name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location"
                        value="<?= htmlspecialchars($agency['location']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="founding_year" class="form-label">Founding Year</label>
                    <input type="text" class="form-control" id="founding_year" name="founding_year"
                        value="<?= htmlspecialchars($agency['founding_year']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="ceo_name" class="form-label">CEO Name</label>
                    <input type="text" class="form-control" id="ceo_name" name="ceo_name"
                        value="<?= htmlspecialchars($agency['ceo_name']); ?>" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Update Agency</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>