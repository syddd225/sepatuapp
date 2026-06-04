<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// halaman utama (menu kategori)
Route::get('/', [ProductController::class, 'index']);

Route::get('/category/{id}', [ProductController::class, 'byCategory']);

// halaman detail produk
Route::get('/product/{id}', [ProductController::class, 'show']);

// OPTIONAL (buat cek database)
Route::get('/cek-db', function () {
    return \Illuminate\Support\Facades\DB::table('products')->get();
});
