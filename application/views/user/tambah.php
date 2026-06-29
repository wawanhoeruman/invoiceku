<!DOCTYPE html>
<html>
<head>
<title>Tambah User</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
/* Disamakan 100% dengan style menu utama dan list milik Mas Wawan */
body{
    background:#f4f6f9;
}

.main-box{
    background:#fff;
    border-radius:12px;
    padding:30px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

.form-control {
    border-radius:8px;
    padding:10px 15px;
    height:auto;
}

.form-control:focus {
    border-color: #17a2b8;
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
}

label {
    font-weight:600;
    color:#495057;
}
</style>

</head>

<body class="p-4">

<div class="container-fluid px-4">

<div class="main-box">

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-1">Tambah User</h2>
        <p class="text-muted mb-0">Tambahkan user baru ke sistem</p>
    </div>
    <div>
        <a href="<?= site_url('user/list') ?>" class="btn btn-secondary btn-sm" style="min-width:60px; font-weight:600; border-radius:8px;">
        ← Back
        </a>
    </div>
</div>

<hr class="mb-4">

<form method="post" action="<?= site_url('user/simpan') ?>">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label><i class="fas fa-user text-muted mr-1"></i> Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        
        <div class="form-group col-md-6">
            <label><i class="fas fa-id-card text-muted mr-1"></i> Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label><i class="fas fa-envelope text-muted mr-1"></i> Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" required>
        </div>
        
        <div class="form-group col-md-6">
            <label><i class="fas fa-lock text-muted mr-1"></i> Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
    </div>

    <div class="form-group">
        <label><i class="fas fa-user-shield text-muted mr-1"></i> Role</label>
        <select name="role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
        </select>
    </div>

    <hr class="my-4">

    <button type="submit" class="btn btn-success px-4 py-2" style="font-weight:600; border-radius:8px;">
        <i class="fas fa-save mr-1"></i> Simpan User
    </button>

</form>

</div>
</div>

</body>
</html>