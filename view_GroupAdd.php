<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Group</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Add New Group</h4>
    </div>
    <div class="card-body">
    <form action="controller.php?controller=group&action=add" method="POST">
    
    <input type="hidden" name="company_id" value="<?= htmlspecialchars($_GET['agency_id']); ?>">

    <div class="mb-3">
        <label for="group_name" class="form-label">Group Name</label>
        <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Input the Group Name" required>
    </div>

    <div class="mb-3">
        <label for="gdebut_date" class="form-label">Debut Date</label>
        <input type="date" class="form-control" id="gdebut_date" name="gdebut_date" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="Active">Active</option>
            <option value="Hiatus">Hiatus</option>
            <option value="Disband">Disband</option>
        </select>
    </div>

    <div class="text-center">
        <a href="controller.php?controller=group&action=list" class="btn btn-secondary">Back to Group List</a>
        <button type="submit" class="btn btn-primary px-4">Submit</button>
    </div>
</form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>