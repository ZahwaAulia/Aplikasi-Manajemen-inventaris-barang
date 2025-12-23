<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventory Management</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

   <style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #6a5cff, #8a5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(10px);
        border-radius: 26px;
        padding: 45px;
        width: 100%;
        max-width: 460px;
        box-shadow:
            0 25px 60px rgba(106, 92, 255, 0.35),
            0 0 0 1px rgba(255,255,255,0.6);
        animation: fadeUp 0.7s ease;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-icon {
        width: 95px;
        height: 95px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6a5cff, #8a5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin: 0 auto 22px;
        box-shadow: 0 10px 25px rgba(106, 92, 255, 0.45);
    }

    .login-title {
        font-weight: 800;
        color: #2c2c2c;
        letter-spacing: 0.3px;
    }

    .form-label {
        font-weight: 600;
        color: #555;
        font-size: 14px;
    }

    .form-control,
    .form-select {
        border-radius: 16px;
        padding: 12px 16px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #6a5cff;
        box-shadow: 0 0 0 0.2rem rgba(106, 92, 255, 0.25);
    }

    .btn-login {
        border-radius: 35px;
        padding: 14px;
        font-size: 16px;
        font-weight: 700;
        background: linear-gradient(135deg, #6a5cff, #8a5cf6);
        border: none;
        box-shadow: 0 12px 25px rgba(106, 92, 255, 0.45);
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 35px rgba(106, 92, 255, 0.55);
        opacity: 0.98;
    }

    .btn-login:active {
        transform: scale(0.98);
    }

    .form-check-label {
        font-size: 14px;
        color: #666;
    }

    .text-link {
        text-decoration: none;
        font-weight: 600;
        color: #6a5cff;
    }

    .text-link:hover {
        text-decoration: underline;
    }
</style>

</head>

<body>

<div class="login-card">

    <div class="login-icon">
        <i class="fas fa-warehouse"></i>
    </div>

    <h3 class="text-center login-title mb-1">Selamat Datang 👋</h3>
    <p class="text-center text-muted mb-4">
        Silakan login untuk mengelola inventory
    </p>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                name="email"
                value="<?php echo e(old('email')); ?>"
                placeholder="contoh@email.com"
                required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                name="password"
                placeholder="********"
                required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label class="form-label">Pilih Role</label>
            <select name="role"
                class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="staff" <?php echo e(old('role') == 'staff' ? 'selected' : ''); ?>>Staff</option>
                <option value="guest" <?php echo e(old('role') == 'guest' ? 'selected' : ''); ?>>Guest</option>
            </select>
            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Remember -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-login w-100 text-white">
            <i class="fas fa-sign-in-alt me-2"></i> Login
        </button>
    </form>

    <!-- Register -->
    <div class="text-center mt-4">
        <small class="text-muted">Belum punya akun?</small><br>
        <a href="<?php echo e(route('register')); ?>" class="text-link text-primary">
            Daftar sekarang
        </a>
    </div>

    <!-- Errors -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
<?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views\auth\login.blade.php ENDPATH**/ ?>