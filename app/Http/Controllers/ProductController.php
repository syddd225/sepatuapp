<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // halaman utama = tampil kategori
    public function index()
    {
        $categories = Category::all();
        return view('products.menu', compact('categories'));
    }

    // tampil produk berdasarkan kategori
    public function byCategory($id)
    {
        $products = Product::where('category_id', $id)->get();
        $category = Category::findOrFail($id);

        return view('products.product', compact('products', 'category'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
