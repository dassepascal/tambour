<?php

use App\Models\Product;
use App\Services\CartService;

test('it adds products and computes the total', function () {
    $product = Product::factory()->create(['price' => 20000]);
    $cart = new CartService;

    $cart->add($product, 2);

    expect($cart->items())->toHaveCount(1);
    expect($cart->total())->toBe(40000);
});

test('it removes a product', function () {
    $product = Product::factory()->create();
    $cart = new CartService;

    $cart->add($product);
    $cart->remove($product);

    expect($cart->items())->toBeEmpty();
});

test('updating the quantity to zero removes the product', function () {
    $product = Product::factory()->create();
    $cart = new CartService;

    $cart->add($product);
    $cart->update($product, 0);

    expect($cart->items())->toBeEmpty();
});
