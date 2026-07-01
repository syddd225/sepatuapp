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

        // Tangkap data shipping & voucher dari request
        $shippingTier = $request->input('shipping_tier', 'regular');
        $shippingName = $request->input('shipping_name', 'J&T Express');
        $shippingEstimation = $request->input('shipping_estimation', '2-3 Hari');
        
        $baseDeliveryFee = floatval($request->input('base_delivery_fee', 10000));
        $shippingTierFee = floatval($request->input('shipping_tier_fee', 0));
        $totalShippingCost = floatval($request->input('total_shipping_cost', 10000));

        // KODE DISESUAIKAN: Mengubah nilai default '-' menjadi 0 agar tidak memicu SQL Error 1366 Integer
        $useVoucher = $request->input('use_voucher', 0);
        $voucherDiscount = floatval($request->input('voucher_discount', 0));
        $paymentMethod = $request->input('payment_method', 'cod');

        // Hitung total harga produk asli
        $totalProductPrice = $product->price * $qty;

        // Grand Total = (Total Produk - Diskon Voucher) + Total Ongkir
        $grandTotal = ($totalProductPrice - $voucherDiscount) + $totalShippingCost;
        if ($grandTotal < 0) $grandTotal = 0;

        // Generate ID Transaksi Unik secara otomatis (Contoh: RC-20231025-00123)
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
            'status'=> 'diproses',
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
            'transactionDate'
        ));
    }
}