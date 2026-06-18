<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;

/**
 * Product Showcase Routes
 * RESTful endpoints for browsing and interacting with products
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
 * Admin Panel Routes
 * CRUD operations untuk product management
 * Simple password-based authentication
 */

Route::prefix('admin')->name('admin.')->group(function () {
    // Login Routes (tidak perlu auth)
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    // Protected Routes (memerlukan auth)
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
        
        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
