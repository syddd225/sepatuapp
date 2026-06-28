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
            padding: 40px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h1 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: #888;
            font-size: 14px;
        }

        /* ALERT FLASHLIGHT */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-danger {
            background-color: rgba(239, 83, 80, 0.1);
            color: #ef5350;
            border: 1px solid rgba(239, 83, 80, 0.3);
        }

        .alert-success {
            background-color: rgba(102, 187, 106, 0.1);
            color: #66bb6a;
            border: 1px solid rgba(102, 187, 106, 0.3);
        }

        /* FORM ELEMENTS */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #aaa;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 6px;
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            transition: 0.3s;
        }

        .form-group textarea {
            resize: none;
            height: 80px;
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #C19A6B;
            background-color: #333;
        }

        /* TEXT WARNING KHUSUS DI BAWAH KOLOM Masing-Masing */
        .text-danger-inline {
            color: #ef5350;
            font-size: 13px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        .btn-auth {
            width: 100%;
            padding: 14px;
            background-color: #C19A6B;
            color: #1E1E1E;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-auth:hover {
            background-color: #a8855a;
        }

        .auth-toggle {
            text-align: center;
            margin-top: 25px;
            color: #888;
            font-size: 14px;
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

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body>

    <div class="auth-container">

        @if(session('success') && session('success') != 'Anda telah berhasil keluar.')
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div id="login-form-box">
            <div class="auth-header">
                <h1>Selamat Datang</h1>
                <p>Silakan masuk ke akun Retro Collection Anda</p>
            </div>

            @if($errors->has('email') && !old('name'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login_email">Email Pembeli</label>
                    <input type="email" id="login_email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>

                <div class="form-group">
                    <label for="login_password">Kata Sandi</label>
                    <input type="password" id="login_password" name="password" placeholder="Masukkan password Anda" required>
                </div>

                <button type="submit" class="btn-auth">Masuk Sekarang</button>
            </form>

            <div class="auth-toggle">
                Belum terdaftar? <a href="#" id="go-to-register">Buat Akun Baru</a>
            </div>
        </div>


        <div id="register-form-box" class="hidden">
            <div class="auth-header">
                <h1>Gabung Bersama Kami</h1>
                <p>Lengkapi berkas pendaftaran akun baru Anda</p>
            </div>

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="reg_name">Nama Lengkap</label>
                    <input type="text" id="reg_name" name="name" value="{{ old('name') }}" placeholder="Sesuai identitas KTP" required>
                    @error('name')
                        <span class="text-danger-inline"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_email">Alamat Email</label>
                    <input type="email" id="reg_email" name="email" value="{{ old('email') }}" placeholder="Contoh: pembeli@gmail.com" required>
                    @error('email')
                        <span class="text-danger-inline"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_phone">Nomor HP / WhatsApp</label>
                    <input type="text" id="reg_phone" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 08123456789" required>
                    @error('phone')
                        <span class="text-danger-inline"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_address">Alamat Pengiriman Domisili</label>
                    <textarea id="reg_address" name="address" placeholder="Tulis nama jalan, nomor rumah, RT/RW, kecamatan, dan kota secara rinci" required>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-danger-inline"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_password">Kata Sandi Baru</label>
                    <input type="password" id="reg_password" name="password" placeholder="Minimal 8 karakter" required>
                    @error('password')
                        @if(strpos(strtolower($message), 'minimal') !== false || strpos(strtolower($message), 'wajib') !== false)
                            <span class="text-danger-inline"> {{ $message }}</span>
                        @endif
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reg_password_confirmation">Konfirmasi Autentikasi Sandi</label>
                    <input type="password" id="reg_password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                    @error('password')
                        @if(strpos(strtolower($message), 'cocok') !== false || strpos(strtolower($message), 'konfirmasi') !== false)
                            <span class="text-danger-inline"> {{ $message }}</span>
                        @endif
                    @enderror
                </div>

                <button type="submit" class="btn-auth">Buat Akun & Join</button>
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

        // PERBAIKAN UTAMA: Hanya pindah/tahan di Sign Up jika error berasal dari data pendaftaran murni.
        // Jika error hanya dari 'email' saat login salah sandi, baris ini akan menghasilkan false dan menjaga form login tetap aktif.
        const hasRegisterError = "{{ $errors->has('name') || $errors->has('phone') || $errors->has('address') || $errors->has('password') ? 'true' : 'false' }}";
        const isRegistering = "{{ old('name') ? 'true' : 'false' }}";
        
        if (hasRegisterError === 'true' || isRegistering === 'true') {
            loginBox.classList.add('hidden');
            registerBox.classList.remove('hidden');
        }
    </script>

</body>

</html>