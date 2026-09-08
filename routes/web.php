<?php

use App\Enums\TambourCategoryType;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tambours', [ProductController::class, 'index'])->name('products.tambours')->defaults('type', TambourCategoryType::Tambour);
Route::get('/accessoires', [ProductController::class, 'index'])->name('products.accessoires')->defaults('type', TambourCategoryType::Accessoire);
Route::get('/produits/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/panier', [CartController::class, 'show'])->name('cart.show');
Route::post('/panier/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/panier/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/panier/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::post('/commande', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/commande/succes', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/commande/annulee', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/guide', 'pages.guide')->name('guide');
