<!DOCTYPE html>
<html>
<head>
<title>Activity Log</title>

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
    /* background:#343a40; */
    background: #3899e4;
    color:#fff;
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

.form-control {
    border-radius:8px;
}
</style>
</head>

<body class="p-4">

<div class="container-fluid px-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-0">Activity Log</h2>
        <small class="text-muted">Jejak aktivitas dan log sistem</small>
    </div>
    <div>
        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary btn-sm" style="min-width:120px; font-weight:600; border-radius:8px;">
            ← Dashboard
        </a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body py-2"> <form method="get">
            
            <div class="form-row mb-1">
                <div class="col-auto">
                    <label class="font-weight-bold text-muted small mb-0">Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control form-control-sm" value="<?= $dari ?>" style="max-width: 160px;">
                </div>
                <div class="col-auto">
                    <label class="font-weight-bold text-muted small mb-0">Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control form-control-sm" value="<?= $sampai ?>" style="max-width: 160px;">
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="col-md-3">
                    <label class="font-weight-bold text-muted small mb-0">Cari Aktivitas</label>
                    <input type="text" name="keyword" class="form-control form-control-sm"
                           placeholder="Search activity..."
                           value="<?= $keyword ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 d-flex">
                    <button type="submit" class="btn btn-primary btn-sm mr-2 w-50" style="font-weight:600; border-radius:8px; height: 32px;">
                        Filter
                    </button>
                    <a href="<?= site_url('history') ?>" class="btn btn-secondary btn-sm w-50" style="line-height:20px; font-weight:600; border-radius:8px; height: 32px;">
                        🔄 Reset
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="card">
<div class="card-body p-0">

    <div class="table-responsive">
        <table class="table table-hover table-bordered mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th width="15%">Waktu</th>
                    <th width="15%">User</th>
                    <th width="15%">Aktivitas</th>
                    <th>Deskripsi</th>
                    <th width="12%">IP</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($logs)): ?>
                <!-- JIKA DATA KOSONG / TIDAK DITEMUKAN (VERSI RAMPING & ESTETIK) -->
                <tr class="no-data-row">
                    <td colspan="7" class="text-center text-muted py-3 small font-weight-bold">
                        <i class="fas fa-search mr-2 text-secondary"></i>
                        Data aktivitas tidak ditemukan.
                    </td>
                </tr>
            <?php else: ?>
                <!-- JIKA DATA ADA, BARU DI-FOREACH -->
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
                        <td class="target-no">1</td>
                        <td><?= date('d M Y H:i', strtotime($log->created_at)) ?></td>
                        <td><strong><?= $log->user_nama ? $log->user_nama : '-' ?></strong></td>
                        <td>
                            <span class="badge badge-<?= $color ?> p-2 btn-block text-center" style="font-size:11px;">
                                <?= $log->activity ?>
                            </span>
                        </td>
                        <td><?= $log->description ?></td>
                        <td><code class="text-dark"><?= $log->ip_address ?></code></td>
                        <td>
                            <a href="<?= site_url('history/hapus/'.$log->id) ?>"
                               class="btn btn-sm btn-danger btn-block"
                               onclick="return confirm('Yakin hapus log ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center p-3">
        <div class="d-flex align-items-center" id="pagination-wrapper">
            <div class="mr-3">
                <?= $pagination ?>
            </div>
            <span class="badge badge-dark p-2" id="showing-text" style="font-size: 13px; font-weight: normal; border-radius: 4px;">
                Showing 0 to 0 entries
            </span>
        </div>
    </div>

</div>
</div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // JIKA YANG MUNCUL ADALAH PESAN "TIDAK ADA DATA LOG", AMANKAN TEKS DAN STOP SCRIPT
    if (document.querySelector('.no-data-row')) {
        let showingText = document.getElementById('showing-text');
        if (showingText) {
            showingText.innerText = "Showing 0 to 0 of 0 entries";
        }
        return; 
    }

    // 1. Ambil offset database langsung dari Controller PHP yang dikirim Mas Wawan
    let startNo = <?= isset($page) ? (int)$page : 0 ?>;
    startNo = startNo + 1; // Ditambah 1 supaya halaman pertama dimulai dari angka 1

    let rows = document.querySelectorAll('.target-no');
    // Jika tidak memakai class .target-no, otomatis cari kolom pertama di setiap baris tabel
    if (rows.length === 0) {
        rows = document.querySelectorAll('tbody tr td:first-child');
    }
    
    // 2. Set nomor urut baris di tabel (Pasti runtut & presisi!)
    rows.forEach(function(row, index) {
        row.innerText = startNo + index;
    });

    // 3. Ambil total data riil database langsung dari Controller PHP
    let totalEntries = <?= isset($total_rows) ? (int)$total_rows : 'null' ?>;
    if (totalEntries === null || totalEntries === 0) {
        totalEntries = rows.length; // Backup pengaman
    }

    // 4. Render teks "Showing X to Y of Z entries"
    let showingText = document.getElementById('showing-text');
    if (!showingText) {
        showingText = document.querySelector('.badge-dark, #pagination-wrapper span, .pagination-wrapper span');
    }

    if (showingText && rows.length > 0) {
        let endNo = startNo + rows.length - 1;
        
        if (endNo > totalEntries) {
            totalEntries = endNo;
        }
        
        showingText.innerText = "Showing " + startNo + " to " + endNo + " of " + totalEntries + " entries";
    }
});
</script>

</body>
</html>