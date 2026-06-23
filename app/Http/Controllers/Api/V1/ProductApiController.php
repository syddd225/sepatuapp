<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductSearchRequest;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * ProductApiController
 * 
 * Menampilkan produk dengan fitur:
 * - List produk dengan filtering & pagination
 * - Detail produk
 * - Search produk
 * - Filter berdasarkan kategori
 * - Produk promo
 */
class ProductApiController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Dapatkan semua produk dengan filtering & pagination
     * 
     * GET /api/v1/products
     * Query params:
     * - page: halaman (default: 1)
     * - per_page: jumlah per halaman (default: 10, max: 100)
     * - sort_by: field untuk sorting (name, price, created_at)
     * - sort_order: asc atau desc
     * - min_price: harga minimum
     * - max_price: harga maksimum
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'page' => 'sometimes|integer|min:1',
                'per_page' => 'sometimes|integer|min:1|max:100',
                'sort_by' => 'sometimes|in:name,price,created_at',
                'sort_order' => 'sometimes|in:asc,desc',
                'min_price' => 'sometimes|numeric|min:0',
                'max_price' => 'sometimes|numeric|min:0',
            ]);

            $products = $this->productService->getFilteredProducts($validated);

            return response()->json([
                'success' => true,
                'message' => 'Daftar produk',
                'data' => $products
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal mengambil produk', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil daftar produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dapatkan detail produk lengkap
     * 
     * GET /api/v1/products/{id}
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $product = Product::with('category')->findOrFail($id);

            $productData = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => (float) $product->price,
                'stock' => $product->stock,
                'in_stock' => $product->isInStock(),
                'image' => $product->image,
                'images_angles' => $product->images_angles ?? [],
                'materials' => $product->materials ?? [],
                'philosophy' => $product->philosophy ?? '',
                'category' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                ],
                'whatsapp_phone' => $product->whatsapp_phone,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];

            return response()->json([
                'success' => true,
                'message' => 'Detail produk',
                'data' => [
                    'product' => $productData
                ]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error('Gagal mengambil detail produk', ['product_id' => $id, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search produk berdasarkan nama atau deskripsi
     * 
     * GET /api/v1/products/search/query?q=nama_produk
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'q' => 'required|string|min:2|max:100',
                'page' => 'sometimes|integer|min:1',
                'per_page' => 'sometimes|integer|min:1|max:50',
            ]);

            $products = $this->productService->searchProducts(
                $validated['q'],
                $validated['page'] ?? 1,
                $validated['per_page'] ?? 10
            );

            return response()->json([
                'success' => true,
                'message' => 'Hasil pencarian produk',
                'data' => $products
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Gagal search produk', ['query' => $validated['q'] ?? '', 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dapatkan produk berdasarkan kategori
     * 
     * GET /api/v1/products/category/{categoryId}
     * 
     * @param int $categoryId
     * @param Request $request
     * @return JsonResponse
     */
    public function byCategory(int $categoryId, Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'page' => 'sometimes|integer|min:1',
                'per_page' => 'sometimes|integer|min:1|max:50',
                'sort_by' => 'sometimes|in:name,price,created_at',
                'sort_order' => 'sometimes|in:asc,desc',
            ]);

            $products = $this->productService->getProductsByCategory(
                $categoryId,
                $validated
            );

            return response()->json([
                'success' => true,
                'message' => 'Produk berdasarkan kategori',
                'data' => $products
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal mengambil produk kategori', ['category_id' => $categoryId, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil produk kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dapatkan produk promo/special
     * 
     * GET /api/v1/products/promo/available
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function promo(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'page' => 'sometimes|integer|min:1',
                'per_page' => 'sometimes|integer|min:1|max:50',
            ]);

            // Ambil produk dengan stok rendah atau harga spesial
            $products = Product::where('stock', '>', 0)
                ->where('stock', '<', 10)  // Stok terbatas
                ->orderBy('stock', 'asc')
                ->paginate($validated['per_page'] ?? 10);

            return response()->json([
                'success' => true,
                'message' => 'Produk promo (stok terbatas)',
                'data' => [
                    'products' => $products->items(),
                    'pagination' => [
                        'total' => $products->total(),
                        'count' => $products->count(),
                        'per_page' => $products->perPage(),
                        'current_page' => $products->currentPage(),
                        'last_page' => $products->lastPage(),
                    ]
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal mengambil produk promo', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil produk promo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
