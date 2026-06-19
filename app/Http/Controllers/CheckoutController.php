<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

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
}