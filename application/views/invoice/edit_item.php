<!DOCTYPE html>
<html>
<head>
<title>Edit Item</title>

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
</style>

</head>

<body class="p-4">

<div class="container" style="max-width:700px;">

<div class="card">
<div class="card-body">

<h3 class="mb-3">Edit Item Invoice</h3>

<form method="post" action="<?= site_url('invoice/update_item') ?>">

<input type="hidden" name="id" value="<?= $item->id ?>">
<input type="hidden" name="invoice_id" value="<?= $item->invoice_id ?>">

<div class="form-group">
<label>Nama Item</label>
<input type="text"
name="nama_item"
class="form-control"
value="<?= $item->nama_item ?>"
required>
</div>

<div class="form-group">
<label>Qty</label>
<input type="number"
name="qty"
class="form-control"
value="<?= $item->qty ?>"
required>
</div>

<div class="form-group">
<label>Harga</label>
<input type="number"
name="harga"
class="form-control"
value="<?= $item->harga ?>"
required>
</div>

<button class="btn btn-success">
Update
</button>

<a href="<?= site_url('invoice/items/'.$item->invoice_id) ?>"
class="btn btn-secondary">
Batal
</a>

</form>

</div>
</div>

</div>

</body>
</html>