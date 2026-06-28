<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;

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
    return view('auth.login');
})->name('login');

// 2. Memproses Data Login Pembeli saat tombol "Masuk Sekarang" diklik
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// 3. Memproses Pendaftaran Pembeli Baru saat tombol "Buat Akun & Join" diklik
Route::post('/register', [LoginController::class, 'register'])->name('register.submit');

// 4. Memproses Keluar Sistem (Logout) Pembeli
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/**
 * =============================================================
 * BACKEND ADMINISTRATIVE PANEL ROUTES (ADMIN ONLY)
 * =============================================================
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    Route::middleware('web')->group(function () {
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
 * yang dikunci ketat menggunakan middleware auth.
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/{id}', [CheckoutController::class, 'index']);
    Route::post('/checkout/{id}/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
});