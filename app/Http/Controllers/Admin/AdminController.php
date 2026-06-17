<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

/**
 * AdminController
 * 
 * CRUD operations untuk product management
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
     * 
     * GET /admin/login
     * 
     * @return \Illuminate\View\View
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
     * 
     * POST /admin/login
     * 
     * @param Request $request
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
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        Log::warning('Failed admin login attempt');
        return back()->with('error', 'Password salah!');
    }

    /**
     * Handle admin logout
     * 
     * POST /admin/logout
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session()->forget('admin_authenticated');
        Log::info('Admin logout');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }

    /**
     * Display dashboard with all products
     * 
     * GET /admin/dashboard
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $this->checkAuth();

        try {
            $products = Product::with('category')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $categories = Category::all();
            $totalProducts = Product::count();
            $lowStockProducts = Product::where('stock', '<', 5)->count();

            return view('admin.dashboard', [
                'products' => $products,
                'categories' => $categories,
                'totalProducts' => $totalProducts,
                'lowStockProducts' => $lowStockProducts,
                'searchQuery' => '',
                'selectedCategory' => '',
            ]);
        } catch (Exception $e) {
            Log::error('Failed to load admin dashboard', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Gagal memuat dashboard');
        }
    }

    /**
     * Show form to create new product
     * 
     * GET /admin/products/create
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->checkAuth();

        try {
            $categories = Category::all();
            return view('admin.products.create', ['categories' => $categories]);
        } catch (Exception $e) {
            Log::error('Failed to load product create form', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Gagal membuka form');
        }
    }

    /**
     * Store new product in database
     * 
     * POST /admin/products
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->checkAuth();

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:products,name',
                'description' => 'required|string|max:1000',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
                'materials' => 'nullable|string',
                'philosophy' => 'nullable|string|max:2000',
                'images_angles' => 'nullable|string',
                'whatsapp_phone' => 'nullable|string|max:20',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('image'), $filename);
                $validated['image'] = $filename;
            }

            // Convert materials and images_angles from string to array
            $validated['materials'] = $validated['materials'] 
                ? array_filter(array_map('trim', explode(',', $validated['materials']))) 
                : [];

            $validated['images_angles'] = $validated['images_angles']
                ? array_filter(array_map('trim', explode(',', $validated['images_angles'])))
                : [];

            Product::create($validated);

            Log::info('Product created', ['name' => $validated['name']]);
            return redirect()->route('admin.dashboard')
                ->with('success', "Produk '{$validated['name']}' berhasil ditambahkan!");
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Failed to create product', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Gagal menambahkan produk')->withInput();
        }
    }

    /**
     * Show form to edit existing product
     * 
     * GET /admin/products/{id}/edit
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $this->checkAuth();

        try {
            $product = Product::findOrFail($id);
            $categories = Category::all();

            return view('admin.products.edit', [
                'product' => $product,
                'categories' => $categories,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Product not found for edit', ['product_id' => $id]);
            return back()->with('error', 'Produk tidak ditemukan');
        } catch (Exception $e) {
            Log::error('Failed to load product edit form', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Gagal membuka form edit');
        }
    }

    /**
     * Update product in database
     * 
     * PUT /admin/products/{id}
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $this->checkAuth();

        try {
            $product = Product::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:products,name,' . $id,
                'description' => 'required|string|max:1000',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
                'materials' => 'nullable|string',
                'philosophy' => 'nullable|string|max:2000',
                'images_angles' => 'nullable|string',
                'whatsapp_phone' => 'nullable|string|max:20',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image && file_exists(public_path('image/' . $product->image))) {
                    unlink(public_path('image/' . $product->image));
                }

                $file = $request->file('image');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('image'), $filename);
                $validated['image'] = $filename;
            }

            // Convert materials and images_angles from string to array
            $validated['materials'] = $validated['materials']
                ? array_filter(array_map('trim', explode(',', $validated['materials'])))
                : [];

            $validated['images_angles'] = $validated['images_angles']
                ? array_filter(array_map('trim', explode(',', $validated['images_angles'])))
                : [];

            $product->update($validated);

            Log::info('Product updated', ['product_id' => $id, 'name' => $validated['name']]);
            return redirect()->route('admin.dashboard')
                ->with('success', "Produk '{$validated['name']}' berhasil diperbarui!");
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Product not found for update', ['product_id' => $id]);
            return back()->with('error', 'Produk tidak ditemukan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Failed to update product', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Gagal memperbarui produk')->withInput();
        }
    }

    /**
     * Delete product from database
     * 
     * DELETE /admin/products/{id}
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->checkAuth();

        try {
            $product = Product::findOrFail($id);
            $productName = $product->name;

            // Delete image file
            if ($product->image && file_exists(public_path('image/' . $product->image))) {
                unlink(public_path('image/' . $product->image));
            }

            $product->delete();

            Log::info('Product deleted', ['product_id' => $id, 'name' => $productName]);
            return redirect()->route('admin.dashboard')
                ->with('success', "Produk '$productName' berhasil dihapus!");
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Product not found for delete', ['product_id' => $id]);
            return back()->with('error', 'Produk tidak ditemukan');
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
     * 
     * GET /admin/products/search
     * 
     * @param Request $request
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
}
