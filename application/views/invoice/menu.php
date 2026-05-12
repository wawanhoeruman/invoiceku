<!DOCTYPE html>
<html>
<head>
<title>Invoice Menu</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>

body{
    background:#f4f6f9;
}

.main-box{
    background:#fff;
    border-radius:12px;
    padding:30px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
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

.card-blue{
    background:#17a2b8;
}

.card-green{
    background:#28a745;
}

.card-orange{
    background:#ffc107;
    color:#222;
}

.card-value{
    font-size:28px;
    font-weight:bold;
    line-height:1;
}

</style>

</head>

<body class="p-4">

<div class="container-fluid px-4">

<div class="main-box">

<h2 class="mb-1">Invoice Menu</h2>
<p class="text-muted mb-4">
Kelola data invoice dan transaksi customer
</p>

<div class="mb-4">

<a href="<?= site_url('dashboard') ?>"
class="btn btn-secondary menu-btn mr-2 mb-2">
🏠 Dashboard
</a>

<a href="<?= site_url('invoice/list') ?>"
class="btn btn-info menu-btn mr-2 mb-2">
📄 Daftar Invoice
</a>

<a href="<?= site_url('invoice/create') ?>"
class="btn btn-success menu-btn mb-2">
➕ Buat Invoice
</a>

</div>

<div class="row">

<div class="col-md-4 mb-3">
<div class="card info-card card-blue">
<div class="card-body">
<div>Total Invoice</div>
<div class="card-value">
<?= $total_invoice ?>
</div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card info-card card-orange">
<div class="card-body">
<div>Unpaid</div>
<div class="card-value">
<?= $pending ?>
</div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card info-card card-green">
<div class="card-body">
<div>Paid</div>
<div class="card-value">
<?= $paid ?>
</div>
</div>
</div>
</div>

</div>

<div class="alert alert-light mt-3 mb-0">
Silakan pilih menu invoice di atas untuk mulai mengelola transaksi.
</div>

</div>

</div>

</body>
</html>