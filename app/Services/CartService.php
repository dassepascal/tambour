<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const SESSION_KEY = 'cart';

    public function add(Product $product, int $quantity = 1): void
    {
        $cart = $this->raw();
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $quantity;

        Session::put(self::SESSION_KEY, $cart);
    }

    public function update(Product $product, int $quantity): void
    {
        $cart = $this->raw();

        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = $quantity;
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    public function remove(Product $product): void
    {
        $cart = $this->raw();
        unset($cart[$product->id]);

        Session::put(self::SESSION_KEY, $cart);
    }

    /**
     * @return Collection<int, array{product: Product, quantity: int, subtotal: int}>
     */
    public function items(): Collection
    {
        $cart = $this->raw();

        if ($cart === []) {
            return collect();
        }

        return Product::query()
            ->whereIn('id', array_keys($cart))
            ->get()
            ->map(fn (Product $product) => [
                'product' => $product,
                'quantity' => $cart[$product->id],
                'subtotal' => $product->price * $cart[$product->id],
            ]);
    }

    public function total(): int
    {
        return $this->items()->sum('subtotal');
    }

    /**
     * @return array<int, int>
     */
    private function raw(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }
}
