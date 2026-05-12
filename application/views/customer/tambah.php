<!DOCTYPE html>
<html>
<head>
    <title>Tambah Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">

    <h2>Tambah Customer</h2>

    <a href="<?= site_url('customer'); ?>" class="btn btn-secondary btn-sm mb-3">
        ← Kembali
    </a>

    <div class="card">
        <div class="card-body">

            <form method="post" action="<?= site_url('customer/simpan'); ?>">

                <div class="form-group">
                    <label>Nama Customer</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Customer
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>