<!--<form method="post" action="<?= site_url('auth/proses'); ?>">
<h2>Login Admin</h2>

<input type="text" name="username" placeholder="Username"><br><br>
<input type="password" name="password" placeholder="Password"><br><br>

<button type="submit">Login</button>
</form>-->!

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

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
                    Login Admin
                </div>

				<div class="card-body">

					<?php if($this->session->flashdata('error')){ ?>
				<div class="alert alert-danger">
    				<?= $this->session->flashdata('error'); ?>
				</div>
					<?php } ?>
				<form method="post" action="<?= site_url('auth/proses') ?>">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username"
                            class="form-control"
                            placeholder="Masukkan username" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                            class="form-control"
                            placeholder="Masukkan password" required>
                        </div>

                        <button type="submit"
                        class="btn btn-primary btn-block btn-login">
                        Login
                        </button>

                    </form>

                </div>

            </div>

            <p class="text-center text-white mt-3">
                Invoice System © 2026
                By Wawan .......
            </p>

        </div>
    </div>
</div>

</body>
</html>