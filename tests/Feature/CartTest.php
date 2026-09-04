<?php

use App\Models\Product;

test('a product can be added to the cart', function () {
    $product = Product::factory()->create();

    $response = $this->post(route('cart.store', $product));

    $response->assertRedirect();
    $this->get(route('cart.show'))->assertSee($product->title);
});

test('a product can be removed from the cart', function () {
    $product = Product::factory()->create();

    $this->post(route('cart.store', $product));
    $this->delete(route('cart.destroy', $product));

    $this->get(route('cart.show'))->assertDontSee($product->title);
});
