@extends('layouts.app')

@section('title', $type->value === 'tambour' ? 'Nos tambours — Tambour' : 'Nos accessoires — Tambour')

@section('content')
    <section class="mx-auto max-w-6xl px-6 py-16">
        <h1 class="text-3xl font-semibold">
            {{ $type->value === 'tambour' ? 'Nos tambours' : 'Nos accessoires' }}
        </h1>

        @if ($products->isEmpty())
            <p class="mt-8 text-stone-600">Aucun produit disponible pour le moment.</p>
        @else
            <div class="mt-10 grid grid-cols-2 gap-6 lg:grid-cols-3">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
