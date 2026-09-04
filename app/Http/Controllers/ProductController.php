<?php

namespace App\Http\Controllers;

use App\Enums\TambourCategoryType;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(TambourCategoryType $type): View
    {
        $products = Product::query()
            ->whereHas('category', fn ($query) => $query->where('type', $type))
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->get();

        return view('products.index', [
            'products' => $products,
            'type' => $type,
        ]);
    }

    public function show(Product $product): View
    {
        return view('products.show', ['product' => $product]);
    }
}
