<!DOCTYPE html>
<html>
<head>
<title>Daftar Customer</title>

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

/* 🌟 PAKSA PAGINATION CI AGAR BERGAYA FLEX DAN SEJAJAR TENGAH */
.custom-pagination-container nav, 
.custom-pagination-container ul.pagination {
    display: flex !important;
    align-items: center !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding: 0 !important;
}
</style>
</head>

<body class="p-4">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-0">Daftar Customer</h2>
        <small class="text-muted">Semua data customer</small>
    </div>
    <div>
        <a href="<?= site_url('customer'); ?>" class="btn btn-secondary btn-sm">Back</a>
        <a href="<?= site_url('customer/tambah'); ?>" class="btn btn-primary btn-sm">+ Tambah Customer</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body py-3">
        <form method="get" action="<?= site_url('customer/list') ?>">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="text" name="keyword"
                           class="form-control"
                           placeholder="Cari nama / telepon / email..."
                           value="<?= isset($keyword)?$keyword:''; ?>">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-block" style="height: calc(2.25rem + 2px);">Search</button>
                </div>
                <div class="col-md-1">
                    <a href="<?= site_url('customer/list'); ?>" class="btn btn-secondary btn-block"
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

    <div class="table-responsive">
        <table class="table table-hover table-bordered mb-0">
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($customer)): ?>
                <?php 
                $no = $page + 1; 
                foreach($customer as $c){ 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= $c->nama; ?></strong></td>
                    <td><?= $c->telepon; ?></td>
                    <td><?= $c->email; ?></td>
                    <td><?= $c->alamat; ?></td>
                    <td>
                        <a href="<?= site_url('customer/edit/'.$c->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= site_url('customer/hapus/'.$c->id); ?>"
                           onclick="return confirm('Yakin hapus?')"
                           class="btn btn-danger btn-sm">
                           Hapus
                        </a>
                    </td>
                </tr>
                <?php } ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data customer</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex align-items-center p-3 custom-pagination-container" style="gap: 15px;">
        <div>
            <?= $paging; ?>
        </div>
        <span class="badge badge-dark p-2" style="font-size: 13px; font-weight: normal; border-radius: 4px; white-space: nowrap; line-height: 1.5;">
            Showing <?= ($total_rows > 0) ? ($page + 1) : 0; ?> to <?= min($page + $per_page, $total_rows); ?> of <?= $total_rows; ?> entries
        </span>
    </div>

</div>
</div>

</div>

</body>
</html>