<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Secure Checkout - Retro Collection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F4F6F8;
            color: #212529;
            line-height: 1.5;
        }

        /* NAVBAR SECURE */
        .navbar {
            background-color: #1E1E1E;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar h2 {
            font-weight: 700;
            color: white;
            font-size: 22px;
            letter-spacing: 0.5px;
        }

        .navbar-secure-badge {
            color: #C19A6B;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(193, 154, 107, 0.1);
            padding: 6px 14px;
            border-radius: 20px;
        }

        /* MAIN LAYOUT */
        .checkout-container {
            max-width: 1100px;
            margin: 40px auto 80px;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 35px;
        }

        /* KARTU UTAMA (SECTION) */
        .checkout-section {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid #EAEAEA;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #111;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 2px solid #F0F0F0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ITEM CARD */
        .item-card {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            background: #F5F5F5;
            border: 1px solid #EEE;
        }

        .item-info {
            flex-grow: 1;
        }

        .item-name {
            font-size: 17px;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
        }

        .item-meta {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .badge-variant {
            background: #F8F9FA;
            border: 1px solid #EAEAEA;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #555;
        }

        .badge-variant.highlight {
            background: #FCF9F5;
            border-color: #D4B895;
            color: #C19A6B;
        }

        .item-price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .item-price {
            font-weight: 700;
            color: #C19A6B;
            font-size: 16px;
        }

        /* QUANTITY CONTROLLER */
        .qty-control {
            display: flex;
            align-items: center;
            background: #F8F9FA;
            border: 1px solid #EAEAEA;
            border-radius: 8px;
            overflow: hidden;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            color: #555;
            transition: 0.2s;
        }

        .qty-btn:hover {
            background: #EAEAEA;
            color: #111;
        }

        .qty-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            font-size: 14px;
            pointer-events: none; /* Mencegah user mengetik sembarangan */
        }

        /* OPTIONS GRID (KARTU PENGIRIMAN & PEMBAYARAN) */
        .options-grid {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .option-card {
            border: 2px solid #F0F0F0;
            border-radius: 12px;
            padding: 18px 20px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #FAFAFA;
        }

        .option-card input[type="radio"] {
            accent-color: #C19A6B;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .option-card:hover {
            background-color: #FFF;
            border-color: #D4B895;
            box-shadow: 0 4px 15px rgba(193, 154, 107, 0.1);
        }

        .option-card.selected {
            border-color: #C19A6B;
            background-color: #FCF9F5;
            box-shadow: 0 4px 20px rgba(193, 154, 107, 0.15);
        }

        .option-details {
            flex-grow: 1;
        }

        .option-title {
            font-weight: 600;
            font-size: 15px;
            color: #111;
            margin-bottom: 2px;
        }

        .option-desc {
            font-size: 13px;
            color: #777;
        }

        .option-price {
            font-weight: 700;
            font-size: 15px;
            color: #111;
            background: #FFF;
            padding: 6px 12px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        /* VOUCHER COMPONENT */
        .voucher-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(to right, #F6FFF7, #E8F5E9);
            border: 2px dashed #81C784;
            padding: 20px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .voucher-box:hover {
            border-color: #4CAF50;
            background: #E8F5E9;
        }

        .voucher-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #1B5E20;
        }

        .voucher-icon {
            font-size: 28px;
        }

        .voucher-title {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 3px;
        }

        .voucher-desc {
            font-size: 13px;
            opacity: 0.9;
        }

        /* TOGGLE SWITCH CUSTOM */
        .switch {
            position: relative;
            display: inline-block;
            width: 54px;
            height: 28px;
        }

        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #D1D1D1;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        input:checked + .slider {
            background-color: #2E7D32;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        /* SUMMARY SIDEBAR (SISI KANAN) */
        .summary-sidebar {
            position: sticky;
            top: 20vh; 
            height: fit-content;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            font-size: 14.5px;
            color: #555;
            font-weight: 500;
        }

        .summary-row.total {
            border-top: 2px dashed #EAEAEA;
            margin-top: 20px;
            padding-top: 20px;
            font-size: 18px;
            font-weight: 700;
            color: #111;
        }

        .total-price-value {
            color: #C19A6B;
            font-size: 22px;
        }

        .btn-checkout {
            width: 100%;
            background: #1E1E1E;
            color: white;
            border: none;
            padding: 18px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 25px;
            box-shadow: 0 4px 15px rgba(30, 30, 30, 0.2);
        }

        .btn-checkout:hover {
            background: #C19A6B;
            box-shadow: 0 6px 20px rgba(193, 154, 107, 0.3);
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }
            .navbar {
                padding: 15px 20px;
            }
            .summary-sidebar {
                position: static;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Retro Collection</h2>
        <div class="navbar-secure-badge">
            🔒 Pembayaran Terenkripsi
        </div>
    </div>

    <form action="{{ route('checkout.complete', $product->id) }}" method="POST">
        @csrf
        <input type="hidden" name="ukuran" value="{{ $ukuran }}">
        <input type="hidden" name="warna" value="{{ $warna }}">

        <div class="checkout-container">

        <!-- KIRI: RINCIAN ORDER, PENGIRIMAN, PEMBAYARAN -->
        <div>
            <!-- Detail Pesanan -->
            <div class="checkout-section">
                <div class="section-title">Detail Pesanan Produk</div>
                <div class="item-card">
                    @if(!empty($product->image))
                        <img src="/image/{{ $product->image }}" class="item-image" alt="{{ $product->name }}">
                    @else
                        <div class="item-image" style="display: flex; align-items: center; justify-content: center; background: #1E1E1E; color: #C19A6B; font-size: 24px;">👟</div>
                    @endif
                    
                    <div class="item-info">
                        <div class="item-name" id="prodName">{{ $product->name }}</div>
                        
                        <div class="item-meta">
                            <span class="badge-variant">Ukuran: {{ $ukuran }}</span>
                            <span class="badge-variant highlight">Warna: {{ $warna }}</span>
                        </div>
                        
                        <div class="item-price-row">
                            <div class="item-price">Rp <span id="basePrice">{{ number_format($product->price, 0, ',', '.') }}</span></div>
                            
                            <div class="qty-control">
                                <button type="button" class="qty-btn" onclick="alterQty(-1)">-</button>
                                <input type="text" id="itemQty" name="qty" class="qty-input" value="1" readonly>
                                <button type="button" class="qty-btn" onclick="alterQty(1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Opsi Pengiriman -->
            <div class="checkout-section">
                <div class="section-title">Opsi Pengiriman</div>
                <div class="options-grid">
                    
                    <label class="option-card selected" onclick="selectShipping(this, 5000)">
                        <input type="radio" name="shipping_tier" value="hemat" checked>
                        <div class="option-details">
                            <div class="option-title">Hemat Kargo</div>
                            <div class="option-desc">Estimasi tiba dalam 5-8 hari kerja</div>
                        </div>
                        <div class="option-price">+Rp 5.000</div>
                    </label>

                    <label class="option-card" onclick="selectShipping(this, 8000)">
                        <input type="radio" name="shipping_tier" value="reguler">
                        <div class="option-details">
                            <div class="option-title">Reguler Standard</div>
                            <div class="option-desc">Estimasi tiba dalam 2-4 hari kerja</div>
                        </div>
                        <div class="option-price">+Rp 8.000</div>
                    </label>

                    <label class="option-card" onclick="selectShipping(this, 10000)">
                        <input type="radio" name="shipping_tier" value="prioritas">
                        <div class="option-details">
                            <div class="option-title">Prioritas Ekspres</div>
                            <div class="option-desc">Pengiriman super cepat 1-2 hari kerja tiba</div>
                        </div>
                        <div class="option-price">+Rp 10.000</div>
                    </label>

                </div>
            </div>

            <!-- Voucher Toko -->
            <div class="checkout-section">
                <div class="section-title">Voucher Toko Tersedia</div>
                <div class="voucher-box">
                    <div class="voucher-info">
                        <span class="voucher-icon">🎫</span>
                        <div>
                            <div class="voucher-title">Voucher Gratis Ongkir</div>
                            <div class="voucher-desc">Memotong seluruh biaya pengiriman & jasa antar</div>
                        </div>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="voucherToggle" name="use_voucher" value="1" onchange="calculateGrandTotal()">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="checkout-section">
                <div class="section-title">Metode Pembayaran</div>
                <div class="options-grid">
                    
                    <label class="option-card selected" onclick="selectPayment(this)">
                        <input type="radio" name="payment_method" value="transfer" checked>
                        <div class="option-details">
                            <div class="option-title">Transfer Bank Mandiri / BCA</div>
                            <div class="option-desc">Verifikasi otomatis, pesanan langsung diproses pengrajin</div>
                        </div>
                    </label>

                    <label class="option-card" onclick="selectPayment(this)">
                        <input type="radio" name="payment_method" value="cod">
                        <div class="option-details">
                            <div class="option-title">Cash On Delivery (COD)</div>
                            <div class="option-desc">Bayar langsung tunai kepada kurir saat pesanan sampai di tangan</div>
                        </div>
                    </label>

                </div>
            </div>
        </div>

        <!-- KANAN: SUMMARY SIDEBAR -->
        <div class="summary-sidebar">
            <div class="checkout-section">
                <div class="section-title">Rincian Pembayaran Resmi</div>
                
                <div class="summary-row">
                    <div>Total Harga Barang</div>
                    <div id="lblSubtotal">Rp 0</div>
                </div>

                <div class="summary-row">
                    <div>Jasa Pengiriman Toko</div>
                    <div id="lblJasaKirim">Rp 0</div>
                </div>

                <div class="summary-row">
                    <div>Jenis Opsi Kurir</div>
                    <div id="lblOpsiKurir">Rp 0</div>
                </div>

                <div class="summary-row" id="rowPotonganVoucher" style="color: #2E7D32; font-weight: 700; display: none;">
                    <div>Diskon Voucher Ongkir</div>
                    <div id="lblPotonganVoucher">-Rp 0</div>
                </div>

                <div class="summary-row total">
                    <div>Total Pembayaran</div>
                    <div class="total-price-value" id="lblGrandTotal">Rp 0</div>
                </div>

                <button type="submit" class="btn-checkout">Selesaikan Pembayaran</button>
            </div>
        </div>

    </div>
    </form>

    <script>
        const productUnitPrice = parseInt("{{ $product->price }}");
        let selectedShippingCost = 5000;

        function alterQty(change) {
            let qtyInput = document.getElementById('itemQty');
            let currentQty = parseInt(qtyInput.value);
            
            let newQty = currentQty + change;
            if (newQty < 1) newQty = 1; 
            
            qtyInput.value = newQty;
            calculateGrandTotal();
        }

        function selectShipping(element, cost) {
            const cards = element.parentElement.querySelectorAll('.option-card');
            cards.forEach(card => card.classList.remove('selected'));
            
            element.classList.add('selected');
            element.querySelector('input[type="radio"]').checked = true;
            
            selectedShippingCost = cost;
            calculateGrandTotal();
        }

        function selectPayment(element) {
            const cards = element.parentElement.querySelectorAll('.option-card');
            cards.forEach(card => card.classList.remove('selected'));
            
            element.classList.add('selected');
            element.querySelector('input[type="radio"]').checked = true;
        }

        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        function calculateGrandTotal() {
            const qty = parseInt(document.getElementById('itemQty').value);
            const isVoucherApplied = document.getElementById('voucherToggle').checked;

            const totalItemPrice = productUnitPrice * qty;
            const baseDeliveryFee = (qty === 1) ? 10000 : 12000;
            const shippingTierFee = selectedShippingCost;

            let voucherDiscount = 0;
            const totalShippingCost = baseDeliveryFee + shippingTierFee;
            
            if (isVoucherApplied) {
                voucherDiscount = totalShippingCost;
                document.getElementById('rowPotonganVoucher').style.display = 'flex';
            } else {
                document.getElementById('rowPotonganVoucher').style.display = 'none';
            }

            const grandTotal = totalItemPrice + totalShippingCost - voucherDiscount;

            document.getElementById('lblSubtotal').innerText = formatRupiah(totalItemPrice);
            document.getElementById('lblJasaKirim').innerText = formatRupiah(baseDeliveryFee);
            document.getElementById('lblOpsiKurir').innerText = formatRupiah(shippingTierFee);
            document.getElementById('lblPotonganVoucher').innerText = '-' + formatRupiah(voucherDiscount);
            document.getElementById('lblGrandTotal').innerText = formatRupiah(grandTotal);
        }

        window.onload = function() {
            calculateGrandTotal();
        };
    </script>
</body>
</html>