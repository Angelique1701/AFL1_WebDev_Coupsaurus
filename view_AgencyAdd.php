<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agency Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Add New Agency</h4>
        </div>
        <div class="card-body">
        <form action="controller.php?controller=agency&action=add" method="POST">
    <div class="mb-3">
        <label for="company_name" class="form-label">Agency Name</label>
        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Input the Agency Name" required>
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Example: Seoul, Busan, etc." required>
    </div>

    <div class="mb-3">
        <label for="founding_year" class="form-label">Founding Year</label>
        <input type="number" class="form-control" id="founding_year" name="founding_year" placeholder="Example: 2000" required>
    </div>

    <div class="mb-3">
        <label for="ceo_name" class="form-label">CEO Name</label>
        <input type="text" class="form-control" id="ceo_name" name="ceo_name" placeholder="Input the CEO Name" required>
    </div>

    <div class="text-center">
        <a href="controller.php?controller=agency&action=list" class="btn btn-secondary">Back to Agency List</a>
        <button type="submit" class="btn btn-primary px-4">Submit</button>
    </div>
</form>


        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
