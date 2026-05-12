<!DOCTYPE html>
<html>
<head>
    <title>Form Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Buat Invoice</h2>

<a href="<?= site_url('invoice') ?>" class="btn btn-secondary btn-sm">
Back
</a>

<hr>

<form method="post" action="<?= site_url('invoice/simpan') ?>">

<div class="form-group">
<label>Nomor Invoice</label>
<input type="text"
name="nomor_invoice"
class="form-control"
value="<?= $nomor_invoice ?>"
readonly>
</div>

<div class="form-group">
<label>Customer</label>
<select name="customer_id" class="form-control" required>

<option value="">-- Pilih Customer --</option>

<?php foreach($customer as $c){ ?>
<option value="<?= $c->id ?>">
<?= $c->nama ?>
</option>
<?php } ?>

</select>
</div>

<div class="form-group">
<label>Tanggal</label>
<input type="date"
name="tanggal"
class="form-control"
value="<?= date('Y-m-d') ?>">
</div>

<div class="form-group">
<label>Jatuh Tempo</label>

<input type="date"
name="due_date"
class="form-control"
value="<?= date('Y-m-d', strtotime('+5 days')) ?>"
required>

<small class="text-muted">
Default 5 hari dari hari ini
</small>
</div>

<div class="form-group">
<label>Status</label>
<input type="text"
class="form-control"
value="UNPAID"
readonly>
</div>

<button type="submit" class="btn btn-primary">
Lanjut
</button>

</form>

</body>
</html>