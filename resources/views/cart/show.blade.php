@extends('layouts.app')

@section('title', 'Votre panier — Tambour')

@section('content')
    <section class="mx-auto max-w-4xl px-6 py-16">
        <h1 class="text-3xl font-semibold">Votre panier</h1>

        @if ($items->isEmpty())
            <p class="mt-8 text-stone-600">Votre panier est vide.</p>
            <a href="{{ route('products.tambours') }}" class="mt-6 inline-block rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
                Découvrir nos tambours
            </a>
        @else
            <div class="mt-10 divide-y divide-stone-200 border-y border-stone-200">
                @foreach ($items as $item)
                    <div class="flex items-center justify-between gap-4 py-4">
                        <div>
                            <p class="font-medium">{{ $item['product']->title }}</p>
                            <p class="text-sm text-stone-600">{{ number_format($item['product']->price / 100, 2, ',', ' ') }} €</p>
                        </div>

                        <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                                class="w-16 rounded-lg border border-stone-300 px-2 py-1 text-sm"
                            >
                            <button type="submit" class="text-sm text-stone-600 underline">Mettre à jour</button>
                        </form>

                        <p class="w-24 text-right font-medium">{{ number_format($item['subtotal'] / 100, 2, ',', ' ') }} €</p>

                        <form action="{{ route('cart.destroy', $item['product']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 underline">Retirer</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex items-center justify-between">
                <p class="text-lg font-semibold">Total</p>
                <p class="text-lg font-semibold">{{ number_format($total / 100, 2, ',', ' ') }} €</p>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST" class="mt-8 space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm text-stone-600">Votre email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm"
                    >
                </div>
                <button type="submit" class="w-full rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
                    Passer commande
                </button>
            </form>
        @endif
    </section>
@endsection
