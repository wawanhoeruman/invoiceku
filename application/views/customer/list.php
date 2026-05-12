<!DOCTYPE html>
<html>
<head>
<title>Daftar Customer</title>

<meta charset="utf-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>

body{
    background:#f4f6f9;
}

.main-box{
    background:#fff;
    border-radius:12px;
    padding:25px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

.table th{
    background:#343a40;
    color:#fff;
    vertical-align:middle;
}

.table td{
    vertical-align:middle;
}

.pagination{
    margin-bottom:0;
}

</style>

</head>

<body class="p-4">

<div class="container-fluid">

<div class="main-box">

<div class="d-flex justify-content-between align-items-center mb-3">

<div>
<h2 class="mb-0">Daftar Customer</h2>
<small class="text-muted">
Semua data customer
</small>
</div>

<div>

<a href="<?= site_url('customer'); ?>"
class="btn btn-secondary btn-sm">
Back
</a>

<a href="<?= site_url('customer/tambah'); ?>"
class="btn btn-primary btn-sm">
+ Tambah Customer
</a>

</div>

</div>

<form method="get"
action="<?= site_url('customer/list') ?>"
class="mb-3">

<div class="row">

<div class="col-md-4">
<input type="text"
name="keyword"
class="form-control form-control-sm"
placeholder="Cari nama / telepon / email..."
value="<?= isset($keyword)?$keyword:''; ?>">
</div>

<div class="col-md-2">
<button type="submit"
class="btn btn-success btn-sm btn-block">
Cari
</button>
</div>

<div class="col-md-2">
<a href="<?= site_url('customer/list'); ?>"
class="btn btn-secondary btn-sm btn-block">
Reset
</a>
</div>

</div>

</form>

<div class="table-responsive">

<table class="table table-bordered table-hover mb-0">

<tr>
<th width="70">ID</th>
<th>Nama</th>
<th>Telepon</th>
<th>Email</th>
<th>Alamat</th>
<th width="150">Aksi</th>
</tr>

<?php foreach($customer as $c){ ?>

<tr>

<td><?= $c->id; ?></td>
<td><?= $c->nama; ?></td>
<td><?= $c->telepon; ?></td>
<td><?= $c->email; ?></td>
<td><?= $c->alamat; ?></td>

<td>

<a href="<?= site_url('customer/edit/'.$c->id); ?>"
class="btn btn-warning btn-sm">
Edit
</a>

<a href="<?= site_url('customer/hapus/'.$c->id); ?>"
onclick="return confirm('Yakin hapus?')"
class="btn btn-danger btn-sm">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<div class="mt-3">
<?= $paging; ?>
</div>



</div>

</div>

</body>
</html>