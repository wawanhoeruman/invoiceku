<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>🕘 Activity Log</h4>

    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary btn-sm">
        ← Dashboard
    </a>
</div>

<!-- FILTER -->
<form method="get" class="card p-3 mb-3 shadow-sm">

<div class="form-row">

<div class="col-md-3 mb-2">
    <input type="text" name="keyword" class="form-control"
    placeholder="Search activity..."
    value="<?= $keyword ?>">
</div>

<div class="col-md-3 mb-2">
    <input type="date" name="dari" class="form-control"
    value="<?= $dari ?>">
</div>

<div class="col-md-3 mb-2">
    <input type="date" name="sampai" class="form-control"
    value="<?= $sampai ?>">
</div>

<div class="col-md-3 mb-2 d-flex">

    <button class="btn btn-primary mr-2 w-50">
        Filter
    </button>

    <a href="<?= site_url('history') ?>"
       class="btn btn-secondary w-50">
       🔄 Reset
    </a>

</div>

</div>

</form>

<!-- TABLE -->
<div class="card shadow-sm">

<div class="card-body p-0">

<table class="table table-hover mb-0">

<thead class="thead-dark">
<tr>
    <th>Waktu</th>
    <th>User</th>
    <th>Aktivitas</th>
    <th>Deskripsi</th>
    <th>IP</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php if(empty($logs)): ?>
<tr>
    <td colspan="4" class="text-center text-muted">
        Tidak ada data
    </td>
</tr>
<?php endif; ?>

<?php foreach($logs as $log): ?>

<?php
$color = 'secondary';

if($log->activity == 'CREATE_CUSTOMER') $color = 'success';
if($log->activity == 'DELETE_CUSTOMER') $color = 'danger';
if($log->activity == 'UPDATE_CUSTOMER') $color = 'warning';
if($log->activity == 'CREATE_INVOICE')  $color = 'primary';
if($log->activity == 'PAID_INVOICE')    $color = 'dark';
?>

<tr>
<td><?= date('d M Y H:i', strtotime($log->created_at)) ?></td>

<td>
    <?= $log->user_nama ? $log->user_nama : '-' ?>
</td>

<td>
<span class="badge badge-<?= $color ?>">
<?= $log->activity ?>
</span>
</td>

<td><?= $log->description ?></td>
<td><?= $log->ip_address ?></td>

<td>
    <a href="<?= site_url('history/hapus/'.$log->id) ?>"
       class="btn btn-sm btn-danger"
       onclick="return confirm('Yakin hapus log ini?')">
       Hapus
    </a>
</td>

</tr>

<?php endforeach; ?>

</tbody>

<div class="text-muted mb-2">
    Menampilkan <?= count($logs) ?> data
</div>

</table>
<?= $pagination ?>

</div>
</div>

</div>