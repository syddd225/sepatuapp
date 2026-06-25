<!DOCTYPE html>
<html lang="id">

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
           2. DETAIL PRODUK (KIRI: SLIDER, KANAN: INFO)
           ------------------------------------- */
        .detail-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }

        /* SLIDER KIRI */
        .product-slider-container {
            position: relative;
            width: 100%;
            height: 480px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .slider-wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .slider-slide {
            min-width: 100%;
            height: 100%;
            position: relative;
        }

        .slider-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            color: #111;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            z-index: 10;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: 0.3s;
        }

        .slider-btn:hover {
            background: #C19A6B;
            color: white;
        }

        .slider-btn.prev { left: 16px; }
        .slider-btn.next { right: 16px; }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.2);
            border: 2px solid #fff;
            cursor: pointer;
            transition: 0.3s;
        }

        .dot.active {
            background: #C19A6B;
            width: 24px;
            border-radius: 5px;
        }

        .angle-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(30, 30, 30, 0.85);
            color: #fff;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(4px);
            z-index: 5;
        }

        /* GALLERY THUMBNAILS */
        .product-gallery {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .thumbnail-container {
            display: flex;
            gap: 12px;
            margin-top: 15px;
            justify-content: flex-start;
        }

        .thumbnail-item {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            background-color: #fff;
        }

        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-item:hover {
            border-color: #C19A6B;
            transform: translateY(-2px);
        }

        .thumbnail-item.active {
            border-color: #C19A6B;
            box-shadow: 0 4px 15px rgba(193, 154, 107, 0.35);
        }

        /* INFO PRODUK KANAN */
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

        .variant-options input[type="radio"] {
            display: none;
        }

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

        .box-ukuran {
            width: 50px;
            height: 50px;
            font-size: 15px;
        }

        .box-warna {
            padding: 12px 20px;
            font-size: 14px;
        }

        .box-label:hover {
            border-color: #C19A6B;
            color: #C19A6B;
        }

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

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-main-row {
            display: flex;
            gap: 12px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-checkout {
            background: #1E1E1E;
            color: white;
        }

        .btn-checkout:hover { background: #C19A6B; }

        .btn-wa {
            background: #C19A6B;
            color: white;
        }

        .btn-wa:hover { background: #a8855a; }

        .btn-outline {
            background: transparent;
            border: 2px solid #ddd;
            color: #666;
            font-size: 15px;
            padding: 12px;
        }

        .btn-outline:hover {
            background: #f5f5f5;
            border-color: #999;
            color: #333;
        }
        /* -------------------------------------
           4. RESPONSIVE MOBILE
           ------------------------------------- */
        @media(max-width: 768px) {
            /* Navbar Mobile */
            .navbar { padding: 15px 20px; }
            .navbar h2 { font-size: 20px; }
            .menu-toggle { display: flex; }
            
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

            .nav-wrapper.active { display: flex; }

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

            /* Layout Detail Produk Mobile */
            .detail-container {
                grid-template-columns: 1fr;
                margin: 30px auto;
                gap: 30px;
            }

            .product-slider-container { height: 320px; }
            .btn-main-row { flex-direction: column; }
            .footer-complex { padding: 50px 20px 20px; }
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

    <div class="detail-container">
        
        @php
            $slides = [];
            if (!empty($product->image)) {
                // Teks 'Tampak Utama' dikosongkan
                $slides[] = ['file' => $product->image, 'label' => ''];
            }

            if (!empty($product->images_angles)) {
                $anglesArray = is_array($product->images_angles) ? $product->images_angles : explode(',', $product->images_angles);
                foreach ($anglesArray as $angleFile) {
                    $angleFileClean = trim($angleFile);
                    if (!empty($angleFileClean)) {
                        $slides[] = [
                            'file' => $angleFileClean,
                            'label' => '' // Teks 'Sudut Pandang X' dikosongkan
                        ];
                    }
                }
            }

            // Fallback dinamis jika data multi-angle kosong agar tetap menampilkan carousel premium
            if (count($slides) <= 1 && !empty($product->image)) {
                // Teks detail dikosongkan
                $slides[] = ['file' => $product->image, 'label' => ''];
                $slides[] = ['file' => $product->image, 'label' => ''];
            }
            $slides = array_slice($slides, 0, 4);
        @endphp

        <div class="product-gallery">
            <div class="product-slider-container">
                @if(count($slides) > 0)
                    <div class="slider-wrapper" id="sliderWrapper">
                        @foreach($slides as $slide)
                            <div class="slider-slide">
                                <img src="/image/{{ $slide['file'] }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>

                    @if(count($slides) > 1)
                        <button class="slider-btn prev" onclick="changeSlide(-1)">&#10094;</button>
                        <button class="slider-btn next" onclick="changeSlide(1)">&#10095;</button>
                        
                        <div class="slider-dots">
                            @foreach($slides as $index => $slide)
                                <span class="dot {{ $index == 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></span>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div style="width: 100%; height: 100%; background: #1E1E1E; display: flex; align-items: center; justify-content: center; color: #C19A6B;">
                        <div style="text-align: center;">
                            <div style="font-size: 50px; margin-bottom: 10px;">👟</div>
                            <div>Detail Foto Belum Diunggah</div>
                        </div>
                    </div>
                @endif
            </div>

            @if(count($slides) > 1)
                <div class="thumbnail-container">
                    @foreach($slides as $index => $slide)
                        <div class="thumbnail-item {{ $index == 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})">
                            <img src="/image/{{ $slide['file'] }}" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
            @endif
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
                    <label for="wrn-gelap" class="box-label box-warna">Custom</label>
                </div>
            </div>

            <div>
                <span class="stock-badge">Stok: {{ $product->stock }} Pasang</span>
            </div>

            <div class="btn-group">
                <div class="btn-main-row">
                    <button onclick="prosesCheckout()" class="btn btn-checkout">
                        Pesan Sekarang
                    </button>

                    <button onclick="kirimKeWA()" class="btn btn-wa">
                        Hubungi Kami
                    </button>
                </div>

                <a href="javascript:history.back()" class="btn btn-outline">
                    Kembali ke Katalog
                </a>
            </div>
        </div>
    </div>

    <script>
        // 1. Script Hamburger Menu
        function toggleMenu() {
            var menu = document.getElementById("nav-wrapper");
            menu.classList.toggle("active");
        }

        // 2. Script Slider Produk
        let currentSlideIndex = 0;
        const totalSlides = {{ count($slides) }};

        function updateSlider() {
            const wrapper = document.getElementById('sliderWrapper');
            if(wrapper) {
                wrapper.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
            }
            
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, idx) => {
                if (idx === currentSlideIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });

            const thumbs = document.querySelectorAll('.thumbnail-item');
            thumbs.forEach((thumb, idx) => {
                if (idx === currentSlideIndex) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        }

        function changeSlide(direction) {
            currentSlideIndex += direction;
            if (currentSlideIndex >= totalSlides) currentSlideIndex = 0;
            if (currentSlideIndex < 0) currentSlideIndex = totalSlides - 1;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlideIndex = index;
            updateSlider();
        }

        // 3. Script Proses Checkout (Satu fungsi saja yang valid)
        function prosesCheckout() {
            let ukuranEl = document.querySelector('input[name="ukuran"]:checked');
            let warnaEl = document.querySelector('input[name="warna"]:checked');

            if(!ukuranEl || !warnaEl) {
                alert("Halo! Mohon pilih Ukuran dan Warna sepatu terlebih dahulu sebelum melanjutkan ke halaman pembayaran.");
                return;
            }

            let ukuran = ukuranEl.value;
            let warna = warnaEl.value;

            // Redirect dengan membawa data ukuran dan warna melalui URL Query Parameters
            window.location.href = `/checkout/{{ $product->id }}?ukuran=${ukuran}&warna=${encodeURIComponent(warna)}`;
        }

        // 4. Script Kirim ke WhatsApp
        function kirimKeWA() {
            let ukuranEl = document.querySelector('input[name="ukuran"]:checked');
            let warnaEl = document.querySelector('input[name="warna"]:checked');
            let namaProduk = "{{ $product->name }}";

            let pesan = "";
            
            if(ukuranEl && warnaEl) {
                pesan = `Halo Sepatu Retro! Saya ingin bertanya mengenai produk *${namaProduk}* dengan Ukuran: ${ukuranEl.value} dan Warna: ${warnaEl.value}. Apakah bisa berkonsultasi mengenai detail bahannya?`;
            } else {
                pesan = `Halo Sepatu Retro! Saya ingin bertanya lebih lanjut mengenai produk *${namaProduk}*. Apakah produk ini ready stock?`;
            }
            
            let linkWA = `https://wa.me/{{ $product->whatsapp_phone ?? '62895321683364' }}?text=${encodeURIComponent(pesan)}`;
            window.open(linkWA, '_blank');
        }
    </script>

</body>
</html>