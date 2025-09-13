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
        <form>
            <div class="mb-3">
            <label for="name" class="form-label">Nama Agensi</label>
            <input type="text" class="form-control" id="name" placeholder="Masukkan nama agensi">
            </div>

            <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" placeholder="Masukkan alamat">
            </div>

            <div class="mb-3">
            <label for="year" class="form-label">Tahun Berdiri</label>
            <input type="text" class="form-control" id="year" placeholder="Contoh: 2001">
            </div>

            <div class="mb-3">
            <label for="ceo" class="form-label">CEO</label>
            <input type="text" class="form-control" id="ceo" placeholder="Masukkan nama CEO">
            </div>

            <div class="text-center">
            <button type="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
