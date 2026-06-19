<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout untuk produk tertentu dengan varian pilihan
     */
    public function index(Request $request, $id) 
    {
        // 1. Ambil data produk berdasarkan ID
        $product = Product::findOrFail($id);
        
        // 2. Tangkap data ukuran dan warna dari URL (jika tiada, beri nilai default '-')
        $ukuran = $request->query('ukuran', '-');
        $warna = $request->query('warna', '-');
        
        // 3. Deteksi file view secara automatik dan hantar data varian ke blade
        // $viewName = view()->exists('checkout') ? 'checkout' : 'chekout';
        
        // return view($viewName, compact('product', 'ukuran', 'warna'));
        return view("products.checkout", compact('product', 'ukuran', 'warna'));
    }

    /**
     * Memproses data checkout dan menampilkan struk pembayaran (receipt)
     */
    public function complete(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $ukuran = $request->input('ukuran', '-');
        $warna = $request->input('warna', '-');
        $qty = intval($request->input('qty', 1));
        if ($qty < 1) $qty = 1;

        // Validasi stok produk
        if ($product->stock < $qty) {
            return redirect()->back()->withErrors([
                'stock' => "Maaf, stok tidak mencukupi. Stok tersedia saat ini: {$product->stock} pasang."
            ]);
        }

        // Kurangi stok produk di database
        $product->stock -= $qty;
        $product->save();

        $shippingTier = $request->input('shipping_tier', 'hemat');
        $useVoucher = $request->has('use_voucher') || $request->input('use_voucher') == '1';
        $paymentMethod = $request->input('payment_method', 'transfer');

        // Kalkulasi rincian harga
        $totalItemPrice = $product->price * $qty;
        $baseDeliveryFee = ($qty === 1) ? 10000 : 12000;
        
        $shippingTierFee = 5000;
        $shippingName = 'Hemat Kargo';
        $shippingEstimation = 'Estimasi tiba dalam 5-8 hari kerja';
        if ($shippingTier === 'reguler') {
            $shippingTierFee = 8000;
            $shippingName = 'Reguler Standard';
            $shippingEstimation = 'Estimasi tiba dalam 2-4 hari kerja';
        } elseif ($shippingTier === 'prioritas') {
            $shippingTierFee = 10000;
            $shippingName = 'Prioritas Ekspres';
            $shippingEstimation = 'Estimasi tiba dalam 1-2 hari kerja';
        }

        $totalShippingCost = $baseDeliveryFee + $shippingTierFee;
        $voucherDiscount = $useVoucher ? $totalShippingCost : 0;
        $grandTotal = $totalItemPrice + $totalShippingCost - $voucherDiscount;

        // Generate Transaction ID unik
        $transactionId = 'RC-' . now()->timezone('Asia/Jakarta')->format('Ymd') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $transactionDate = now()->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') . ' WIB';

        // Simpan transaksi ke tabel orders
        $order = Order::create([
            'transaction_id' => $transactionId,
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'qty' => $qty,
            'ukuran' => $ukuran,
            'warna' => $warna,
            'shipping_tier' => $shippingTier,
            'shipping_name' => $shippingName,
            'base_delivery_fee' => $baseDeliveryFee,
            'shipping_tier_fee' => $shippingTierFee,
            'total_shipping_cost' => $totalShippingCost,
            'use_voucher' => $useVoucher,
            'voucher_discount' => $voucherDiscount,
            'payment_method' => $paymentMethod,
            'grand_total' => $grandTotal,
        ]);

        return view('products.receipt', compact(
            'product',
            'ukuran',
            'warna',
            'qty',
            'shippingTier',
            'shippingName',
            'shippingEstimation',
            'shippingTierFee',
            'baseDeliveryFee',
            'totalShippingCost',
            'useVoucher',
            'voucherDiscount',
            'paymentMethod',
            'grandTotal',
            'transactionId',
            'transactionDate',
            'order'
        ));
    }
}