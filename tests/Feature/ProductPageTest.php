<?php

use App\Enums\TambourCategoryType;
use App\Models\Category;
use App\Models\Product;

test('the catalogue lists published products of the given category', function () {
    $tambours = Category::factory()->create(['type' => TambourCategoryType::Tambour]);
    $product = Product::factory()->create(['category_id' => $tambours->id]);

    $response = $this->get(route('products.tambours'));

    $response->assertOk();
    $response->assertSee($product->title);
});

test('the product page displays a product', function () {
    $product = Product::factory()->create();

    $response = $this->get(route('products.show', $product));

    $response->assertOk();
    $response->assertSee($product->title);
});
