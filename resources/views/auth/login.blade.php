<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk & Daftar - Retro Collection</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.9)),
                        url('/image/bg.jpg.jpeg') center/cover no-repeat fixed;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .auth-container {
            background-color: #1E1E1E;
            width: 100%;
            max-width: 500px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid #333;
            overflow: hidden;
            padding: 40px 30px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .auth-header h2 span {
            color: #C19A6B;
        }

        .auth-header p {
            color: #aaa;
            font-size: 14px;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #C19A6B;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            background-color: #2A2A2A;
            border: 1px solid #444;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #C19A6B;
            background-color: #333;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* Error Messages */
        .error-message {
            color: #ef5350;
            font-size: 12px;
            margin-top: 5px;
            list-style: none;
        }

        /* Buttons */
        .btn-auth {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background-color: #C19A6B;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-auth:hover {
            background-color: #a88154;
            color: #fff;
        }

        /* Toggle Link */
        .auth-toggle {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #ccc;
        }

        .auth-toggle a {
            color: #C19A6B;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .auth-toggle a:hover {
            text-decoration: underline;
        }

        /* Utility classes untuk sembunyikan form */
        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <div class="auth-container">
        
        <div id="login-form-box">
            <div class="auth-header">
                <h2>Retro <span>Collection</span></h2>
                <p>Silakan masuk untuk melanjutkan transaksi aman</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="login_email">Alamat Email</label>
                    <input type="email" id="login_email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                    @error('email')
                        <li class="error-message">{{ $message }}</li>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="login_password">Password</label>
                    <input type="password" id="login_password" name="password" placeholder="••••••••" required>
                    @error('password')
                        <li class="error-message">{{ $message }}</li>
                    @enderror
                </div>

                <button type="submit" class="btn-auth">🔒 Masuk Sekarang</button>
            </form>

            <div class="auth-toggle">
                Belum punya akun? <a href="#" id="go-to-register">Daftar Akun Baru</a>
            </div>
        </div>

        <div id="register-form-box" class="hidden">
            <div class="auth-header">
                <h2>Daftar <span>Pembeli</span></h2>
                <p>Lengkapi data asli untuk menghindari order fiktif</p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="reg_name">Nama Lengkap *</label>
                    <input type="text" id="reg_name" name="name" value="{{ old('name') }}" placeholder="Sesuai KTP" required>
                    @error('name')
                        <li class="error-message">{{ $message }}</li>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_email">Email Aktif *</label>
                    <input type="email" id="reg_email" name="email" value="{{ old('email') }}" placeholder="pembeli@email.com" required>
                    @error('email')
                        <li class="error-message">{{ $message }}</li>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_phone">No. WhatsApp Aktif *</label>
                    <input type="text" id="reg_phone" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 08123456789" required>
                    @error('phone')
                        <li class="error-message">{{ $message }}</li>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_address">Alamat Pengiriman Lengkap *</label>
                    <textarea id="reg_address" name="address" placeholder="Nama Jalan, No. Rumah, RT/RW, Kecamatan, Kota, Kode Pos" required>{{ old('address') }}</textarea>
                    @error('address')
                        <li class="error-message">{{ $message }}</li>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_password">Password *</label>
                    <input type="password" id="reg_password" name="password" placeholder="Minimal 8 karakter" required>
                    @error('password')
                        <li class="error-message">{{ $message }}</li>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_password_confirmation">Konfirmasi Password *</label>
                    <input type="password" id="reg_password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn-auth">✨ Buat Akun & Join</button>
            </form>

            <div class="auth-toggle">
                Sudah memiliki akun? <a href="#" id="go-to-login">Masuk Kembali</a>
            </div>
        </div>

    </div>

    <script>
        const loginBox = document.getElementById('login-form-box');
        const registerBox = document.getElementById('register-form-box');
        const goToRegister = document.getElementById('go-to-register');
        const goToLogin = document.getElementById('go-to-login');

        goToRegister.addEventListener('click', function(e) {
            e.preventDefault();
            loginBox.classList.add('hidden');
            registerBox.classList.remove('hidden');
        });

        goToLogin.addEventListener('click', function(e) {
            e.preventDefault();
            registerBox.classList.add('hidden');
            loginBox.classList.remove('hidden');
        });

        // Pengecekan error registrasi yang aman dari deteksi salah linter IDE
        const hasRegisterError = "{{ $errors->has('name') || $errors->has('phone') || $errors->has('address') ? 'true' : 'false' }}";
        if (hasRegisterError === 'true') {
            loginBox.classList.add('hidden');
            registerBox.classList.remove('hidden');
        }
    </script>

</body>

</html>