<!DOCTYPE html>
<html>
<head>
<title>User Menu</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
.box{
    border-radius:10px;
    padding:20px;
    color:white;
}
</style>

</head>

<body>

<div class="container mt-4">

<h4>User Management</h4>
<hr>
<p class="text-muted">Kelola data user sistem</p>

<!-- BUTTON -->
<a href="<?= site_url('dashboard') ?>" class="btn btn-secondary btn-sm">🏠 Dashboard</a>
<a href="<?= site_url('user/list') ?>" class="btn btn-info btn-sm">📋 Daftar User</a>
<a href="<?= site_url('user/tambah') ?>" class="btn btn-primary btn-sm">+ Tambah User</a>

<hr>

<!-- CARD -->
<div class="row mt-3">

<div class="col-md-4">
<div class="box bg-info">
    Total User
    <h4><?= $total_user ?></h4>
</div>
</div>

<div class="col-md-4">
<div class="box bg-success">
    Admin
    <h4><?= $total_admin ?></h4>
</div>
</div>

<div class="col-md-4">
<div class="box bg-secondary">
    Staff
    <h4><?= $total_staff ?></h4>
</div>
</div>

</div>

</div>

</body>
</html>