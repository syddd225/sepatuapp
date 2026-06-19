<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran Resmi - Retro Collection</title>
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
            padding: 40px 20px;
        }

        .receipt-wrapper {
            max-width: 650px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            border: 1px solid #EAEAEA;
            overflow: hidden;
            position: relative;
        }

        /* Top Accent Gold Bar */
        .receipt-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #C19A6B 0%, #E6C298 100%);
        }

        .receipt-header {
            text-align: center;
            padding: 40px 30px 20px;
            border-bottom: 2px dashed #EAEAEA;
            position: relative;
        }

        /* Receipt Cutout Circles on Sides */
        .receipt-header::before, .receipt-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            width: 20px;
            height: 20px;
            background: #F4F6F8;
            border-radius: 50%;
        }
        .receipt-header::before { left: -10px; }
        .receipt-header::after { right: -10px; }

        .success-icon {
            width: 72px;
            height: 72px;
            background: rgba(46, 125, 50, 0.1);
            color: #2E7D32;
            font-size: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 2px solid rgba(46, 125, 50, 0.2);
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .receipt-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
        }

        .receipt-header p {
            font-size: 14px;
            color: #666;
        }

        .receipt-body {
            padding: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .info-label {
            color: #777;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .info-value {
            color: #111;
            font-weight: 600;
        }

        .transaction-id {
            font-family: monospace;
            color: #C19A6B;
            font-size: 15px;
        }

        /* ITEMS TABLE */
        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #111;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
            border-left: 3px solid #C19A6B;
            padding-left: 10px;
        }

        .item-card {
            display: flex;
            gap: 15px;
            align-items: center;
            background: #F8F9FA;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #EAEAEA;
            margin-bottom: 25px;
        }

        .item-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #EAEAEA;
            background: #FFF;
        }

        .item-image-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            background: #1E1E1E;
            color: #C19A6B;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-weight: 700;
            font-size: 15px;
            color: #111;
            margin-bottom: 4px;
        }

        .item-meta {
            font-size: 12px;
            color: #666;
        }

        .item-qty-price {
            text-align: right;
            font-size: 14px;
        }

        .item-subtotal {
            font-weight: 700;
            color: #C19A6B;
            margin-top: 4px;
        }

        /* PRICE BREAKDOWN */
        .price-breakdown {
            border-top: 1px solid #F0F0F0;
            padding-top: 20px;
            margin-bottom: 25px;
        }

        .breakdown-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #555;
            margin-bottom: 12px;
        }

        .breakdown-row.discount {
            color: #2E7D32;
            font-weight: 600;
        }

        .breakdown-row.grand-total {
            border-top: 2px dashed #EAEAEA;
            margin-top: 15px;
            padding-top: 15px;
            font-size: 18px;
            font-weight: 700;
            color: #111;
        }

        .grand-total-val {
            color: #C19A6B;
            font-size: 22px;
        }

        /* SHIPPING INFO BOX */
        .shipping-info-box {
            background: #FCF9F5;
            border: 1px dashed #D4B895;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 30px;
            font-size: 13.5px;
        }

        .shipping-header {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
        }

        .shipping-desc {
            color: #666;
            margin-bottom: 10px;
        }

        .shipping-address {
            background: #FFF;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #F0E6D8;
            font-size: 12px;
            color: #555;
        }

        /* ACTION BUTTONS */
        .action-area {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary {
            background: #1E1E1E;
            color: #FFF;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background: #C19A6B;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #EAEAEA;
            color: #333;
        }

        .btn-secondary:hover {
            background: #D1D1D1;
            transform: translateY(-2px);
        }

        .btn-whatsapp {
            background: #25D366;
            color: #FFF;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.15);
        }

        .btn-whatsapp:hover {
            background: #128C7E;
            transform: translateY(-2px);
        }

        /* PRINT STYLES */
        @media print {
            body {
                background: #FFF;
                padding: 0;
            }

            .receipt-wrapper {
                box-shadow: none;
                border: none;
                max-width: 100%;
            }

            .receipt-wrapper::before {
                display: none;
            }

            .action-area, .navbar {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="receipt-wrapper">
        <!-- Header Struk -->
        <div class="receipt-header">
            <div class="success-icon">✓</div>
            <h1>Pembayaran Berhasil</h1>
            <p>Terima kasih atas pesanan Anda di Retro Collection</p>
        </div>

        <div class="receipt-body">
            <!-- Info Transaksi -->
            <div class="info-grid">
                <div>
                    <div class="info-label">ID Transaksi</div>
                    <div class="info-value transaction-id">{{ $transactionId }}</div>
                </div>
                <div>
                    <div class="info-label">Waktu Transaksi</div>
                    <div class="info-value">{{ $transactionDate }}</div>
                </div>
                <div>
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value">
                        @if($paymentMethod === 'cod')
                            Cash On Delivery (COD)
                        @else
                            Transfer Bank Mandiri / BCA
                        @endif
                    </div>
                </div>
                <div>
                    <div class="info-label">Nama Pelanggan</div>
                    <div class="info-value">{{ Auth::user()->name }}</div>
                </div>
            </div>

            <!-- Rincian Barang -->
            <div class="section-title">Produk yang Dibeli</div>
            <div class="item-card">
                @if(!empty($product->image))
                    <img src="/image/{{ $product->image }}" class="item-image" alt="{{ $product->name }}">
                @else
                    <div class="item-image-placeholder">👟</div>
                @endif
                
                <div class="item-details">
                    <div class="item-name">{{ $product->name }}</div>
                    <div class="item-meta">Varian: Ukuran {{ $ukuran }}, Warna {{ $warna }}</div>
                </div>

                <div class="item-qty-price">
                    <div>{{ $qty }}x</div>
                    <div class="item-subtotal">Rp {{ number_format($product->price * $qty, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Detail Pengiriman -->
            <div class="section-title">Rincian Pengiriman</div>
            <div class="shipping-info-box">
                <div class="shipping-header">
                    <div>{{ $shippingName }}</div>
                    <div>Rp {{ number_format($baseDeliveryFee + $shippingTierFee, 0, ',', '.') }}</div>
                </div>
                <div class="shipping-desc">{{ $shippingEstimation }}</div>
                <div class="shipping-address">
                    <strong>Alamat Pengiriman:</strong><br>
                    {{ Auth::user()->address ?? 'Alamat belum diatur' }} (Telp: {{ Auth::user()->phone ?? '-' }})
                </div>
            </div>

            <!-- Rincian Biaya -->
            <div class="section-title">Rincian Harga Resmi</div>
            <div class="price-breakdown">
                <div class="breakdown-row">
                    <div>Harga Barang (Subtotal)</div>
                    <div>Rp {{ number_format($product->price * $qty, 0, ',', '.') }}</div>
                </div>
                <div class="breakdown-row">
                    <div>Jasa Pengiriman Dasar</div>
                    <div>Rp {{ number_format($baseDeliveryFee, 0, ',', '.') }}</div>
                </div>
                <div class="breakdown-row">
                    <div>Pilihan Layanan Kurir</div>
                    <div>Rp {{ number_format($shippingTierFee, 0, ',', '.') }}</div>
                </div>

                @if($useVoucher)
                    <div class="breakdown-row discount">
                        <div>Potongan Voucher Ongkir</div>
                        <div>-Rp {{ number_format($totalShippingCost, 0, ',', '.') }}</div>
                    </div>
                @endif

                <div class="breakdown-row grand-total">
                    <div>Total Pembayaran</div>
                    <div class="grand-total-val">Rp {{ number_format($grandTotal, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Action Area -->
            <div class="action-area">
                <button onclick="window.print()" class="btn btn-secondary">Cetak Struk</button>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Lanjut Belanja</a>
                <a href="https://wa.me/628123456789?text=Halo%20Retro%20Collection%2C%20saya%20ingin%20bertanya%20mengenai%20pesanan%20dengan%20ID%20{{ $transactionId }}" target="_blank" class="btn btn-whatsapp">Chat CS WA</a>
            </div>
        </div>
    </div>

</body>

</html>
