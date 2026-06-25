<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Retro Collection</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1E1E1E 0%, #2a2a2a 100%);
            color: #ddd;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #2a2a2a;
            border: 1px solid #C19A6B;
            border-radius: 8px;
            padding: 3rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 2rem;
            color: #C19A6B;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #999;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #C19A6B;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            background: #1E1E1E;
            border: 1px solid #444;
            border-radius: 4px;
            color: #ddd;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #C19A6B;
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease-in;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            border-left: 4px solid #4caf50;
            color: #81c784;
        }

        .alert-error {
            background: rgba(244, 67, 54, 0.1);
            border-left: 4px solid #f44336;
            color: #ef5350;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            background: #C19A6B;
            color: #1E1E1E;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background: #d4a86a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(193, 154, 107, 0.3);
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            color: #999;
            font-size: 0.85rem;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Admin</h1>
            <p>Panel Manajemen Produk</p>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                ✅ {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-error">
                ❌ {{ $message }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="password">Password Admin</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password..." 
                    required
                    autofocus
                >
                @error('password')
                    <span style="color: #ef5350; font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="login-footer">
            <p>Selamat datang di Panel Admin Retro Collection</p>
            <p style="margin-top: 0.5rem;">Demo: default password = <code style="background: #1E1E1E; padding: 0.25rem 0.5rem; border-radius: 2px;">admin123</code></p>
        </div>
    </div>
</body>
</html>
