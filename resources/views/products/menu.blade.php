<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retro Collection - Etalase Pengrajin Lokal</title>

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

        /* NAVBAR UTAMA */
        .navbar {
            position: sticky;
            top: 0;
            width: 100%;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Diperbaiki dari 'right' menjadi 'center' */
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

        /* WRAPPER MENU KANAN (Desktop) */
        .nav-wrapper {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: flex-end; /* Memaksa menu ke kanan */
            gap: 30px; /* Jarak antara menu teks dan tombol auth */
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

        /* IKON HAMBURGER MENU (Sembunyi di Desktop) */
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

        /* HERO */
        .hero {
            height: 80vh;
            background:
                linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.85)),
                url('/image/bg.jpg.jpeg') center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 4rem;
            color: white;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
            color: #ddd;
            max-width: 650px;
            line-height: 1.6;
        }

        /* KATEGORI SECTION */
        .section {
            padding: 90px 20px;
            max-width: 1100px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            margin-bottom: 50px;
            color: #111;
            font-weight: 700;
        }

        .section-title span {
            color: #C19A6B;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .card {
            background-color: white;
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-bottom: 4px solid transparent;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-bottom: 4px solid #C19A6B;
        }

        .card h3 {
            margin-bottom: 15px;
            font-size: 28px;
            color: #111;
        }

        .card p {
            color: #666;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.5;
            min-height: 40px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 8px;
            background: #1E1E1E;
            color: white;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn:hover {
            background: #C19A6B;
        }

        /* ABOUT SECTION */
        .about-section {
            background-color: #1E1E1E;
            padding: 100px 20px;
            color: white;
            text-align: center;
        }

        .about-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .about-subtitle {
            color: #C19A6B;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .about-title {
            font-size: 36px;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .about-text {
            font-size: 17px;
            line-height: 1.8;
            color: #ccc;
            margin-bottom: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            text-align: justify;
        }

        .quote {
            font-size: 22px;
            font-style: italic;
            color: white;
            margin-bottom: 40px;
            font-weight: 300;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .about-feature {
            background: rgba(255, 255, 255, 0.03);
            padding: 35px 25px;
            border-radius: 12px;
            border-bottom: 3px solid #C19A6B;
            text-align: justify;
            transition: 0.3s;
        }

        .about-feature:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px);
        }

        .about-feature h3 {
            color: #C19A6B;
            margin-bottom: 15px;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .about-feature p {
            font-size: 15px;
            color: #bbb;
            line-height: 1.7;
        }

        /* MEGA FOOTER */
        .footer-complex {
            background-color: #050505;
            color: #ccc;
            padding: 70px 40px 30px;
            font-family: 'Inter', sans-serif;
            width: 100%;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
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
           RESPONSIVE MOBILE & HAMBURGER MENU
           ------------------------------------- */
        @media(max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .navbar h2 {
                font-size: 20px;
            }

            /* Tampilkan Ikon Hamburger */
            .menu-toggle {
                display: flex;
            }

            /* Sembunyikan Menu secara default */
            .nav-wrapper {
                display: none; /* INI YANG MEMPERBAIKI MASALAH MACET */
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

            /* Saat ikon diklik, class .active ditambahkan, menu muncul */
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

            .hero h1 {
                font-size: 2.5rem;
            }

            .about-title {
                font-size: 28px;
            }

            .footer-complex {
                padding: 50px 20px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Retro Collection</h2>

        <div class="menu-toggle" id="mobile-menu" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="nav-wrapper" id="nav-wrapper">
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="#kategori">Kategori</a>
                <a href="#tentang-kami">Tentang Kami</a>
                <a href="#kontak">Kontak</a>
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
        <h1>Karya Tangan Lokal,<br>Kualitas Global.</h1>
        <p>Sebuah etalase digital yang didedikasikan untuk mengangkat keindahan, ketangguhan, dan detail mahakarya sepatu dari para pengrajin lokal terbaik Nusantara.</p>
    </div>

    <div class="section" id="kategori">
        <h2 class="section-title">Koleksi <span>Pilihan</span></h2>

        <div class="grid">
            @foreach($categories as $category)
            <div class="card">
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description ?? 'Koleksi sepatu '.$category->name.' terbaik untuk gaya Anda.' }}</p>
                <a href="/category/{{ $category->id }}" class="btn">Lihat Produk</a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="about-section" id="tentang-kami">
        <div class="about-container">
            <div class="about-subtitle">Panggung Untuk Pengrajin Lokal</div>
            <h2 class="about-title">Menghubungkan Karya Terbaik Langsung ke Tangan Anda.</h2>

            <div class="quote">
                "Mahakarya luar biasa seringkali bersembunyi di bengkel-bengkel kecil, menunggu untuk ditemukan."
            </div>

            <p class="about-text">
                Banyak pengrajin sepatu lokal kita yang memiliki dedikasi dan keterampilan luar biasa dalam memproduksi alas kaki berkualitas tinggi, namun kesulitan dalam menjangkau masyarakat luas. <strong>Retro Collection</strong> hadir sebagai solusi dan jembatan etalase digital untuk mereka.
            </p>
            <p class="about-text">
                Setiap pasang sepatu yang dipamerkan di sini adalah hasil dari jahitan tangan, pemilihan material kulit yang cermat, dan kerja keras para pengrajin lokal. Kami menyediakan platform yang estetik agar Anda bisa mengapresiasi detail karya mereka dengan mudah.
            </p>

            <div class="about-grid">
                <div class="about-feature">
                    <h3>Etalase Visual Estetik</h3>
                    <p>Kami menyajikan tampilan galeri produk yang bersih dan elegan. Anda dapat melihat foto-foto produk dari berbagai sudut untuk memastikan kualitas presisi jahitan dan bentuk sepatu buatan pengrajin.</p>
                </div>
                <div class="about-feature">
                    <h3>Transparansi Material</h3>
                    <p>Masyarakat berhak tahu apa yang mereka kenakan. Oleh karena itu, kami memberikan informasi detail mengenai jenis bahan, kualitas kulit, hingga tipe sol yang digunakan oleh pengrajin pada setiap karya sepatunya.</p>
                </div>
                <div class="about-feature">
                    <h3>Langsung ke Pengrajin</h3>
                    <p>Tanpa sistem keranjang belanja yang rumit. Jika Anda tertarik dengan sebuah produk, sistem kami akan langsung menghubungkan Anda secara personal ke WhatsApp pengrajin untuk bertransaksi dengan mudah.</p>
                </div>
            </div>

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
                <a href="/#kontak">Hubungi Kami</a>
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