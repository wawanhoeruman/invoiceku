<!DOCTYPE html>
<html>
<head>
<title>Daftar User</title>

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

<h4>Daftar User</h4>
<p class="text-muted">Semua data user</p>

<!-- NAV BUTTON -->
<a href="<?= site_url('user') ?>" class="btn btn-secondary btn-sm">← Menu</a>
<a href="<?= site_url('dashboard') ?>" class="btn btn-dark btn-sm">Dashboard</a>
<a href="<?= site_url('user/tambah') ?>" class="btn btn-primary btn-sm">
+ Tambah User
</a>

<hr>

<!-- SEARCH -->
<form method="get" class="mb-3">

    <input type="text" name="keyword"
           value="<?= isset($keyword)?$keyword:'' ?>"
           placeholder="Cari nama / username"
           class="form-control w-25 d-inline">

    <button class="btn btn-success btn-sm">Cari</button>

    <a href="<?= site_url('user/list') ?>" class="btn btn-secondary btn-sm">
        Reset
    </a>

</form>

<!-- TABLE -->
<table class="table table-bordered table-hover">

<thead class="thead-dark">
<tr>
    <th width="5%">No</th>
    <th>Nama</th>
    <th>Username</th>
    <th>Role</th>
    <th width="20%">Aksi</th>
</tr>
</thead>

<tbody>

<?php if(!empty($users)): ?>
    <?php $no=1; foreach($users as $u): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $u->nama ?></td>
        <td><?= $u->username ?></td>
        <td>
            <?php if($u->role == 'admin'): ?>
                <span class="badge badge-success">Admin</span>
            <?php else: ?>
                <span class="badge badge-secondary">Staff</span>
            <?php endif; ?>
        </td>

        <td>

            <a href="<?= site_url('user/edit/'.$u->id) ?>"
               class="btn btn-warning btn-sm">
               Edit
            </a>

            <?php if ($this->session->userdata('user_id') != $u->id): ?>
            <a href="<?= site_url('user/delete/'.$u->id) ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Yakin hapus user ini?')">
               Hapus
            </a>
            <?php endif; ?>

        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5" class="text-center text-muted">
        Belum ada data user
    </td>
</tr>
<?php endif; ?>

</tbody>

</table>

<div class="mt-3">
    <?= $pagination ?>
</div>
</div>
</div>

</body>
</html>