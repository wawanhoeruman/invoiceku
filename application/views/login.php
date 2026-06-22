<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        body{
            background: linear-gradient(135deg,#667eea,#764ba2);
            height:100vh;
        }

        .login-box{
            margin-top:80px;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
        }

        .card-header{
            background:white;
            border:none;
            text-align:center;
            font-size:28px;
            font-weight:bold;
            padding-top:30px;
        }

        .btn-login{
            border-radius:30px;
            font-weight:bold;
        }

        .logo{
            font-size:50px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center login-box">
        <div class="col-md-4">

            <div class="card">

                <div class="card-header">
                    <div class="logo">🧾</div>
                    <!-- Judul dinamis tergantung halaman -->
                    <?php 
                        if(isset($mode) && $mode == 'forgot'){
                            echo 'Reset Password';
                        } elseif(isset($mode) && $mode == 'change'){
                            echo 'Password Baru';
                        } else {
                            echo 'Login Admin';
                        }
                    ?>
                </div>

                <div class="card-body">

                    <!-- Flashdata untuk Error -->
                    <?php if($this->session->flashdata('error')){ ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <!-- Flashdata untuk Sukses -->
                    <?php if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <?php if(isset($mode) && $mode == 'forgot') { ?>
                        
                        <!-- ==================== FORM FORGOT PASSWORD ==================== -->
                        <form method="post" action="<?= site_url('auth/forgot_password') ?>">
                            <div class="form-group">
                                <label>Email Anda</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email terdaftar" required>
                                <small class="form-text text-muted">Kami akan mengecek apakah email Anda terdaftar di sistem.</small>
                            </div>

                            <button type="submit" class="btn btn-warning btn-block btn-login text-white">
                                Kirim Link Reset
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="<?= site_url('auth'); ?>" style="color: #667eea; text-decoration: none; font-size: 14px;">← Kembali ke Login</a>
                        </div>

                    <?php } elseif(isset($mode) && $mode == 'change') { ?>

                        <!-- ==================== 🌟 FORM GANTI PASSWORD BARU 🌟 ==================== -->
                        <p class="text-muted text-center small">Masukkan password baru untuk akun:<br><strong><?= $email; ?></strong></p>
                        <form method="post" action="<?= site_url('auth/resetpassword?email=' . $email) ?>">
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="password_baru" class="form-control" placeholder="Minimal 6 karakter..." required autofocus>
                            </div>

                            <button type="submit" class="btn btn-success btn-block btn-login text-white">
                                Simpan Password Baru
                            </button>
                        </form>

                    <?php } else { ?>

                        <!-- ==================== FORM LOGIN BIASA ==================== -->
                        <form method="post" action="<?= site_url('auth/proses') ?>">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-login">
                                Login
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="<?= site_url('auth/forgot_password'); ?>" style="color: #764ba2; text-decoration: none; font-size: 14px;">Forgot Password?</a>
                        </div>

                    <?php } ?>

                </div>

            </div>

            <p class="text-center text-white mt-3">
                Invoice System © 2026<br>
                By Wawan .......
            </p>

        </div>
    </div>
</div>

</body>
</html>