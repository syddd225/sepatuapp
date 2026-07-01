<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Akun Saya - Retro Collection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F5F5F5;
            color: #333;
        }

        /* --- NAVBAR & FOOTER CSS (Sama seperti sebelumnya) --- */
        .navbar { position: sticky; top: 0; width: 100%; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; background: #1E1E1E; z-index: 1000; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3); }
        .navbar h2 { font-weight: 700; color: white; font-size: 24px; margin: 0; }
        .nav-wrapper { display: flex; align-items: center; flex: 1; justify-content: flex-end; gap: 30px; }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin: 0 15px; text-decoration: none; color: white; opacity: 0.8; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { opacity: 1; color: #C19A6B; }
        .auth-links { display: flex; align-items: center; gap: 15px; }
        .btn-login { background: #C19A6B; color: #1E1E1E !important; padding: 8px 18px; border-radius: 6px; font-weight: 600; text-decoration: none; transition: 0.3s; }
        .btn-login:hover { background: #a8855a; }
        .btn-logout { color: #ef5350; text-decoration: none; font-weight: 600; transition: 0.3s; font-size: 15px; }
        .btn-logout:hover { opacity: 0.8; }
        
        /* --- PROFILE SECTION CSS --- */
        .profile-container {
            max-width: 800px;
            margin: 60px auto;
            padding: 0 20px;
            min-height: 60vh;
        }

        .profile-title {
            font-size: 28px;
            font-weight: 700;
            color: #111;
            margin-bottom: 30px;
            text-align: center;
        }

        .profile-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #C19A6B;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 30px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            background: #1E1E1E;
            color: #C19A6B;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .profile-header-text h3 {
            font-size: 24px;
            color: #111;
            margin-bottom: 5px;
        }

        .profile-header-text p {
            color: #666;
            font-size: 15px;
        }

        .info-group {
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #222;
            padding: 12px 15px;
            background: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        /* --- FOOTER CSS --- */
        .footer-complex { background-color: #050505; color: #ccc; padding: 70px 40px 30px; font-family: 'Inter', sans-serif; width: 100%; }
        .footer-grid { display: grid; grid-template-columns: 2.5fr 1fr 1.2fr 1.8fr 1.5fr; gap: 30px; max-width: 1200px; margin: 0 auto; }
        .footer-col h4 { color: #fff; font-size: 16px; margin-bottom: 25px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .footer-col p { font-size: 14px; line-height: 1.8; margin-bottom: 15px; color: #aaa; text-align: justify; }
        .footer-col a { color: #aaa; text-decoration: none; font-size: 14px; display: block; margin-bottom: 15px; transition: 0.3s; }
        .footer-col a:hover { color: #C19A6B; }
        .work-hours { width: 100%; font-size: 14px; border-collapse: collapse; }
        .work-hours td { padding: 10px 0; border-bottom: 1px solid #222; color: #aaa; }
        .work-hours tr:last-child td { border-bottom: none; }
        .work-hours td:last-child { text-align: right; color: #fff; font-weight: 600; }
        .footer-bottom { text-align: center; padding-top: 30px; margin-top: 50px; border-top: 1px solid #222; font-size: 13px; color: #666; }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <h2>Retro Collection</h2>
        <div class="nav-wrapper">
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/category/1">Formal</a>
                <a href="/category/2">Casual</a>
                <a href="/category/3">Boots</a>
            </div>
            <div class="auth-links">
                @auth
                    <!-- Tombol Akun Saya -->
                    <a href="/akun" class="btn-login" style="background: transparent; color: white !important; border: 1px solid white;">Akun Saya</a>
                    
                    <a href="#" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="/login" class="btn-login">Masuk / Daftar</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- PROFILE SECTION -->
    <div class="profile-container">
        <h1 class="profile-title">Informasi Akun</h1>
        
        <div class="profile-card">
            <div class="profile-header">
                <!-- Mengambil huruf pertama dari nama user untuk Avatar -->
                <div class="profile-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="profile-header-text">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p>Member Resmi Retro Collection</p>
                </div>
            </div>

            <div class="info-group">
                <div class="info-label">Email Terdaftar</div>
                <div class="info-value">{{ auth()->user()->email }}</div>
            </div>

            <div class="info-group">
                <div class="info-label">Nomor WhatsApp / Telepon</div>
                <div class="info-value">{{ auth()->user()->phone ?? 'Belum diisi' }}</div>
            </div>

            <div class="info-group">
                <div class="info-label">Alamat Pengiriman</div>
                <div class="info-value" style="line-height: 1.6;">
                    {{ auth()->user()->address ?? 'Belum ada alamat tersimpan.' }}
                </div>
            </div>
            
            <div style="text-align: right; margin-top: 30px;">
                <a href="#" class="btn-login">Edit Profil</a>
            </div>
        </div>
    </div>

    <!-- FOOTER BARU (5 KOLOM) -->
    <div class="footer-complex">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Tentang Kami</h4>
                <p>Retro Collection didirikan dengan visi untuk menghadirkan mahakarya sepatu berkualitas dari pengrajin lokal Nusantara yang dapat dijangkau oleh seluruh lapisan masyarakat.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <a href="/">Home</a>
                <a href="/#kategori">Produk Kami</a>
            </div>
            <div class="footer-col">
                <h4>Kontak Kami</h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="#" style="display: flex; align-items: center; gap: 8px; margin-bottom: 0;">💬 WhatsApp</a>
                    <a href="#" style="display: flex; align-items: center; gap: 8px; margin-bottom: 0;">✉️ Email</a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Alamat Kantor</h4>
                <p style="margin: 0; text-align: left;">📍 Jl. Dr. Radjiman No. 88, Laweyan, Kota Surakarta, Jawa Tengah, 57141</p>
            </div>
            <div class="footer-col">
                <h4>Jam Kerja</h4>
                <table class="work-hours">
                    <tr><td>Senin - Jumat</td><td>08:00 - 17:00</td></tr>
                    <tr><td>Sabtu</td><td>08:00 - 15:00</td></tr>
                    <tr><td>Minggu</td><td style="color: #666; font-weight: normal;">Libur</td></tr>
                </table>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2026 Retro Collection. All rights reserved.
        </div>
    </div>

</body>
</html>