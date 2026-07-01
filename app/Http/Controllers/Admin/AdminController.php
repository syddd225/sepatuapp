<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order; // TAMBAHAN: Import Model Order untuk membaca log transaksi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

/**
 * AdminController
 * * CRUD operations untuk product management
 * Simple password-based authentication
 */
class AdminController extends Controller
{
    /**
     * Check if user is authenticated as admin
     */
    private function checkAuth()
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }
    }

    /**
     * Display admin login form
     * * GET /admin/login
     * \n     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle admin login
     * * POST /admin/login
     * * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        if ($request->password === $adminPassword) {
            session(['admin_authenticated' => true]);
            Log::info('Admin login successful');
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Password salah!']);
    }

    /**
     * Handle admin logout
     * * POST /admin/logout
     * * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session()->forget('admin_authenticated');
        Log::info('Admin logged out');
        return redirect()->route('admin.login');
    }

    /**
     * Display admin dashboard (Product List)
     * * GET /admin/dashboard
     * * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $this->checkAuth();

        try {
            $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(10);
            $categories = Category::all();

            // KODE DIPERBAIKI: Mengembalikan fungsi perhitungan statistik bawaan Anda agar tidak 0
            $totalProducts = Product::count();
            $lowStockProducts = Product::where('stock', '<=', 5)->count(); // ganti angka 5 sesuaikan batas stok rendah Anda jika berbeda

            return view('admin.dashboard', [
                'products' => $products,
                'categories' => $categories,
                'searchQuery' => '',
                'selectedCategory' => '',
                'totalProducts' => $totalProducts,     // Mengirim kembali total produk asli
                'lowStockProducts' => $lowStockProducts, // Mengirim kembali data stok rendah asli
            ]);
        } catch (Exception $e) {
            Log::error('Failed to load dashboard data', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal memuat data dashboard');
        }
    }

    /**
     * Show the form for creating a new product
     * * GET /admin/products/create
     * * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->checkAuth();
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage
     * * POST /admin/products
     * * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->checkAuth();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images_angles' => 'nullable|string',
            'whatsapp_phone' => 'nullable|string'
        ]);

        try {
            $data = $request->except('image', 'images_angles');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image'), $imageName);
                $data['image'] = $imageName;
            }

            if ($request->filled('images_angles')) {
                $angles = array_map('trim', explode(',', $request->input('images_angles')));
                $data['images_angles'] = $angles;
            }

            Product::create($data);

            return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan');
        } catch (Exception $e) {
            Log::error('Product creation failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal menambahkan produk')->withInput();
        }
    }

    /**
     * Show the form for editing the specified product
     * * GET /admin/products/{id}/edit
     * * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->checkAuth();
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage
     * * PUT /admin/products/{id}
     * * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->checkAuth();
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images_angles' => 'nullable|string',
            'whatsapp_phone' => 'nullable|string'
        ]);

        try {
            $data = $request->except('image', 'images_angles');

            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path('image/' . $product->image))) {
                    unlink(public_path('image/' . $product->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image'), $imageName);
                $data['image'] = $imageName;
            }

            if ($request->has('images_angles')) {
                if ($request->filled('images_angles')) {
                    $angles = array_map('trim', explode(',', $request->input('images_angles')));
                    $data['images_angles'] = $angles;
                } else {
                    $data['images_angles'] = null;
                }
            }

            $product->update($data);

            return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diperbarui');
        } catch (Exception $e) {
            Log::error('Product update failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal memperbarui produk')->withInput();
        }
    }

    /**
     * Remove the specified product from storage
     * * DELETE /admin/products/{id}
     * * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->checkAuth();
        $product = Product::findOrFail($id);

        try {
            if ($product->image && file_exists(public_path('image/' . $product->image))) {
                unlink(public_path('image/' . $product->image));
            }

            $product->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus');
        } catch (Exception $e) {
            Log::error('Failed to delete product', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Gagal menghapus produk');
        }
    }

    /**
     * Search products
     * * GET /admin/products/search
     * * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $this->checkAuth();

        try {
            $query = $request->input('q', '');
            $category = $request->input('category', '');

            $products = Product::with('category');

            if ($query) {
                $products = $products->where('name', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%");
            }

            if ($category) {
                $products = $products->where('category_id', $category);
            }

            $products = $products->orderBy('created_at', 'desc')->paginate(10);
            $categories = Category::all();

            return view('admin.dashboard', [
                'products' => $products,
                'categories' => $categories,
                'searchQuery' => $query,
                'selectedCategory' => $category,
            ]);
        } catch (Exception $e) {
            Log::error('Search failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Pencarian gagal');
        }
    }

    /**
     * =========================================================================
     * FITUR MANAJEMEN STATUS PEMBELIAN (ADMIN LOG VIA NOMOR 2 & 3)
     * =========================================================================
     */

    /**
     * Menampilkan Halaman Log Transaksi Masuk
     */
    public function orderLog()
    {
        $this->checkAuth();

        // Mengambil semua order terbaru beserta relasi produk dan data user yang membeli
        $orders = Order::with(['product', 'user'])->orderBy('created_at', 'desc')->get();
        
        return view('admin.order', compact('orders'));
    }

    /**
     * Memproses Perubahan Status Paket via Tombol Opsi ACC Paket
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $this->checkAuth();

        $request->validate([
            'status' => 'required|in:siap_kirim,sudah_sampai'
        ]);

        $order = \App\Models\Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status paket #' . $order->transaction_id . ' berhasil diperbarui!');
    }
}
