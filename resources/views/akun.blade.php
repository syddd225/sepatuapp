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
        
        .btn-akun {
            background: transparent;
            color: #C19A6B;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
         }

        .btn-akun:hover {
            opacity:0.8;
        }

        /* Style untuk Modal Pop-up Edit Profil */
        .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
        align-items: center;
        justify-content: center;
        }

        .modal.show {
        display: flex;
        }

        .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #111;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        }

        .form-group {
        margin-bottom: 15px;
        }

        .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #666;
        margin-bottom: 5px;
        text-transform: uppercase;
        }

        .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-family: inherit;
        font-size: 15px;
        }

        .form-control:focus {
        border-color: #C19A6B;
        outline: none;
        }

        .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        border-top: 1px solid #eee;
        padding-top: 15px;
        }

        .btn-cancel {
        background: #eee;
        color: #333;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        }

        .btn-save {
        background: #C19A6B;
        color: #1E1E1E;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        }

        /* Style untuk Navigation Tab ala Shopee */
        .shopee-tabs {
        display: flex;
        background: white;
        margin: 30px 0 20px 0;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
        border-bottom: 3px solid #eee;
        }

        .tab-item {
        flex: 1;
        text-align: center;
        padding: 15px 0;
        font-weight: 600;
        font-size: 15px;
        color: #555;
        cursor: pointer;
        transition: 0.3s;
        border-bottom: 3px solid transparent;
        margin-bottom: -3px;
        }

        .tab-item:hover {
        color: #C19A6B;
        }

        .tab-item.active {
        color: #C19A6B;
        border-bottom-color: #C19A6B;
        }

        /* Container untuk isi pesanan */
        .order-content-container {
        display: none;
        }

        .order-content-container.active {
        display: block;
        }

        .order-card {
        background: white; 
        border-radius: 8px; 
        padding: 20px; 
        margin-bottom: 15px; 
        box-shadow: 0 2px 8px rgba(0,0,0,0.05); 
        border-left: 4px solid #C19A6B; 
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        }

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

    </style>
</head>

<body>

    <div class="navbar">
        <h2>Retro Collection</h2>
        <div class="nav-wrapper">
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/#kategori">Kategori</a>
                <a href="/#tentang-kami">Tentang Kami</a>
                <a href="/#kontak">Kontak</a>
            </div>
            <div class="auth-links">
                @auth
                    <a href="{{ route('akun') }}" class="btn-akun">Akun Saya</a>
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
    

    <div class="profile-container">
        <h1 class="profile-title">Informasi Akun</h1>
        
        <div class="profile-card" style="margin-bottom: 30px;">
            <div class="profile-header">
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
                <button type="button" class="btn-login" style="border:none; cursor:pointer;" onclick="openModal()">Edit Profil</button>
            </div>
        </div>

        <div class="shopee-tabs">
            <div class="tab-item active" onclick="switchTab(event, 'all')">Semua Pesanan</div>
            <div class="tab-item" onclick="switchTab(event, 'dikemas')">Dikemas</div>
            <div class="tab-item" onclick="switchTab(event, 'dikirim')">Dikirim</div>
            <div class="tab-item" onclick="switchTab(event, 'selesai')">Selesai</div>
        </div>

        <div id="all" class="order-content-container active">
            @forelse($orders as $order)
                <div class="order-card">
                    <div>
                        <span style="font-size: 11px; font-weight: 600; color: #888;">{{ $order->transaction_id }}</span>
                        <h4 style="font-size: 16px; margin: 5px 0; color: #222;">{{ $order->product->name ?? 'Produk' }}</h4>
                        <p style="font-size: 13px; color: #666;">Varian: {{ $order->warna }} (Size: {{ $order->ukuran }}) | Qty: {{ $order->qty }} pasang</p>
                        <small style="color: #aaa;">Tgl: {{ $order->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <div style="text-align: right;">
                        <span style="font-weight: 700; color: #2e7d32; display: block; margin-bottom: 8px;">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        @if($order->status == 'diproses')
                            <span style="background-color: #fff3cd; color: #856404; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Sedang Dikemas</span>
                        @elseif($order->status == 'siap_kirim')
                            <span style="background-color: #cce5ff; color: #004085; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Sedang Dikirim</span>
                        @elseif($order->status == 'sudah_sampai')
                            <span style="background-color: #d4edda; color: #155724; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Sudah Sampai</span>
                        @endif
                    </div>
                </div>
            @empty
                <div style="background: white; padding: 30px; text-align: center; color: #888; border-radius: 8px; border: 1px solid #eee;">Belum ada riwayat transaksi.</div>
            @endforelse
        </div>

        <div id="dikemas" class="order-content-container">
            @php $hasDikemas = false; @endphp
            @foreach($orders as $order)
                @if($order->status == 'diproses')
                    @php $hasDikemas = true; @endphp
                    <div class="order-card">
                        <div>
                            <span style="font-size: 11px; font-weight: 600; color: #888;">{{ $order->transaction_id }}</span>
                            <h4 style="font-size: 16px; margin: 5px 0; color: #222;">{{ $order->product->name ?? 'Produk' }}</h4>
                            <p style="font-size: 13px; color: #666;">Varian: {{ $order->warna }} (Size: {{ $order->ukuran }}) | Qty: {{ $order->qty }} pasang</p>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-weight: 700; color: #2e7d32; display: block; margin-bottom: 8px;">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                            <span style="background-color: #fff3cd; color: #856404; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Sedang Dikemas</span>
                        </div>
                    </div>
                @endif
            @endforeach
            @if(!$hasDikemas)
                <div style="background: white; padding: 30px; text-align: center; color: #888; border-radius: 8px; border: 1px solid #eee;">Tidak ada paket yang sedang dikemas.</div>
            @endif
        </div>

        <div id="dikirim" class="order-content-container">
            @php $hasDikirim = false; @endphp
            @foreach($orders as $order)
                @if($order->status == 'siap_kirim')
                    @php $hasDikirim = true; @endphp
                    <div class="order-card">
                        <div>
                            <span style="font-size: 11px; font-weight: 600; color: #888;">{{ $order->transaction_id }}</span>
                            <h4 style="font-size: 16px; margin: 5px 0; color: #222;">{{ $order->product->name ?? 'Produk' }}</h4>
                            <p style="font-size: 13px; color: #666;">Varian: {{ $order->warna }} (Size: {{ $order->ukuran }}) | Qty: {{ $order->qty }} pasang</p>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-weight: 700; color: #2e7d32; display: block; margin-bottom: 8px;">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                            <span style="background-color: #cce5ff; color: #004085; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Paket Sedang Dikirim</span>
                        </div>
                    </div>
                @endif
            @endforeach
            @if(!$hasDikirim)
                <div style="background: white; padding: 30px; text-align: center; color: #888; border-radius: 8px; border: 1px solid #eee;">Tidak ada paket yang sedang dikirim.</div>
            @endif
        </div>

        <div id="selesai" class="order-content-container">
            @php $hasSelesai = false; @endphp
            @foreach($orders as $order)
                @if($order->status == 'sudah_sampai')
                    @php $hasSelesai = true; @endphp
                    <div class="order-card">
                        <div>
                            <span style="font-size: 11px; font-weight: 600; color: #888;">{{ $order->transaction_id }}</span>
                            <h4 style="font-size: 16px; margin: 5px 0; color: #222;">{{ $order->product->name ?? 'Produk' }}</h4>
                            <p style="font-size: 13px; color: #666;">Varian: {{ $order->warna }} (Size: {{ $order->ukuran }}) | Qty: {{ $order->qty }} pasang</p>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-weight: 700; color: #2e7d32; display: block; margin-bottom: 8px;">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                            <span style="background-color: #d4edda; color: #155724; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Sudah Sampai</span>
                        </div>
                    </div>
                @endif
            @endforeach
            @if(!$hasSelesai)
                <div style="background: white; padding: 30px; text-align: center; color: #888; border-radius: 8px; border: 1px solid #eee;">Belum ada paket yang selesai dikirim.</div>
            @endif
        </div>
        
    </div> <div id="editProfilModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Edit Profil Saya</div>
            <form action="{{ route('akun.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                </div>

                <div class="form-group">
                    <label>Nomor WhatsApp / Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" placeholder="Contoh: 0895321683364">
                </div>

                <div class="form-group">
                    <label>Alamat Pengiriman</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap pengiriman rumah Anda">{{ auth()->user()->address }}</textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
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
                <h4>Alamat Kantor</h4>
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
    function switchTab(evt, tabId) {
        var i, content, tablinks;
        content = document.getElementsByClassName("order-content-container");
        for (i = 0; i < content.length; i++) {
            content[i].classList.remove("active");
        }
        tablinks = document.getElementsByClassName("tab-item");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabId).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    function openModal() {
        document.getElementById("editProfilModal").classList.add("show");
    }

    function closeModal() {
        document.getElementById("editProfilModal").classList.remove("show");
    }

    window.onclick = function(event) {
        var modal = document.getElementById("editProfilModal");
        if (event.target == modal) {
            modal.classList.remove("show");
        }
    }
    </script>
</body>
</html>