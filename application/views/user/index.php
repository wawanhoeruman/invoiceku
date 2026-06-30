<!DOCTYPE html>
<html>
<head>
<title>Daftar User</title>

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
    background: #3899e4;
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

/* Biar pagination lurus presisi sejajar kotak entries */
#pagination-wrapper nav, 
#pagination-wrapper ul.pagination,
#pagination-wrapper div {
    display: flex !important;
    align-items: center !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding: 0 !important;
    gap: 2px;
}
</style>
</head>

<body class="p-4">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-0">Daftar User</h2>
        <small class="text-muted">Semua data user sistem</small>
    </div>
    <div>
        <a href="<?= site_url('user') ?>" class="btn btn-secondary btn-sm">Back</a>
        <a href="<?= site_url('dashboard') ?>" class="btn btn-dark btn-sm">Dashboard</a>
        <a href="<?= site_url('user/tambah') ?>" class="btn btn-primary btn-sm">+ Tambah User</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body py-3">
        <form method="get">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="text" name="keyword"
                           class="form-control"
                           placeholder="Cari nama / username"
                           value="<?= isset($keyword)?$keyword:'' ?>">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary btn-block" style="height: calc(2.25rem + 2px);">Search</button>
                </div>
                <div class="col-md-1">
                    <a href="<?= site_url('user/list') ?>" class="btn btn-secondary btn-block"
                       style="height: calc(2.25rem + 2px); line-height:22px;">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
<div class="card-body p-0">

<table class="table table-hover table-bordered mb-0">
    <thead>
        <tr>
            <th width="60">No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th width="120">Role</th>
            <th width="180">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!empty($users)): ?>
        <?php foreach($users as $u): ?>
        <tr class="user-row">
            <td class="target-no">1</td>
            <td><strong><?= $u->nama ?></strong></td>
            <td><?= $u->username ?></td>
            <td><?= $u->email ?></td>
            <td>
                <?php if($u->role == 'admin'): ?>
                    <span class="badge badge-success p-2">Admin</span>
                <?php else: ?>
                    <span class="badge badge-secondary p-2">Staff</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= site_url('user/edit/'.$u->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                <?php if ($this->session->userdata('user_id') != $u->id): ?>
                <a href="<?= site_url('user/delete/'.$u->id) ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus user ini?')">
                   Hapus
                </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center text-muted py-4">User Tidak Terdaftar</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between align-items-center p-3">
    <div class="d-flex align-items-center" id="pagination-wrapper" style="gap: 15px;">
        <div>
            <?= $pagination ?>
        </div>
        
        <span class="badge badge-dark p-2" id="showing-text" style="font-size: 13px; font-weight: normal; border-radius: 4px; white-space: nowrap; line-height: 1.5;">
            Showing 0 to 0 of 0 entries
        </span>
    </div>
</div>

</div>
</div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let limit = 5; // Batasan data per halaman user Mas Wawan
    let startNo = 1;

    // 1. Ambil nilai data offset dari URL segment paling akhir
    let urlSegments = window.location.pathname.split('/');
    let lastSegment = urlSegments[urlSegments.length - 1];
    if (!isNaN(lastSegment) && lastSegment !== "") {
        startNo = parseInt(lastSegment) + 1;
    }

    let rows = document.querySelectorAll('.target-no');
    
    // 2. Set nomor urut baris di tabel agar kontinu (11, 12, dst)
    rows.forEach(function(row, index) {
        row.innerText = startNo + index;
    });

    // 3. Ambil angka total asli dari PHP Controller yang kita kirim tadi
    let totalEntries = <?= isset($total_rows) ? (int)$total_rows : 'null' ?>;

    // 4. BACKUP: Jika karena suatu hal PHP bernilai null, baru hitung manual dari baris tabel
    if (totalEntries === null || totalEntries === 0) {
        totalEntries = rows.length;
    }

    // 5. Cetak teks "Showing X to Y of Z entries" secara murni akurat riil database
    let showingText = document.getElementById('showing-text');
    if (showingText && rows.length > 0) {
        let endNo = startNo + rows.length - 1;
        
        // Proteksi jika user menghapus data sampai habis di halaman tersebut
        if (endNo > totalEntries) {
            totalEntries = endNo;
        }
        
        showingText.innerText = "Showing " + startNo + " to " + endNo + " of " + totalEntries + " entries";
    }
});
</script>

</body>
</html>