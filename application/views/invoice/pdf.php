<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:13px;
    color:#222;
}

.header{
    width:100%;
    margin-bottom:20px;
}

.logo{
    width:130px;
    height:90px;
    float:left;
}

.logo img{
    width:120px;
    height:auto;
}

.company{
    margin-left:150px;
    padding-top:5px;
}

.company h2{
    margin:0;
    color:#2c3e50;
}

.company p{
    margin:3px 0;
    font-size:12px;
    color:#555;
}

.clear{
    clear:both;
}

.invoice-box{
    margin-top:20px;
    margin-bottom:20px;
}

.invoice-title{
    font-size:26px;
    font-weight:bold;
    color:#2c3e50;
}

.badge{
    display:inline-block;
    padding:4px 10px;
    font-size:11px;
    font-weight:bold;
    color:#fff;
    border-radius:3px;
    vertical-align:middle;
    line-height:1.2;
    margin-left:6px;
}

.paid{
    background:#28a745;
}

.unpaid{
    background:#f39c12;
}

.info{
    width:100%;
    margin-top:20px;
}

.info td{
    vertical-align:top;
    padding:5px;
}

table.items{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table.items th{
    background:#2c3e50;
    color:white;
    padding:10px;
    border:1px solid #ddd;
}

table.items td{
    padding:8px;
    border:1px solid #ddd;
}

.text-right{
    text-align:right;
}

.total{
    margin-top:15px;
    text-align:right;
    font-size:22px;
    font-weight:bold;
    color:#27ae60;
}

.footer{
    margin-top:50px;
    font-size:12px;
    color:#666;
}

.watermark{
    position:fixed;
    top:42%;
    left:28%;
    font-size:95px;
    color:rgba(0,0,0,0.05);
    transform:rotate(-30deg);
    z-index:-1;
}

</style>
</head>

<body>

<?php if($invoice->status == 'PAID'){ ?>
<div class="watermark">PAID</div>
<?php } ?>

<div class="header">

<div class="logo">
<img src="/var/www/html/invoiceku/assets/logo1.png" width="80">
</div>

<div class="company">
<h2>PT Siwastore Production</h2>
<p>Jl. Skasirna No. 123 Tasikmalaya</p>
<p>Telp: 0812-0000-0000</p>
<p>Email: info@siwastore.com</p>
</div>

<div class="clear"></div>

</div>

<hr>

<div class="invoice-box">

<div class="invoice-title">
INVOICE
</div>

<<br>

<?php
$today = strtotime(date('Y-m-d'));
$due   = !empty($invoice->due_date) ? strtotime($invoice->due_date) : 0;

$status_text  = 'UNPAID';
$status_style = 'background:#f0ad4e;color:#fff;'; // kuning
$show_paid_date = false;

if($invoice->status == 'PAID'){
    $status_text  = 'PAID';
    $status_style = 'background:#28a745;color:#fff;'; // hijau
    $show_paid_date = true;
}
elseif($invoice->status == 'UNPAID' && $due > 0 && $today > $due){
    $status_text  = 'OVERDUE';
    $status_style = 'background:#dc3545;color:#fff;'; // merah
}
?>

<b>No Invoice:</b> <?= $invoice->nomor_invoice ?><br>

<!-- <b>Tanggal Invoice:</b>
<?= date('d-m-Y', strtotime($invoice->tanggal)) ?><br> -->

<?php if($show_paid_date && !empty($invoice->paid_at)){ ?>
<b>Tanggal Bayar:</b>
<?= date('d-m-Y H:i', strtotime($invoice->paid_at)) ?><br>
<?php } ?>

<div style="margin-top:5px;">

<b style="display:inline-block; width:70px;">
Status:
</b>

<span style="padding:4px 10px;border-radius:4px;<?= $status_style ?>">
<?= $status_text ?>
</span>

</div>

<table class="info">

<tr>

<td width="50%">
<b>Bill To:</b><br><br>
<?= $invoice->nama ?><br>
<?= $invoice->alamat ?><br>
<?= $invoice->telepon ?>
</td>

<td width="50%" class="text-right">
Terima kasih atas kepercayaan Anda.
</td>

</tr>

</table>

<table class="items">

<tr>
<th>Nama Item</th>
<th width="70">Qty</th>
<th width="130">Harga</th>
<th width="150">Subtotal</th>
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
</tr>

<?php } ?>

</table>

<div class="total">
TOTAL : Rp <?= number_format($invoice->grand_total,0,',','.') ?>
</div>

<div class="footer">
    
Pembayaran dapat ditransfer ke:<br>
BCA 1234567890 a/n PT Contoh Maju Jaya

<br><br>

Invoice ini sah dan diterbitkan oleh sistem.

</div>

</body>
</html>