<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;

/**
 * Product Showcase Routes
 * RESTful endpoints for browsing and interacting with products
 * KODE DIUBAH: Sekarang bebas diakses oleh guest (pengunjung yang belum login)
 */

// Home: Display all categories
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Category: Display products by category
Route::get('/category/{id}', [ProductController::class, 'byCategory'])->name('products.byCategory');

// Product Detail: Show single product with multiple angles
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// WhatsApp Inquiry: Generate pre-filled WhatsApp link (AJAX)
Route::post('/product/{id}/whatsapp', [ProductController::class, 'generateWhatsAppLink'])->name('products.whatsapp');

// Optional: Database check endpoint (for debugging only - remove in production)
Route::get('/cek-db', function () {
    return \Illuminate\Support\Facades\DB::table('products')->get();
});


/**
 * =============================================================
 * USER / CUSTOMER AUTHENTICATION ROUTES
 * =============================================================
 */

// 1. Menampilkan halaman Form Login & Register Pembeli
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('products.index');
    }
    return view('auth.login'); 
})->name('login');

// 2. Memproses data Login Pembeli
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// 3. Memproses data Register Pembeli Baru
Route::post('/register', [LoginController::class, 'register'])->name('register.submit');

// 4. Memproses Logout Pembeli
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/**
 * =============================================================
 * ADMIN PANEL AUTHENTICATION & MANAGEMENT ROUTES
 * =============================================================
 */
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    // Protected Admin Routes (Simple Session-Based)
    Route::middleware(['web'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/products/create', [AdminController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [AdminController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy');
        Route::get('/search', [AdminController::class, 'search'])->name('search');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

/**
 * KODE DIUBAH: Hanya halaman Checkout / Transaksi Belanja 
 * yang dikunci ketat menggunakan middleware auth Ramshoes.
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/{id}', [CheckoutController::class, 'index']);
    Route::post('/checkout/{id}/complete',[CheckoutController::class, 'complete' ])->name('checkout.complete');
    Route::get('/akun', [ProfileController::class, 'index'])->name('akun');
    Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
});

// Di dalam routes/web.php -> Route::prefix('admin')->...
Route::middleware('web')->group(function () {
    // ... rute dashboard dan crud produk yang sudah ada ...

    // KODE DISESUAIKAN: Mengubah rute menjadi tunggal '/admin/order' sesuai file order.blade.php Anda
    Route::get('/admin/order', [AdminController::class, 'orderLog'])->name('admin.orders.index');
    Route::post('/admin/order/{id}/update-status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
});