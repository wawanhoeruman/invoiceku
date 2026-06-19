<!DOCTYPE html>
<html>
<head>
<title>Tambah User</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
.container-box{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}
</style>

</head>

<body>

<div class="container mt-4">

<div class="container-box">

<h4>Tambah User</h4>
<p class="text-muted">Tambahkan user baru ke sistem</p>

<!-- NAV -->
<a href="<?= site_url('user/list') ?>" class="btn btn-secondary btn-sm mb-3">
← Kembali
</a>

<hr>

<form method="post" action="<?= site_url('user/simpan') ?>">

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
</div>

<div class="form-group">
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
</div>

<!-- //input baru// -->
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" required>
</div>

<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
</div>

<div class="form-group">
    <label>Role</label>
    <select name="role" class="form-control" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select>
</div>

<button type="submit" class="btn btn-success">
Simpan User
</button>

</form>

</div>
</div>

</body>
</html>