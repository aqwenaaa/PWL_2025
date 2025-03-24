<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category($category)
    {
        // Daftar kategori produk
        $categories = [
            'food-beverage' => 'Makanan & Minuman',
            'beauty-health' => 'Kesehatan & Kecantikan',
            'home-care' => 'Perawatan Rumah',
            'baby-kid' => 'Bayi & Anak',
            'fashion' => 'Fashion',
            'electronics' => 'Elektronika',
            'sports' => 'Olahraga'
        ];

        // Kirim kategori dan daftar ke view
        return view('products.category', [
            'category' => $category,
            'categories' => $categories
        ]);
    }
}
