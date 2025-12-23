<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang | Inventory System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg,
                #5b4bff 0%,
                #6f5bff 35%,
                #8a5cf6 70%,
                #a06bff 100%
            );
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 48px;
            max-width: 540px;
            width: 100%;
            box-shadow:
                0 30px 70px rgba(91, 75, 255, 0.35),
                0 0 0 1px rgba(255,255,255,0.6);
            text-align: center;
            animation: fadeUp 0.7s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-icon {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            background: linear-gradient(135deg,
                #5b4bff,
                #7a5cff,
                #9b6dff
            );
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            color: white;
            font-size: 36px;
            box-shadow: 0 14px 30px rgba(106, 92, 255, 0.45);
        }

        .welcome-card h1 {
            font-weight: 800;
            color: #2c2c2c;
            letter-spacing: 0.3px;
        }

        .welcome-card p {
            color: #6c757d;
            margin-top: 14px;
            font-size: 15px;
            line-height: 1.6;
        }

        .btn-custom {
            border-radius: 35px;
            padding: 14px 30px;
            font-size: 16px;
            font-weight: 600;
        }

        .btn-login {
            background: linear-gradient(135deg,
                #5b4bff,
                #7a5cff,
                #9b6dff
            );
            border: none;
            color: #fff;
            box-shadow: 0 14px 30px rgba(106, 92, 255, 0.45);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            opacity: 0.97;
        }

        .btn-register {
            border: 2px solid #7a5cff;
            color: #6a5cff;
            background: transparent;
        }

        .btn-register:hover {
            background: #7a5cff;
            color: #fff;
        }

        .footer-text {
            margin-top: 30px;
            font-size: 13px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="welcome-card">

    <div class="welcome-icon">
        <i class="fas fa-warehouse"></i>
    </div>

    <h1>Selamat Datang 👋</h1>

    <p>
        Sistem Manajemen Inventaris untuk mengelola <br>
        <strong>barang, kategori, dan supplier</strong><br>
        secara cepat, aman, dan terstruktur.
    </p>

    <div class="d-grid gap-3 mt-4">
        <a href="<?php echo e(route('login')); ?>" class="btn btn-custom btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> Login
        </a>

        <a href="<?php echo e(route('register')); ?>" class="btn btn-custom btn-register">
            <i class="fas fa-user-plus me-2"></i> Register
        </a>
    </div>

    <div class="footer-text">
        © <?php echo e(date('Y')); ?> Inventory System • All rights reserved
    </div>

</div>

</body>
</html>
<?php /**PATH C:\laragon\laragon-6.0-minimal\www\Aplikasi-Manajemen-inventaris-barang\resources\views/welcome.blade.php ENDPATH**/ ?>