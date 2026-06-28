<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;

/**
 * Product Showcase Routes
 * RESTful endpoints for browsing and interacting with products
 */

// Membungkus halaman isi web dengan middleware auth agar user yang belum login terproteksi
Route::middleware(['auth'])->group(function () {
    // Home: Display all categories
    Route::get('/', [ProductController::class, 'index'])->name('products.index');

    // Category: Display products by category
    Route::get('/category/{id}', [ProductController::class, 'byCategory'])->name('products.byCategory');

    // Product Detail: Show single product with multiple angles
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
});

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
 * Protected workspace reserved for master artisans and administrators to manage authentication
 */

Route::prefix('admin')->name('admin.')->group(function () {
    // Login Routes Admin (URL: localhost:8000/admin/login)
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    // Protected Routes Admin (memerlukan auth admin)
    Route::middleware('web')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Products CRUD
        Route::get('/products/create', [AdminController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [AdminController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy');
        
        // Search
        Route::get('/search', [AdminController::class, 'search'])->name('search');
        
        // Logout Admin
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->middleware('auth');
Route::post('/checkout/{id}/complete', [CheckoutController::class, 'complete'])->name('checkout.complete')->middleware('auth');