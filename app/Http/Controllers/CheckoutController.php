<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService $cart,
        private readonly CheckoutService $checkout,
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $items = $this->cart->items();

        if ($items->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Votre panier est vide.');
        }

        $order = $this->checkout->createOrder($items, $validated['email']);
        $session = $this->checkout->startStripeCheckout($order);

        return redirect()->away($session->url);
    }

    public function success(Request $request): View
    {
        $order = Order::findOrFail($request->query('order'));

        return view('checkout.success', ['order' => $order]);
    }

    public function cancel(Request $request): View
    {
        $order = Order::findOrFail($request->query('order'));

        return view('checkout.cancel', ['order' => $order]);
    }
}
