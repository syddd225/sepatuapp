<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Ambil produk dengan filter
     */
    public function getFilteredProducts(array $filters = [])
    {
        $query = Product::query()->with('category');

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';

        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate(
            $filters['per_page'] ?? 10
        );
    }

    /**
     * Cari produk
     */
    public function searchProducts(
        string $keyword,
        int $page = 1,
        int $perPage = 10
    ) {
        return Product::with('category')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->paginate($perPage);
    }

    /**
     * Produk berdasarkan kategori
     */
    public function getProductsByCategory(
        int $categoryId,
        array $filters = []
    ) {
        $query = Product::with('category')
            ->where('category_id', $categoryId);

        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';

        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate(
            $filters['per_page'] ?? 10
        );
    }
}