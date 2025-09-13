<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delete Agency</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h1 class="h3 mb-4">Delete Agency</h1>

  <div class="card shadow">
    <div class="card-body p-0">
      <table class="table table-hover table-bordered mb-0">
        <thead class="table-light">
          <tr class="text-center">
            <th>ID</th>
            <th>Name</th>
            <th>CEO</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($agencies as $agency): ?>
          <tr>
            <td class="text-center"><?= htmlspecialchars($agency['id']); ?></td>
            <td><?= htmlspecialchars($agency['name']); ?></td>
            <td><?= htmlspecialchars($agency['ceo']); ?></td>
            <td class="text-center">
              <a href="delete_agency.php?id=<?= $agency['id']; ?>" 
                 class="btn btn-sm btn-danger"
                 onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars($agency['name']); ?>?');">
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

