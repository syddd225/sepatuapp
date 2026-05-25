<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boots Corner</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #C19A6B;
            --dark: #1E1E1E;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #F5F5F5;
            color: #111;
        }

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 15px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }

        .logo {
            color: white;
            font-weight: 700;
            font-size: 20px;
        }

        .menu a {
            color: white;
            margin-left: 25px;
            text-decoration: none;
            font-size: 14px;
            opacity: 0.8;
        }

        .menu a:hover {
            color: var(--gold);
            opacity: 1;
        }

        /* HERO */
        .hero {
            height: 90vh;
            background:
                linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                url('/image/bg.jpg.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero h1 {
            font-size: 5rem;
            color: white;
            margin: 0;
        }

        .hero p {
            margin-top: 10px;
            opacity: 0.9;
            font-size: 1.5rem;
            color: white;
        }

        /* SECTION */
        .section {
            padding: 80px 20px;
            max-width: 1100px;
            margin: auto;
        }

        .title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 40px;
            color: #111;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        /* CARD */
        .card {
            background-color: #1E1E1E;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 25vh;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            margin-bottom: 15px;
            font-size: 3.5rem;
            color: white;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 30px;
            background: #C19A6B;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background: #a8855a;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <!-- <div class="navbar">
        <div class="logo">👟 Boots Corner</div>

        <div class="menu">
            <a href="/">Home</a>
            <a href="/category/1">Formal</a>
            <a href="/category/2">Casual</a>
            <a href="/category/3">Boots</a>
        </div>
    </div> -->

    <!-- HERO -->
    <div class="hero">
        <div>
            <h1>Retro Collection</h1>
            <p>Kualitas Premium. Gaya Abadi.</p>
        </div>
    </div>

    <!-- CATEGORY -->
    <div class="section">
        <h2 class="title">Pilih Kategori Sepatu</h2>

        <div class="grid">

            <div class="card">
                <h3>Formal</h3>
                <a href="/category/1" class="btn">Lihat Produk</a>
            </div>

            <div class="card">
                <h3>Casual</h3>
                <a href="/category/2" class="btn">Lihat Produk</a>
            </div>

            <div class="card">
                <h3>Boots</h3>
                <a href="/category/3" class="btn">Lihat Produk</a>
            </div>

        </div>
    </div>

</body>

</html>