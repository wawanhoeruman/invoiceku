<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2>Edit Customer</h2>

<form method="post" action="<?= site_url('customer/update') ?>">

    <input type="hidden" name="id" value="<?= $customer->id ?>">

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $customer->nama ?>" required>
    </div>

    <div class="mb-3">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control" value="<?= $customer->telepon ?>">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= $customer->email ?>">
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"><?= $customer->alamat ?></textarea>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="<?= base_url('customer') ?>" class="btn btn-secondary">Kembali</a>

</form>

</body>
</html>