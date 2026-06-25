<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * CategoryApiController
 * 
 * Menampilkan data kategori produk
 * - List semua kategori
 * - Detail kategori
 */
class CategoryApiController extends Controller
{
    /**
     * Dapatkan semua kategori beserta jumlah produk
     * 
     * GET /api/v1/categories
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $categories = Category::withCount('products')
                ->with(['products' => function ($query) {
                    $query->where('stock', '>', 0)->select('id', 'name', 'price', 'category_id');
                }])
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Daftar kategori',
                'data' => [
                    'categories' => $categories->map(fn($category) => [
                        'id' => $category->id,
                        'name' => $category->name,
                        'description' => $category->description ?? null,
                        'products_count' => $category->products_count,
                        'available_products' => count($category->products),
                    ])
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal mengambil kategori', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dapatkan detail kategori dan produk di dalamnya
     * 
     * GET /api/v1/categories/{id}
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = Category::with(['products' => function ($query) {
                $query->where('stock', '>', 0)
                    ->select('id', 'name', 'description', 'price', 'image', 'stock', 'category_id')
                    ->orderBy('created_at', 'desc');
            }])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Detail kategori',
                'data' => [
                    'category' => [
                        'id' => $category->id,
                        'name' => $category->name,
                        'description' => $category->description,
                    ],
                    'products' => $category->products->map(fn($product) => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => (float) $product->price,
                        'image' => $product->image,
                        'stock' => $product->stock,
                        'in_stock' => $product->stock > 0,
                    ])
                ]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error('Gagal mengambil detail kategori', ['category_id' => $id, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
