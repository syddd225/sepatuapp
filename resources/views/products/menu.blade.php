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

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 20px 60px;
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
        }

        .nav-links a {
            margin-left: 25px;
            text-decoration: none;
            color: white;
            opacity: 0.8;
            font-size: 16px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            opacity: 1;
            color: #C19A6B;
        }

        /* HERO */
        .hero {
            margin-top: 70px;
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


        /* ABOUT / FILOSOFI SECTION */
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
        }

        .quote {
            font-size: 22px;
            font-style: italic;
            color: white;
            margin-bottom: 40px;
            font-weight: 300;
        }

        /* GRID UNTUK NILAI FILOSOFI */
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
            text-align: left;
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

        /* KONTAK PENGELOLA SECTION */
        .contact-section {
            background-color: #111;
            padding: 70px 20px;
            color: white;
            text-align: center;
        }

        .contact-title {
            color: #C19A6B;
            font-size: 28px;
            margin-bottom: 40px;
            font-weight: 700;
        }

        .contact-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .contact-card {
            background: #1E1E1E;
            padding: 30px 20px;
            border-radius: 10px;
            min-width: 260px;
            flex: 1;
            border: 1px solid #333;
            transition: 0.3s;
        }

        .contact-card:hover {
            border-color: #C19A6B;
            transform: translateY(-5px);
        }

        .contact-card h4 {
            font-size: 20px;
            margin-bottom: 8px;
            color: #fff;
        }

        .contact-card p {
            font-size: 14px;
            color: #C19A6B;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .contact-link {
            display: inline-block;
            padding: 10px 20px;
            background: #25D366;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        .contact-link:hover {
            background: #1ebc59;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #0a0a0a;
            color: #666;
            font-size: 14px;
        }

        /* RESPONSIVE */
        @media(max-width: 768px) {
            .navbar {
                padding: 20px;
                flex-direction: column;
                gap: 15px;
                position: static;
            }
            .hero {
                margin-top: 0;
                height: 60vh;
            }
            .hero h1 {
                font-size: 2.5rem;
            }
            .about-title {
                font-size: 28px;
            }
            .contact-grid {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <h2>👟 Retro Collection</h2>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="#kategori">Kategori</a>
            <a href="#tentang-kami">Tentang Kami</a>
            <a href="#kontak">Kontak</a>
        </div>
    </div>

    <div class="navbar">
        <h2>👟 Retro Collection</h2>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="#kategori">Kategori</a>
            <a href="#tentang-kami">Tentang Kami</a>
            <a href="#kontak">Kontak</a>
        </div>
    </div>

    <div class="navbar">
        @auth
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ef5350;">Logout ({{ auth()->user()->name }})</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="/login" style="background: #C19A6B; color: #1E1E1E; padding: 8px 15px; border-radius: 6px; font-weight: 600;">Masuk / Daftar</a>
        @endauth
    </div>
</div>

    <!-- HERO -->
    <div class="hero">
        <h1>Karya Tangan Lokal,<br>Kualitas Global.</h1>
        <p>Sebuah etalase digital yang didedikasikan untuk mengangkat keindahan, ketangguhan, dan detail mahakarya sepatu dari para pengrajin lokal terbaik Nusantara.</p>
    </div>

    <!-- CATEGORY -->
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

    <!-- ABOUT / FILOSOFI -->
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

            <!-- KOTAK NILAI-NILAI FILOSOFI -->
            <div class="about-grid">
                <div class="about-feature">
                    <h3>📷 Etalase Visual Estetik</h3>
                    <p>Kami menyajikan tampilan galeri produk yang bersih dan elegan. Anda dapat melihat foto-foto produk dari berbagai sudut untuk memastikan kualitas presisi jahitan dan bentuk sepatu buatan pengrajin.</p>
                </div>
                <div class="about-feature">
                    <h3>🔍 Transparansi Material</h3>
                    <p>Masyarakat berhak tahu apa yang mereka kenakan. Oleh karena itu, kami memberikan informasi detail mengenai jenis bahan, kualitas kulit, hingga tipe sol yang digunakan oleh pengrajin pada setiap karya sepatunya.</p>
                </div>
                <div class="about-feature">
                    <h3>💬 Langsung ke Pengrajin</h3>
                    <p>Tanpa sistem keranjang belanja yang rumit. Jika Anda tertarik dengan sebuah produk, sistem kami akan langsung menghubungkan Anda secara personal ke WhatsApp pengrajin untuk bertransaksi dengan mudah.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- KONTAK PENGELOLA (TAMBAHAN BARU) -->
    <div class="contact-section" id="kontak">
        <h2 class="contact-title">Tim Pengelola & Pengrajin</h2>
        <div class="contact-grid">
            
            <!-- Kontak 1 -->
            <div class="contact-card">
                <h4>[Nama Kamu / Rasyad]</h4>
                <p>Owner & Lead Developer</p>
                <a href="https://wa.me/6281234567890" target="_blank" class="contact-link">
                    Hubungi via WhatsApp
                </a>
            </div>

            <!-- Kontak 2 -->
            <div class="contact-card">
                <h4>[Nama Teman 1]</h4>
                <p>Head of Craftsmanship</p>
                <a href="https://wa.me/6281234567891" target="_blank" class="contact-link">
                    Hubungi via WhatsApp
                </a>
            </div>

            <!-- Kontak 3 -->
            <div class="contact-card">
                <h4>[Nama Teman 2]</h4>
                <p>Operational Manager</p>
                <a href="https://wa.me/6281234567892" target="_blank" class="contact-link">
                    Hubungi via WhatsApp
                </a>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        &copy; 2026 Retro Collection - Dukung Pengrajin Lokal.
    </div>

</body>

</html>