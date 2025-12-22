<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Inventory Management</title>

    <!-- Bootstrap -->
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
                    #a06bff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }


        .auth-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 45px;
            width: 100%;
            max-width: 520px;
            box-shadow:
                0 30px 70px rgba(106, 92, 255, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.6);
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

        .auth-icon {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            background: linear-gradient(135deg,
                    #5b4bff,
                    #7a5cff,
                    #9b6dff);

            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 22px;
            box-shadow: 0 12px 28px rgba(106, 92, 255, 0.45);
        }

        .auth-title {
            font-weight: 800;
            color: #2c2c2c;
            letter-spacing: 0.3px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #555;
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

        .btn-auth {
            border-radius: 35px;
            padding: 14px;
            font-size: 16px;
            font-weight: 700;
            background: linear-gradient(135deg,
                    #5b4bff,
                    #7a5cff,
                    #9b6dff);
            border: none;
            box-shadow: 0 14px 30px rgba(106, 92, 255, 0.45);
            transition: all 0.3s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(106, 92, 255, 0.55);
            opacity: 0.98;
        }

        .btn-auth:active {
            transform: scale(0.97);
        }

        .text-link {
            text-decoration: none;
            font-weight: 600;
            color: #6a5cff;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 14px;
            font-size: 14px;
        }
    </style>

</head>

<body>

    <div class="auth-card">

        <div class="auth-icon">
            <i class="fas fa-user-plus"></i>
        </div>

        <h3 class="text-center auth-title mb-1">Selamat Datang 👋</h3>
        <p class="text-center text-muted mb-4">
            Buat akun untuk mengakses sistem inventory
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="contoh@email.com" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Minimal 8 karakter" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" placeholder="Ulangi password" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label class="form-label">Pilih Role</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-auth w-100 text-white">
                <i class="fas fa-user-check me-2"></i> Daftar Sekarang
            </button>
        </form>

        <!-- Login link -->
        <div class="text-center mt-4">
            <small class="text-muted">Sudah punya akun?</small><br>
            <a href="{{ route('login') }}" class="text-link text-primary">
                Login di sini
            </a>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

</body>

</html>
