<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">

<h4>Edit User</h4>
<hr>

<form method="post" action="<?= site_url('user/update') ?>">

<input type="hidden" name="id" value="<?= $user->id ?>">

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="nama"
           value="<?= $user->nama ?>"
           class="form-control" required>
</div>

<div class="form-group">
    <label>Username</label>
    <input type="text" name="username"
           value="<?= $user->username ?>"
           class="form-control" required>
</div>

<div class="form-group">
    <label>Password (kosongkan jika tidak diubah)</label>
    <input type="password" name="password"
           class="form-control">
</div>

<div class="form-group">
    <label>Role</label>
    <select name="role" class="form-control" required>
        <option value="admin" <?= $user->role=='admin'?'selected':'' ?>>
            Admin
        </option>
        <option value="staff" <?= $user->role=='staff'?'selected':'' ?>>
            Staff
        </option>
    </select>
</div>

<button type="submit" class="btn btn-success">
Update
</button>

<a href="<?= site_url('user') ?>" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</body>
</html>