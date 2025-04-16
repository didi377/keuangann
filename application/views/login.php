<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Data Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1.25rem;
            padding: 2rem;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        .form-control {
            border-radius: 0.75rem;
            font-size: 0.95rem;
        }
        .btn-primary {
            border-radius: 0.75rem;
            font-weight: 500;
        }
        .login-title {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .login-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .illustration {
            max-width: 140px;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        .alert {
            font-size: 0.9rem;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/4108/4108050.png" alt="login" class="illustration">
                <h2 class="login-title">Selamat Datang!</h2>
                <p class="login-subtitle">Masuk ke akun Anda untuk mengelola keuangan 📊</p>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo site_url('auth/login'); ?>">
                    <div class="mb-3 text-start">
                        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                    </div>
                    <div class="mb-3 text-start">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">🔐 Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
