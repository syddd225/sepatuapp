<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Produk - {{ $product->name }}</title>
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
            background-color: #1E1E1E;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .nav-links a:hover {
            opacity: 1;
            color: #C19A6B;
        }

        /* DETAIL CONTAINER */
        .detail-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }

        /* GAMBAR KIRI */
        .product-image img {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            max-height: 500px;
        }

        /* INFO KANAN */
        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-info h1 {
            font-size: 32px;
            color: #111;
            margin-bottom: 10px;
        }

        .price {
            font-size: 24px;
            color: #C19A6B;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .description {
            font-size: 15px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 30px;
        }

        /* -------------------------------------
           KOTAK VARIAN BUKAN DROPDOWN (NEW)
           ------------------------------------- */
        .variant-group {
            margin-bottom: 25px;
        }

        .variant-label {
            font-weight: 600;
            margin-bottom: 12px;
            color: #111;
            display: block;
        }

        .variant-options {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Sembunyikan bulat radio button asli */
        .variant-options input[type="radio"] {
            display: none;
        }

        /* Desain dasar kotak-kotak */
        .box-label {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
            background: white;
            color: #555;
        }

        /* Ukuran spesifik untuk kotak angka */
        .box-ukuran {
            width: 50px;
            height: 50px;
            font-size: 15px;
        }

        /* Ukuran spesifik untuk kotak teks warna */
        .box-warna {
            padding: 12px 20px;
            font-size: 14px;
        }

        /* Efek saat didekati mouse */
        .box-label:hover {
            border-color: #C19A6B;
            color: #C19A6B;
        }

        /* Efek saat opsi dipilih (warna kotak berubah emas) */
        .variant-options input[type="radio"]:checked + .box-label {
            border-color: #C19A6B;
            background: #C19A6B;
            color: white;
            box-shadow: 0 4px 10px rgba(193, 154, 107, 0.3);
        }

        .stock-badge {
            display: inline-block;
            background: #1E1E1E;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        /* TOMBOL */
        .btn-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            text-align: center;
            background: #C19A6B;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #a8855a;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #C19A6B;
            color: #C19A6B;
        }

        .btn-outline:hover {
            background: #C19A6B;
            color: white;
        }

        /* RESPONSIVE UNTUK HP */
        @media(max-width: 768px) {
            .navbar {
                padding: 20px;
                flex-direction: column;
                gap: 15px;
            }

            .detail-container {
                grid-template-columns: 1fr;
                margin: 30px auto;
                gap: 30px;
            }

            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Retro Collection</h2>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/category/1">Formal</a>
            <a href="/category/2">Casual</a>
            <a href="/category/3">Boots</a>
        </div>
    </div>

    <div class="detail-container">
        
        <div class="product-image">
            <img src="/image/{{ $product->image }}" alt="{{ $product->name }}">
        </div>

        <div class="product-info">
            <h1>{{ $product->name }}</h1>
            <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            
            <div class="description">
                {{ $product->description }}
            </div>

            <div class="variant-group">
                <span class="variant-label">Pilih Ukuran (39-45)</span>
                <div class="variant-options">
                    <input type="radio" name="ukuran" id="uk-39" value="39">
                    <label for="uk-39" class="box-label box-ukuran">39</label>

                    <input type="radio" name="ukuran" id="uk-40" value="40">
                    <label for="uk-40" class="box-label box-ukuran">40</label>

                    <input type="radio" name="ukuran" id="uk-41" value="41">
                    <label for="uk-41" class="box-label box-ukuran">41</label>

                    <input type="radio" name="ukuran" id="uk-42" value="42">
                    <label for="uk-42" class="box-label box-ukuran">42</label>

                    <input type="radio" name="ukuran" id="uk-43" value="43">
                    <label for="uk-43" class="box-label box-ukuran">43</label>

                    <input type="radio" name="ukuran" id="uk-44" value="44">
                    <label for="uk-44" class="box-label box-ukuran">44</label>

                    <input type="radio" name="ukuran" id="uk-45" value="45">
                    <label for="uk-45" class="box-label box-ukuran">45</label>
                </div>
            </div>

            <div class="variant-group">
                <span class="variant-label">Pilih Warna/Tekstur</span>
                <div class="variant-options">
                    <input type="radio" name="warna" id="wrn-ori" value="Original">
                    <label for="wrn-ori" class="box-label box-warna">Original</label>

                    <input type="radio" name="warna" id="wrn-gelap" value="Custom Gelap">
                    <label for="wrn-gelap" class="box-label box-warna">Custom Gelap</label>
                </div>
            </div>

            <div>
                <span class="stock-badge">Stok: {{ $product->stock }} Pasang</span>
            </div>

            <div class="btn-group">
                <button onclick="kirimKeWA()" class="btn">
                    Pesan via WhatsApp
                </button>
                <a href="javascript:history.back()" class="btn btn-outline">
                    Kembali
                </a>
    </div>

    <script>
        function kirimKeWA() {
            // Mengecek kotak mana yang sedang diklik (checked)
            let ukuranEl = document.querySelector('input[name="ukuran"]:checked');
            let warnaEl = document.querySelector('input[name="warna"]:checked');
            let namaProduk = "{{ $product->name }}";

            // Peringatan jika pengunjung belum mengklik salah satu kotak
            if(!ukuranEl || !warnaEl) {
                alert("Halo! Tolong klik/pilih Ukuran dan Warna sepatunya dulu ya sebelum memesan.");
                return;
            }

            // Mengambil nilainya
            let ukuran = ukuranEl.value;
            let warna = warnaEl.value;

            // Merangkai isi pesan WA
            let pesan = `Halo Sepatu Retro! Saya tertarik dan ingin memesan sepatu ini:%0A%0A*${namaProduk}*%0A- Ukuran: ${ukuran}%0A- Warna/Tekstur: ${warna}%0A%0AApakah stoknya masih tersedia?`;
            
            // Eksekusi buka WA
            let linkWA = `https://wa.me/62895321683364?text=${pesan}`;
            window.open(linkWA, '_blank');
        }
    </script>

</body>
</html>