<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;
use Stripe\Checkout\Session as StripeSession;
use Stripe\StripeClient;

class CheckoutService
{
    /**
     * @param  Collection<int, array{product: Product, quantity: int, subtotal: int}>  $cartItems
     */
    public function createOrder(Collection $cartItems, string $email): Order
    {
        $order = Order::create([
            'email' => $email,
            'status' => OrderStatus::Pending,
            'total' => $cartItems->sum('subtotal'),
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item['product']->id,
                'title' => $item['product']->title,
                'unit_price' => $item['product']->price,
                'quantity' => $item['quantity'],
            ]);
        }

        return $order;
    }

    public function startStripeCheckout(Order $order): StripeSession
    {
        $stripe = new StripeClient(config('services.stripe.secret'));

        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'customer_email' => $order->email,
            'line_items' => $order->items->map(fn ($item) => [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => ['name' => $item->title],
                    'unit_amount' => $item->unit_price,
                ],
                'quantity' => $item->quantity,
            ])->all(),
            'success_url' => route('checkout.success').'?order='.$order->id,
            'cancel_url' => route('checkout.cancel').'?order='.$order->id,
        ]);

        $order->update(['stripe_session_id' => $session->id]);

        return $session;
    }
}
