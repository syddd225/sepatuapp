<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Helpers\WhatsAppHelper;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * ProductController
 * 
 * RESTful controller for managing product showcase and browsing.
 * Follows Laravel conventions and MVC patterns.
 */
class ProductController extends Controller
{
    /**
     * Display the product catalog home page (category list)
     * 
     * GET /
     * 
     * @return View|\Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::with('products')
                ->get();

            return view('products.menu', [
                'categories' => $categories,
            ]);
        } catch (Exception $e) {
            Log::error('Failed to load product categories', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return view('products.menu', [
                'categories' => collect(),
                'error' => 'Unable to load product categories'
            ]);
        }
    }

    /**
     * Display products filtered by category
     * 
     * GET /category/{id}
     * 
     * @param int $id Category ID
     * @return View|\Illuminate\Http\Response
     */
    public function byCategory(int $id)
    {
        try {
            $category = Category::findOrFail($id);
            
            $products = Product::where('category_id', $id)
                ->available()
                ->orderBy('created_at', 'desc')
                ->get();

            return view('products.product', [
                'category' => $category,
                'products' => $products,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Category not found', ['category_id' => $id]);

            return response()->view('errors.404', [
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error('Failed to load products by category', [
                'category_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->view('products.product', [
                'category' => null,
                'products' => collect(),
                'error' => 'Gagal memuat produk'
            ], 500);
        }
    }

    /**
     * Display product details with multiple angles, materials, and philosophy
     * 
     * GET /product/{id}
     * 
     * @param int $id Product ID
     * @return View|\Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $product = Product::with('category')->findOrFail($id);

            // Prepare data for view
            $data = [
                'product' => $product,
                'images' => $this->prepareProductImages($product),
                'materials' => $product->materials ?? [],
                'philosophy' => $product->philosophy ?? '',
                'whatsappPhone' => $product->whatsapp_phone ?? WhatsAppHelper::getBusinessPhoneNumber(),
                'inStock' => $product->isInStock(),
            ];

            return view('products.show', $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Product not found', ['product_id' => $id]);

            return response()->view('errors.404', [
                'message' => 'Produk tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error('Failed to load product details', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->view('errors.500', [
                'message' => 'Gagal memuat detail produk'
            ], 500);
        }
    }

    /**
     * Generate WhatsApp inquiry link (AJAX endpoint)
     * 
     * POST /product/{id}/whatsapp
     * 
     * @param Request $request
     * @param int $id Product ID
     * @return JsonResponse
     */
    public function generateWhatsAppLink(Request $request, int $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            // Validate request
            $validated = $request->validate([
                'size' => 'nullable|string|max:10',
                'color' => 'nullable|string|max:50',
            ]);

            // Get phone number
            $phoneNumber = $product->whatsapp_phone ?? WhatsAppHelper::getBusinessPhoneNumber();

            if (!$phoneNumber) {
                return response()->json([
                    'success' => false,
                    'message' => 'WhatsApp number not configured'
                ], 500);
            }

            // Generate WhatsApp link
            $whatsappLink = WhatsAppHelper::generateProductInquiryLink(
                $phoneNumber,
                $product->name,
                $product->price,
                [
                    'size' => $validated['size'] ?? null,
                    'color' => $validated['color'] ?? null,
                ]
            );

            return response()->json([
                'success' => true,
                'whatsapp_link' => $whatsappLink,
                'product_name' => $product->name,
                'price' => $product->price,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('WhatsApp link generation failed', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat link WhatsApp'
            ], 500);
        }
    }

    /**
     * Prepare product images for display (handles multiple angles)
     * 
     * @param Product $product
     * @return array
     */
    private function prepareProductImages(Product $product): array
    {
        $images = [];

        // Primary image
        if ($product->image) {
            $images['primary'] = [
                'url' => "/image/{$product->image}",
                'alt' => "{$product->name} - Tampilan Utama"
            ];
        }

        // Additional angle images (if stored in images_angles JSON)
        if ($product->images_angles && is_array($product->images_angles)) {
            foreach ($product->images_angles as $index => $angleImage) {
                $angleNumber = $index + 1;
                $images["angle_" . $angleNumber] = [
                    'url' => "/image/{$angleImage}",
                    'alt' => "{$product->name} - Sudut {$angleNumber}"
                ];
            }
        }

        return $images;
    }
}
