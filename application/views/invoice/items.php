<!DOCTYPE html>
<html>
<head>
<title>Detail Invoice</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>

body{
    background:#f8f9fa;
}

.card{
    border:none;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

.table th{
    background:#343a40;
    color:white;
}

.total-box{
    font-size:28px;
    font-weight:bold;
    color:#28a745;
}

</style>

</head>

<body class="p-4">

<div class="container">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">

<div>
<h2 class="mb-0">Detail Invoice</h2>
<small class="text-muted">
<?= $invoice->nomor_invoice ?>
</small>
</div>

<div>

<!-- <a href="<?= site_url('invoice/list') ?>"
class="btn btn-secondary btn-sm">
Kembali
</a>
 -->
<a href="javascript:history.back()"
class="btn btn-secondary btn-sm">
Back
</a>

<a href="<?= site_url('invoice/pdf/'.$invoice->id) ?>"
class="btn btn-dark btn-sm"
target="_blank">
PDF
</a>

<?php if($invoice->status == 'UNPAID'){ ?>

<a href="<?= site_url('invoice/paid/'.$invoice->id) ?>"
class="btn btn-success btn-sm"
onclick="return confirm('Tandai invoice ini sudah dibayar?')">
Tandai PAID
</a>

<?php }else{ ?>

<span class="btn btn-success btn-sm disabled">
PAID ✓
</span>
<?php } ?>

</div>

</div>

</div>

<!-- INFO -->
<div class="card mb-3">
<div class="card-body">

<div class="row">

<div class="col-md-6">
<b>Customer:</b><br>
<!-- versilama -->
<!-- <?= $invoice->nama ?> -->
<?= $invoice->nama ? $invoice->nama : '<i class="text-danger">Customer dihapus</i>' ?>
</div>

<div class="col-md-6">
<b>Tanggal:</b><br>
<?= date('d-m-Y', strtotime($invoice->tanggal)) ?>
</div>

<?php if($invoice->status == 'PAID' && $invoice->paid_at){ ?>

<div class="col-md-6 mt-3">
<b>Tanggal Dibayar:</b><br>
<?= date('d-m-Y H:i', strtotime($invoice->paid_at)) ?>
</div>

<?php } ?>
</div>

</div>
</div>

<?php if($invoice->status == 'UNPAID'){ ?>

<!-- FORM TAMBAH ITEM -->
<div class="card mb-3">
<div class="card-body">

<form method="post" action="<?= site_url('invoice/tambah_item') ?>">

<input type="hidden" name="invoice_id" value="<?= $invoice->id ?>">

<div class="row">

<div class="col-md-5">
<input type="text" name="nama_item" class="form-control" placeholder="Nama Item" required>
</div>

<div class="col-md-2">
<input type="number" name="qty" class="form-control" placeholder="Qty" required>
</div>

<div class="col-md-3">
<input type="number" name="harga" class="form-control" placeholder="Harga" required>
</div>

<div class="col-md-2">
<button class="btn btn-primary btn-block">
Tambah
</button>
</div>

</div>

</form>

</div>
</div>

<?php } ?>

<!-- TABLE ITEM -->
<div class="card">

<div class="card-body p-0">

<table class="table table-bordered mb-0">

<tr>
<th>Item</th>
<th width="90">Qty</th>
<th width="150">Harga</th>
<th width="170">Subtotal</th>
<th width="150">Aksi</th>
</tr>

<?php foreach($items as $i){ ?>

<tr>

<td><?= $i->nama_item ?></td>

<td><?= $i->qty ?></td>

<td class="text-right">
Rp <?= number_format($i->harga,0,',','.') ?>
</td>

<td class="text-right">
Rp <?= number_format($i->subtotal,0,',','.') ?>
</td>

<td class="text-center">

<?php if($invoice->status == 'UNPAID'){ ?>

<a href="<?= site_url('invoice/edit_item/'.$i->id) ?>"
class="btn btn-warning btn-sm mr-1">
Edit
</a>

<a href="<?= site_url('invoice/hapus_item/'.$i->id.'/'.$invoice->id) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus item ini?')">
Hapus
</a>

<?php } else { ?>

<button class="btn btn-secondary btn-sm" disabled>
Locked
</button>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<!-- TOTAL -->
<div class="text-right mt-3 total-box">
Total: Rp <?= number_format($invoice->grand_total,0,',','.') ?>
</div>

<!-- FOOTER BUTTON -->
<?php if($invoice->status == 'UNPAID'){ ?>

<div class="mt-3">

<a href="<?= site_url('invoice/list') ?>"
class="btn btn-success">
✓Selesai
</a>

</div>

<?php } ?>

</div>

</body>
</html>