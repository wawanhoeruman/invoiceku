<!DOCTYPE html>
<html>
<head>
<title>Customer Menu</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
body{background:#f4f6f9;}
.main-box{
background:#fff;
border-radius:12px;
padding:30px;
box-shadow:0 8px 20px rgba(0,0,0,.08);
}
.menu-btn{
min-width:170px;
font-weight:600;
border-radius:8px;
}
.info-card{
border:none;
border-radius:10px;
color:#fff;
}
.blue{background:#17a2b8;}
.green{background:#28a745;}
.yellow{background:#ffc107;color:#222;}
.value{
font-size:28px;
font-weight:bold;
line-height:1;
}
</style>
</head>

<body class="p-4">

<div class="container-fluid">

<div class="main-box">

<h2 class="mb-1">Customer Menu</h2>
<p class="text-muted mb-4">
Kelola data customer dan pelanggan
</p>

<a href="<?= site_url('dashboard') ?>"
class="btn btn-secondary menu-btn mr-2 mb-2">
🏠 Dashboard
</a>

<a href="<?= site_url('customer/list') ?>"
class="btn btn-info menu-btn mr-2 mb-2">
📋 Daftar Customer
</a>

<a href="<?= site_url('customer/tambah') ?>"
class="btn btn-primary menu-btn mb-2">
➕ Tambah Customer
</a>

<div class="row mt-4">

<div class="col-md-4 mb-3">
<div class="card info-card blue">
<div class="card-body">
<div>Total Customer</div>
<div class="value">
<?= $total_customer ?>
</div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card info-card yellow">
<div class="card-body">
<div>Punya Telepon</div>
<div class="value">
<?= $with_phone ?>
</div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card info-card green">
<div class="card-body">
<div>Punya Email</div>
<div class="value">
<?= $with_email ?>
</div>
</div>
</div>
</div>

</div>

<div class="alert alert-light mt-3 mb-0">
Silakan pilih menu customer di atas.
</div>

</div>
</div>

</body>
</html>