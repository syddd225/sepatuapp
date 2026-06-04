<!DOCTYPE html>
<html lang="en">

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
        }

        /* NAVBAR */
        .navbar {
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .navbar h2 {
            font-weight: 700;
            color: white;
        }

        .nav-links a {
            margin-left: 25px;
            text-decoration: none;
            color: white;
            opacity: 0.8;
        }

        .nav-links a:hover {
            opacity: 1;
            color: #C19A6B;
        }

        /* HERO */
        .hero {
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;

            background:
                linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
                url('/image/bg.jpg.jpeg') center/cover;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 700;
            color: #fff;
        }

        .hero p {
            margin-top: 10px;
            opacity: 0.9;
            color: #fff;
        }

        /* SECTION */
        .section {
            padding: 60px;
        }

        .section h2 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #111;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        /* CARD */
        .card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* IMAGE */
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* BODY */
        .card-body {
            padding: 18px;
        }

        .material {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
            line-height: 1.5;
            min-height: 38px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .name {
            font-size: 17px;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .price {
            margin-top: 5px;
            color: #C19A6B;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* BUTTON */
        .btn {
            margin-top: 15px;
            display: block;
            padding: 12px;
            text-align: center;
            background: #C19A6B;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }

        .btn:hover {
            background: #a8855a;
        }

        /* RESPONSIVE */
        @media(max-width: 768px) {
            .navbar {
                padding: 20px;
            }

            .section {
                padding: 40px 20px;
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
            <a href="/category/1">Formal</a>
            <a href="/category/2">Casual</a>
            <a href="/category/3">Boots</a>
        </div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div>
            <h1>{{ $products[0]->category->name ?? 'Retro Collection' }}</h1>
            <p>Kualitas premium. Gaya terbaik untuk kamu.</p>
        </div>
    </div>

    <!-- PRODUCT -->
    <div class="section">

        <h2>{{ $products[0]->category->name ?? 'Produk' }} Collection</h2>

        <div class="grid">

            @foreach($products as $p)
            <div class="card">

                <img src="/image/{{ $p->image }}" alt="{{ $p->name }}">

                <div class="card-body">

                    <div class="material">
                        {{ $p->description }}
                    </div>

                    <div class="name">{{ $p->name }}</div>

                    <div class="price">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </div>

                    <a href="https://wa.me/62895321683364?text=Saya mau {{ urlencode($p->name) }}"
                        class="btn" target="_blank">
                        Pesan Sekarang
                    </a>

                </div>

            </div>
            @endforeach

        </div>

    </div>

</body>

</html>