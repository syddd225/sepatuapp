<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductApiController;
use App\Http\Controllers\Api\V1\OrderApiController;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\AuthApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API v1 endpoints for mobile app and third-party integrations
| All endpoints return JSON response with consistent format
|
*/

// Health Check Endpoint
Route::get('/health', fn() => response()->json([
    'status' => 'ok',
    'timestamp' => now()->toIso8601String(),
    'version' => '1.0.0'
]));

// API v1 Routes
Route::prefix('v1')->name('api.v1.')->group(function () {
    
    /**
     * =============================================================
     * AUTHENTICATION ROUTES (Public - No Auth Required)
     * =============================================================
     */
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('register', [AuthApiController::class, 'register'])->name('register');
        Route::post('login', [AuthApiController::class, 'login'])->name('login');
        Route::post('logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
    });

    /**
     * =============================================================
     * CATEGORY ROUTES (Public - No Auth Required)
     * =============================================================
     */
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryApiController::class, 'index'])->name('index');
        Route::get('{id}', [CategoryApiController::class, 'show'])->name('show');
    });

    /**
     * =============================================================
     * PRODUCT ROUTES (Public - No Auth Required)
     * =============================================================
     */
    Route::prefix('products')->name('products.')->group(function () {
        // List all products with filtering, sorting, pagination
        Route::get('/', [ProductApiController::class, 'index'])->name('index');
        
        // Get product by ID with full details
        Route::get('{id}', [ProductApiController::class, 'show'])->name('show');
        
        // Search products by name, description
        Route::get('search/query', [ProductApiController::class, 'search'])->name('search');
        
        // Get available products in category
        Route::get('category/{categoryId}', [ProductApiController::class, 'byCategory'])->name('byCategory');
        
        // Get products on sale/promo
        Route::get('promo/available', [ProductApiController::class, 'promo'])->name('promo');
    });

    /**
     * =============================================================
     * ORDER ROUTES (Protected - Auth Required)
     * =============================================================
     */
    Route::prefix('orders')->name('orders.')->middleware('auth:sanctum')->group(function () {
        // Create new order
        Route::post('/', [OrderApiController::class, 'store'])->name('store');
        
        // Get all orders for authenticated user
        Route::get('/', [OrderApiController::class, 'index'])->name('index');
        
        // Get specific order details
        Route::get('{id}', [OrderApiController::class, 'show'])->name('show');
        
        // Update order status (track order)
        Route::get('{id}/track', [OrderApiController::class, 'track'])->name('track');
        
        // Cancel order (if not shipped)
        Route::post('{id}/cancel', [OrderApiController::class, 'cancel'])->name('cancel');
    });

    /**
     * =============================================================
     * USER PROFILE ROUTES (Protected - Auth Required)
     * =============================================================
     */
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthApiController::class, 'profile'])->name('user.profile');
        Route::put('user', [AuthApiController::class, 'updateProfile'])->name('user.update');
    });
});
