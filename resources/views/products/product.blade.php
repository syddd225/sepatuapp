<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Shoe Showcase</title>
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
            scroll-behavior: smooth;
        }

        /* -------------------------------------
           1. NAVBAR & HAMBURGER MENU
           ------------------------------------- */
        .navbar {
            position: sticky;
            top: 0;
            width: 100%;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #1E1E1E;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar h2 {
            font-weight: 700;
            color: white;
            font-size: 24px;
            margin: 0;
        }

        /* CSS TAMBAHAN AGAR TOMBOL RETRO BERFUNGSI SEBAGAI LINK TANPA MERUBAH WARNA/STYLE */
        .navbar h2 a {
            color: white !important;
            text-decoration: none !important;
        }
        .navbar h2 a:visited, 
        .navbar h2 a:hover, 
        .navbar h2 a:focus, 
        .navbar h2 a:active {
            color: white !important;
            text-decoration: none !important;
        }

        .nav-wrapper {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: flex-end;
            gap: 30px;
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-links a {
            margin: 0 15px;
            text-decoration: none;
            color: white;
            opacity: 0.8;
            font-size: 15px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            opacity: 1;
            color: #C19A6B;
        }

        .auth-links {
            display: flex;
            align-items: center;
        }

        .btn-login {
            background: #C19A6B;
            color: #1E1E1E !important;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-login:hover {
            background: #a8855a;
        }

        .btn-logout {
            color: #ef5350;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-logout:hover {
            opacity: 0.8;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: white;
            border-radius: 2px;
            transition: 0.3s;
        }

        /* -------------------------------------
           2. HERO & PRODUK GRID
           ------------------------------------- */
        .hero {
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
                        url('/image/bg.jpg.jpeg') center/cover;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
        }

        .hero p {
            opacity: 0.9;
            color: #fff;
            font-size: 1.1rem;
        }

        .section {
            padding: 60px 40px;
            max-width: 1200px;
            margin: auto;
        }

        .section h2 {
            font-size: 28px;
            margin-bottom: 40px;
            color: #111;
            text-align: center;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .material {
            font-size: 13px;
            color: #666;
            margin-bottom: 12px;
            line-height: 1.5;
            min-height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .name {
            font-size: 18px;
            font-weight: 700;
            color: #111;
            margin-bottom: 8px;
        }

        .price {
            color: #C19A6B;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn {
            margin-top: auto; 
            display: block;
            padding: 12px;
            text-align: center;
            background: #C19A6B;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn:hover {
            background: #a8855a;
        }

        /* -------------------------------------
           3. MEGA FOOTER
           ------------------------------------- */
        .footer-complex {
            background-color: #050505; 
            color: #ccc;
            padding: 70px 40px 30px;
            font-family: 'Inter', sans-serif;
            width: 100%;
        }

        .footer-grid {
            display: grid;
            grid-template-columns:  1.5fr 1fr 1.2fr 1.8fr 1.5fr; 
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-col h4 {
            color: #fff;
            font-size: 16px;
            margin-bottom: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-col p {
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 15px;
            color: #aaa;
            text-align: justify;
        }

        .footer-col a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .footer-col a:hover {
            color: #C19A6B; 
        }

        .footer-col .read-more {
            color: #C19A6B;
            font-weight: 600;
            display: inline-block;
            margin-top: 5px;
        }

        .work-hours {
            width: 100%;
            font-size: 14px;
            border-collapse: collapse;
        }

        .work-hours td {
            padding: 10px 0;
            border-bottom: 1px solid #222;
            color: #aaa;
        }

        .work-hours tr:last-child td {
            border-bottom: none;
        }

        .work-hours td:last-child {
            text-align: right;
            color: #fff;
            font-weight: 600;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 50px;
            border-top: 1px solid #222;
            font-size: 13px;
            color: #666;
        }

        /* -------------------------------------
           4. RESPONSIVE MOBILE
           ------------------------------------- */
        @media(max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                grid-template-columns: 1fr auto;
                gap: 30px;
            }

            .navbar h2 {
                font-size: 20px;
            }

            .menu-toggle {
                display: flex;
            }

            .nav-wrapper {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%; 
                left: 0;
                width: 100%;
                background: #1E1E1E;
                padding: 20px;
                margin-left: 0;
                box-shadow: 0 5px 10px rgba(0,0,0,0.3);
                gap: 20px;
            }

            .nav-wrapper.active {
                display: flex;
            }

            .nav-links {
                flex-direction: column;
                gap: 15px;
                width: 100%;
            }

            .nav-links a {
                margin: 0; 
                font-size: 16px;
                display: block;
                text-align: center;
                width: 100%;
                padding: 10px 0;
                border-bottom: 1px solid #333;
            }

            .auth-links {
                justify-content: center;
                width: 100%;
            }

            .hero {
                height: 250px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .section {
                padding: 40px 20px;
            }

            .footer-complex {
                padding: 50px 20px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2><a href="/">Retro Collection</a></h2>

        <div class="menu-toggle" id="mobile-menu" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="nav-wrapper" id="nav-wrapper">
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/category/1">Formal</a>
                <a href="/category/2">Casual</a>
                <a href="/category/3">Boots</a>
            </div>

            <div class="auth-links">
                @auth
                    <a href="#" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout ({{ auth()->user()->name }})
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

    <div class="hero">
        <div>
            <h1>{{ $products[0]->category->name ?? 'Retro Collection' }}</h1>
            <p>Kualitas premium. Gaya terbaik untuk kamu.</p>
        </div>
    </div>

    <div class="section">
        <h2>{{ $products[0]->category->name ?? 'Produk' }} Collection</h2>

        <div class="grid">
            @foreach($products as $p)
            <div class="card">
                @php
                    $imagePath = public_path('image/' . $p->image);
                    $imageExists = file_exists($imagePath) && !empty($p->image);
                @endphp
                
                @if($imageExists)
                    <img src="/image/{{ $p->image }}" alt="{{ $p->name }}">
                @else
                    <div style="width: 100%; height: 220px; background: linear-gradient(135deg, #1E1E1E 0%, #2a2a2a 100%); display: flex; align-items: center; justify-content: center; color: #C19A6B; font-size: 14px; text-align: center; padding: 20px;">
                        <div>
                            <div style="font-size: 40px; margin-bottom: 10px;">👟</div>
                            <div>Foto tidak tersedia</div>
                        </div>
                    </div>
                @endif
                
                <div class="card-body">
                    <div class="material">
                        {{ $p->description }}
                    </div>
                    <div class="name">{{ $p->name }}</div>
                    <div class="price">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </div>
                    <a href="{{ url('/product/' . $p->id) }}" class="btn">
                        Lihat Detail Produk
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

 <div class="footer-complex" id="kontak">
        <div class="footer-grid">

            <div class="footer-col">
                <h4>Tentang Kami</h4>
                <p>Retro Collection didirikan dengan visi untuk menghadirkan mahakarya sepatu berkualitas dari pengrajin lokal Nusantara yang dapat dijangkau oleh seluruh lapisan masyarakat.</p>
                <a href="/#tentang-kami" class="read-more">Baca selengkapnya</a>
            </div>

            <div class="footer-col">
                <h4>Menu</h4>
                <a href="/">Home</a>
                <a href="/#tentang-kami">Tentang Kami</a>
                <a href="/#kategori">Produk Kami</a>
                </div>

            <div class="footer-col">
                <h4>Kontak Kami</h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="https://wa.me/62895321683364" target="_blank" style="display: flex; align-items: center; gap: 8px; margin-bottom: 0;">
                        <span style="font-size: 18px;">📲</span> WhatsApp
                    </a>
                    <a href="mailto:rasyadachmad17@gmail.com" style="display: flex; align-items: center; gap: 8px; margin-bottom: 0;">
                        <span style="font-size: 18px;">✉️</span> Email
                    </a>
                    <a href="#" style="display: flex; align-items: center; gap: 8px; margin-bottom: 0;">
                        <span style="font-size: 18px;">📸</span> Instagram
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Alamat Kantor & Workshop</h4>
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="font-size: 18px;">📍</span>
                    <p style="margin: 0;">
                        Jl. Dr. Radjiman No. 88,<br>
                        Laweyan, Kota Surakarta,<br>
                        Jawa Tengah, 57141
                    </p>
                </div>
            </div>

            <div class="footer-col">
                <h4>Jam Kerja</h4>
                <p>Dukungan kami tersedia untuk membantu Anda 24 jam sehari, tujuh hari seminggu.</p>
                <table class="work-hours">
                    <tr>
                        <td>Senin - Jumat</td>
                        <td>08:00 AM - 05:00 PM</td>
                    </tr>
                    <tr>
                        <td>Sabtu</td>
                        <td>08:00 AM - 03:00 PM</td>
                    </tr>
                    <tr>
                        <td>Minggu</td>
                        <td style="color: #666; font-weight: normal;">Libur</td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="footer-bottom">
            &copy; 2026 Retro Collection. All rights reserved.
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("nav-wrapper");
            menu.classList.toggle("active");
        }
    </script>

</body>
</html>