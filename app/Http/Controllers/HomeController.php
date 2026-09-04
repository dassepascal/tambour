<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('home', ['featuredProducts' => $featuredProducts]);
    }
}
