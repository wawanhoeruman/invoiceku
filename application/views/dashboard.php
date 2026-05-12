<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>

body{
    background:#f4f6f9;
    font-family:Arial, sans-serif;
}

.sidebar{
    min-height:100vh;
}

.card-box{
    border:none;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    transition:all .25s ease;
    overflow:hidden;
}

.card-box:hover{
    transform:translateY(-4px);
    box-shadow:0 18px 35px rgba(0,0,0,0.12);
}

.big-number{
    font-size:34px;
    font-weight:700;
    line-height:1;
    margin-top:10px;
}

.card-title-small{
    font-size:14px;
    opacity:.95;
}

.card-icon{
    font-size:26px;
    float:right;
    opacity:.9;
    margin-top:-3px;
}

.table td,
.table th{
    vertical-align:middle;
}

.table thead th{
    background:#343a40;
    color:white;
}

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<!-- Sidebar -->
<div class="col-md-2 bg-dark text-white sidebar p-3">

<h4>INVOICEKU</h4>
<hr style="background:#fff;">

<p>
<a href="<?= site_url('dashboard'); ?>" class="text-white">
🏠 Dashboard
</a>
</p>

<!-- <p>
<a href="<?= site_url('user'); ?>" class="text-white">
👥 User Management
</a>
</p> -->

<?php if ($this->session->userdata('role') == 'admin'): ?>
<p>
<a href="<?= site_url('user'); ?>" class="text-white">
👥 User Management
</a>
</p>
<?php endif; ?>

<p>
<a href="<?= site_url('customer'); ?>" class="text-white">
👤 Customer
</a>
</p>

<p>
<a href="<?= site_url('invoice'); ?>" class="text-white">
🧾 Invoice
</a>
</p>

<?php if ($this->session->userdata('role') == 'admin'): ?>
<p>
<a href="<?= site_url('history'); ?>" class="text-white">
📄 History
</a>
</p>
<?php endif; ?>

<p>
<a href="<?= site_url('auth/logout'); ?>" class="text-danger">
🚪 Logout
</a>
</p>

</div>

<!-- Content -->
<div class="col-md-10 p-4">

<h2>Dashboard Invoiceku</h2>
<p>
Selamat datang,
<b><?= $nama; ?></b>
</p>

<!-- BARIS 1 -->
<div class="row mt-4">

<div class="col-md-4 mb-3">
<div class="card text-white card-box"
style="background:linear-gradient(135deg,#1e88e5,#42a5f5);">
<div class="card-body">
<div class="card-title-small">Total Customer</div>
<div class="card-icon">👤</div>
<div class="big-number"><?= $total_customer ?></div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-white card-box"
style="background:linear-gradient(135deg,#43a047,#66bb6a);">
<div class="card-body">
<div class="card-title-small">Total Invoice</div>
<div class="card-icon">🧾</div>
<div class="big-number"><?= $total_invoice ?></div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-white card-box"
style="background:linear-gradient(135deg,#00897b,#26a69a);">
<div class="card-body">
<div class="card-title-small">Omzet</div>
<div class="card-icon">💰</div>
<div class="big-number">
Rp <?= number_format($omzet,0,',','.') ?>
</div>
</div>
</div>
</div>

</div>

<!-- BARIS 2 -->
<div class="row">

<div class="col-md-4 mb-3">
<div class="card text-white card-box"
style="background:linear-gradient(135deg,#2e7d32,#43a047);">
<div class="card-body">
<div class="card-title-small">Paid</div>
<div class="card-icon">✅</div>
<div class="big-number"><?= $paid ?></div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-dark card-box"
style="background:linear-gradient(135deg,#f9a825,#fbc02d);">
<div class="card-body">
<div class="card-title-small">Pending</div>
<div class="card-icon">⏳</div>
<div class="big-number"><?= $pending ?></div>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-white card-box"
style="background:linear-gradient(135deg,#e53935,#ef5350);">
<div class="card-body">
<div class="card-title-small">Overdue</div>
<div class="card-icon">⚠️</div>
<div class="big-number"><?= $overdue ?></div>
</div>
</div>
</div>

</div>

<!-- Invoice terbaru -->
<div class="row mt-3">

<!-- LEFT -->
<div class="col-md-8 mb-3">

<div class="card card-box">

<div class="card-header bg-white">
<b>Recent Invoice</b>
</div>

<div class="card-body">

<?php foreach($latest as $l){ ?>

<div class="d-flex align-items-center border-bottom py-3">

<!-- KOLOM INVOICE -->
<div style="width:38%;">

<div style="font-weight:bold;">
<?= $l->nomor_invoice ?>
</div>

<small class="text-muted">
<?= date('d-m-Y', strtotime($l->tanggal)) ?>
</small>

</div>

<!-- KOLOM NOMINAL -->
<div style="width:22%;" class="text-right pr-3">

<?php
$today = strtotime(date('Y-m-d'));
$due   = !empty($l->due_date) ? strtotime($l->due_date) : 0;

if($l->status=='UNPAID' && $due > 0 && $today > $due){
?>

<span class="text-danger font-weight-bold">
Rp <?= number_format($l->grand_total,0,',','.') ?>
</span>

<?php } elseif($l->status=='UNPAID'){ ?>

<span class="text-warning font-weight-bold">
Rp <?= number_format($l->grand_total,0,',','.') ?>
</span>

<?php } else { ?>

<span class="text-muted">-</span>

<?php } ?>

</div>

<!-- KOLOM STATUS -->
<div style="width:20%;" class="text-center">

<?php
if($l->status=='UNPAID' && $due > 0 && $today > $due){
?>

<span class="badge badge-danger p-2">OVERDUE</span>

<?php } elseif($l->status=='UNPAID'){ ?>

<span class="badge badge-warning p-2">UNPAID</span>

<?php } else { ?>

<span class="badge badge-success p-2">PAID</span>

<?php } ?>

</div>

<!-- KOLOM BUTTON -->
<div style="width:20%;" class="text-right">

<a href="<?= site_url('invoice/items/'.$l->id) ?>"
class="btn btn-sm btn-primary">
Detail
</a>

</div>

</div>

<?php } ?>

</div>
</div>

</div>

<!-- RIGHT -->
<div class="col-md-4 mb-3">

<div class="card card-box">

<div class="card-header bg-white">
<b>Quick Summary</b>
</div>

<div class="card-body">

<div class="mb-3">
<div class="text-muted">📅 Hari Ini</div>
<h5><?= $today_invoice ?> Invoice</h5>
</div>

<div class="mb-3">
<div class="text-muted">💰 Omzet</div>
<h5>Rp <?= number_format($omzet,0,',','.') ?></h5>
</div>

<div class="mb-3">
<div class="text-muted">⚠️ Overdue</div>
<h5><?= $overdue ?></h5>
</div>

<div class="mb-0">
<div class="text-muted">⏳ Pending</div>
<h5><?= $pending ?></h5>
</div>

</div>
</div>

</div>

</div>

</div>

</div>
</div>

</body>
</html>