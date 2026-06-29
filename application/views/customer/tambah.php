<!DOCTYPE html>
<html>
<head>
    <title>Tambah Customer</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
    /* Mengikuti standar tema premium Invoiceku */
    body{
        background:#f4f6f9;
    }

    .main-box{
        background:#fff;
        border-radius:12px;
        padding:30px;
        box-shadow:0 8px 20px rgba(0,0,0,0.08);
    }

    .form-control {
        border-radius:8px;
        padding:10px 15px;
        height:auto;
    }

    .form-control:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
    }

    label {
        font-weight:600;
        color:#495057;
    }
    </style>
</head>
<body class="p-4">

<div class="container-fluid px-4">

    <div class="main-box">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="mb-1">Tambah Customer</h2>
                <p class="text-muted mb-0">Tambahkan data customer baru ke sistem</p>
            </div>
            <div>
                <a href="<?= site_url('customer'); ?>" class="btn btn-secondary btn-sm" style="min-width:120px; font-weight:600; border-radius:8px;">
                    ← Kembali
                </a>
            </div>
        </div>

        <hr class="mb-4">

        <form method="post" action="<?= site_url('customer/simpan'); ?>">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><i class="fas fa-user text-muted mr-1"></i> Nama Customer <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label><i class="fas fa-phone text-muted mr-1"></i> Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-envelope text-muted mr-1"></i> Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label><i class="fas fa-map-marker-alt text-muted mr-1"></i> Alamat</label>
                <textarea name="alamat" class="form-control" rows="4"></textarea>
            </div>

            <hr class="my-4">

            <button type="submit" class="btn btn-primary px-4 py-2" style="font-weight:600; border-radius:8px; background-color: #007bff; border-color: #007bff;">
                <i class="fas fa-save mr-1"></i> Simpan Customer
            </button>

        </form>

    </div>
</div>

</body>
</html>