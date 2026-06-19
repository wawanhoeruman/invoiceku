<!DOCTYPE html>
<html>
<head>
<title>Daftar Invoice</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>

body{
    background:#f8f9fa;
}

.table th{
    background:#343a40;
    color:white;
    vertical-align:middle;
}

.table td{
    vertical-align:middle;
}

.card{
    border:none;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

</style>

</head>


<body class="p-4">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">

<div>
<h2 class="mb-0">Daftar Invoice</h2>
<small class="text-muted">
Semua data invoice customer
</small>
</div>

<div>
<a href="<?= site_url('invoice') ?>"
class="btn btn-secondary btn-sm">
Back
</a>

<a href="<?= site_url('invoice/create') ?>"
class="btn btn-success btn-sm">
+ Buat Invoice
</a>

</div>

</div>
<div class="card mb-3">
<div class="card-body py-3">

<form method="get" action="<?= site_url('invoice/list') ?>">

<!-- BARIS FILTER -->
<div class="form-row align-items-end mb-2">

<div class="col-md-2">
<label>Dari</label>
<input type="date"
name="dari"
class="form-control"
value="<?= isset($dari)?$dari:'' ?>">
</div>

<div class="col-md-2">
<label>Sampai</label>
<input type="date"
name="sampai"
class="form-control"
value="<?= isset($sampai)?$sampai:'' ?>">
</div>

<div class="col-md-1">
<button class="btn btn-primary btn-block"
style="height: calc(2.25rem + 2px);">
Apply
</button>
</div>

<div class="col-md-1">
<a href="<?= site_url('invoice/list') ?>"
class="btn btn-secondary btn-block"
style="height: calc(2.25rem + 2px); line-height:22px;">
Reset
</a>
</div>

</div>

<!-- BARIS SEARCH -->
<div class="form-row">

<div class="col-md-4">
<input type="text"
name="keyword"
class="form-control"
placeholder="Cari invoice / customer / status"
value="<?= isset($keyword)?$keyword:'' ?>">
</div>

<div class="col-md-1">
<button class="btn btn-primary btn-block"
style="height: calc(2.25rem + 2px);">
Search
</button>
</div>

</div>

</form>

</div>

</div>
<div class="card">
<div class="card-body p-0">

<table class="table table-hover table-bordered mb-0">

<tr>
<th width="60">No</th>
<th>Nomor Invoice</th>
<th>Customer</th>
<th width="120">Tanggal</th>
<th width="120">Jatuh Tempo</th>
<th width="120">Status</th>
<th width="150">Total</th>
<th width="180">Abits</th>
</tr>

<?php 
// Kita siapkan penampung nomor halaman (nanti diisi lewat JavaScript di bawah)
?>
<?php $no=1; foreach($invoice as $i){ ?>

<tr class="invoice-row">

<!-- Beri class target-no agar bisa ditembak angkanya lewat script -->
<td class="target-no"><?= $no++ ?></td>

<td>
<strong><?= $i->nomor_invoice ?></strong>
</td>

<td><?= $i->nama ?></td>

<td>
<?= date('d-m-Y', strtotime($i->tanggal)) ?>
</td>

<td>
<?= date('d-m-Y', strtotime($i->due_date)) ?>
</td>

<td>

<?php
$today = strtotime(date('Y-m-d'));
$due   = !empty($i->due_date) ? strtotime($i->due_date) : 0;

if(
    $i->status == 'UNPAID' &&
    $due > 0 &&
    $today > $due
){
?>

<?php $telat = floor(($today - $due) / 86400); ?>

<span class="badge badge-danger p-2">
OVERDUE <?= $telat ?> Hari
</span>

<?php } elseif($i->status == 'UNPAID'){ ?>

<span class="badge badge-warning p-2">
UNPAID
</span>

<?php } else { ?>

<span class="badge badge-success p-2">
PAID
</span>

<?php } ?>

</td>

<td class="text-right">
Rp <?= number_format($i->grand_total,0,',','.') ?>
</td>

<td>

<a href="<?= site_url('invoice/items/'.$i->id) ?>"
class="btn btn-info btn-sm">
Detail
</a>

<?php if($i->status == 'UNPAID'){ ?>

<a href="<?= site_url('invoice/hapus/'.$i->id) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus invoice ini?')">
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

<div class="d-flex justify-content-between align-items-center p-3">

<div class="d-flex align-items-center" id="pagination-wrapper">
    <!-- Tombol Pagination -->
    <div class="mr-3">
        <?= $pagination ?>
    </div>
    
    <!-- Informasi Urutan Baris Data yang Sedang Tampil -->
    <span class="badge badge-secondary p-2" id="showing-text" style="font-size: 13px;">
        Showing Baris: 1 - <?= count($invoice) ?>
    </span>
</div>

<div>
<a href="<?= site_url('invoice/export?keyword='.$keyword.'&dari='.$dari.'&sampai='.$sampai) ?>"
class="btn btn-success btn-sm"
>

<i class="fas fa-file-excel" style="font-size:14px;"></i>

</a>

</div>

</div>


</div>
</div>

</div>

<!-- JAVASCRIPT OTOMATIS HITUNG NOMOR BARIS -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Cari tombol halaman yang sedang aktif di pagination CodeIgniter kamu
    // Biasanya menggunakan class 'active' atau tag <strong> bawaan CI
    let activePageElement = document.querySelector('#pagination-wrapper .active, #pagination-wrapper strong, #pagination-wrapper .page-item.active a');
    
    let currentPage = 1;
    if (activePageElement) {
        let pageText = activePageElement.innerText.trim();
        if (!isNaN(pageText) && pageText !== "") {
            currentPage = parseInt(pageText);
        }
    }

    // 2. Tentukan limit baris data kamu (yaitu 5)
    let limit = 5;
    let startNo = ((currentPage - 1) * limit) + 1;

    // 3. Update Kolom Nomor di Tabel secara paksa lewat Browser
    let rows = document.querySelectorAll('.target-no');
    rows.forEach(function(row, index) {
        row.innerText = startNo + index;
    });

    // 4. Update Teks "Showing Baris: X - Y" di bawah samping tombol Next
    let showingText = document.getElementById('showing-text');
    if (showingText && rows.length > 0) {
        let endNo = startNo + rows.length - 1;
        showingText.innerText = "Showing Baris: " + startNo + " - " + endNo;
    }
});
</script>

</body>
</html>