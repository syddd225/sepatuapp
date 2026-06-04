<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retro Collection - Beranda</title>

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
            /* Scroll smooth saat menu Navbar diklik */
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
                linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.75)),
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
            max-width: 600px;
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

        /* GRID KATEGORI */
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
            max-width: 800px;
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
        }

        .quote {
            font-size: 22px;
            font-style: italic;
            color: white;
            margin-bottom: 30px;
            font-weight: 300;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 25px;
            background-color: #111;
            color: #888;
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
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>👟 Retro Collection</h2>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="#kategori">Kategori</a>
            <a href="#tentang-kami">Tentang Kami</a>
        </div>
    </div>

    <div class="hero">
        <h1>Langkah Klasik,<br>Gaya Ikonik.</h1>
        <p>Temukan koleksi sepatu retro premium yang dirancang untuk kenyamanan modern tanpa mengorbankan nilai sejarah.</p>
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
            <div class="about-subtitle">Filosofi Kami</div>
            <h2 class="about-title">Lebih dari Sekadar Alas Kaki</h2>
            
            <div class="quote">
                "Melangkah dengan Gaya Klasik, Nyaman di Era Modern."
            </div>

            <p class="about-text">
                Kami percaya bahwa sepatu bukan sekadar alas kaki, melainkan cerminan karakter dan perjalanan hidup pemakainya. Di <strong>Retro Collection</strong>, kami menghidupkan kembali desain-desain klasik yang tak lekang oleh waktu, dan memadukannya dengan teknologi serta kenyamanan masa kini.
            </p>
            <p class="about-text">
                Setiap jahitan, material kulit, dan lekukan sol dipilih dengan teliti. Misi kami sederhana: memastikan Anda mendapatkan sepatu yang tangguh, elegan, dan siap menemani setiap langkah Anda menggapai tujuan dengan penuh percaya diri.
            </p>
        </div>
    </div>

    <div class="footer">
        &copy; 2026 Retro Collection. All rights reserved.
    </div>

</body>

</html>