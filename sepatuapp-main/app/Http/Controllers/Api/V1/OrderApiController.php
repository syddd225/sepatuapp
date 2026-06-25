<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * OrderApiController
 * 
 * Mengelola order/pesanan
 * - Buat order baru
 * - List order user
 * - Detail order
 * - Track order
 * - Cancel order
 */
class OrderApiController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Dapatkan semua order pengguna yang login
     * 
     * GET /api/v1/orders
     * Query params:
     * - page: halaman (default: 1)
     * - per_page: jumlah per halaman (default: 10)
     * - status: filter berdasarkan status (pending, confirmed, shipped, delivered, cancelled)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'page' => 'sometimes|integer|min:1',
                'per_page' => 'sometimes|integer|min:1|max:50',
                'status' => 'sometimes|in:pending,confirmed,shipped,delivered,cancelled',
            ]);

            $query = $request->user()->orders()->with('product');

            if (isset($validated['status'])) {
                $query->where('status', $validated['status']);
            }

            $orders = $query->orderBy('created_at', 'desc')
                ->paginate($validated['per_page'] ?? 10);

            return response()->json([
                'success' => true,
                'message' => 'Daftar order Anda',
                'data' => [
                    'orders' => $orders->items(),
                    'pagination' => [
                        'total' => $orders->total(),
                        'count' => $orders->count(),
                        'per_page' => $orders->perPage(),
                        'current_page' => $orders->currentPage(),
                        'last_page' => $orders->lastPage(),
                    ]
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal mengambil order', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil daftar order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buat order baru
     * 
     * POST /api/v1/orders
     * Body:
     * {
     *   "product_id": 1,
     *   "qty": 2,
     *   "ukuran": "42",
     *   "warna": "Hitam",
     *   "shipping_tier": "reguler",
     *   "payment_method": "transfer",
     *   "use_voucher": false
     * }
     * 
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = $request->user()->id;

            $order = $this->orderService->createOrder($validated);

            Log::info('Order berhasil dibuat', ['order_id' => $order->id, 'user_id' => $request->user()->id]);

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat',
                'data' => [
                    'order' => $order
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Gagal membuat order', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat order: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dapatkan detail order
     * 
     * GET /api/v1/orders/{id}
     * 
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function show(int $id, Request $request): JsonResponse
    {
        try {
            $order = $request->user()->orders()
                ->with('product')
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Detail order',
                'data' => [
                    'order' => $order
                ]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error('Gagal mengambil detail order', ['order_id' => $id, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Track status order
     * 
     * GET /api/v1/orders/{id}/track
     * 
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function track(int $id, Request $request): JsonResponse
    {
        try {
            $order = $request->user()->orders()->findOrFail($id);

            $tracking = [
                'transaction_id' => $order->transaction_id,
                'status' => $order->status ?? 'pending',
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'product' => [
                    'name' => $order->product->name,
                    'qty' => $order->qty,
                ],
                'timeline' => [
                    'order_placed' => $order->created_at,
                    'estimated_delivery' => $order->created_at->addDays(5),
                ]
            ];

            return response()->json([
                'success' => true,
                'message' => 'Status order',
                'data' => [
                    'tracking' => $tracking
                ]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error('Gagal track order', ['order_id' => $id, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal melacak order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Batalkan order (hanya jika belum dikirim)
     * 
     * POST /api/v1/orders/{id}/cancel
     * 
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function cancel(int $id, Request $request): JsonResponse
    {
        try {
            $order = $request->user()->orders()->findOrFail($id);

            // Hanya bisa dibatalkan jika status pending
            if ($order->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Order tidak bisa dibatalkan (status: ' . $order->status . ')'
                ], 400);
            }

            // Return stok produk
            $order->product->increment('stock', $order->qty);

            // Update status order
            $order->update(['status' => 'cancelled']);

            Log::info('Order berhasil dibatalkan', ['order_id' => $id, 'user_id' => $request->user()->id]);

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibatalkan dan stok dikembalikan'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error('Gagal membatalkan order', ['order_id' => $id, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal membatalkan order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
