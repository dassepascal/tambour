@extends('layouts.app')

@section('title', $product->title.' — Tambour')

@section('content')
    <section class="mx-auto max-w-6xl px-6 py-16">
        <div class="grid gap-12 lg:grid-cols-2">
            <div>
                <div class="aspect-square overflow-hidden rounded-2xl bg-stone-100">
                    @if ($product->coverImage())
                        <img src="{{ $product->coverImage()->getUrl() }}" alt="{{ $product->title }}" class="h-full w-full object-cover">
                    @endif
                </div>

                @if ($product->getMedia('gallery')->count() > 1)
                    <div class="mt-4 grid grid-cols-4 gap-3">
                        @foreach ($product->getMedia('gallery')->skip(1) as $media)
                            <div class="aspect-square overflow-hidden rounded-lg bg-stone-100">
                                <img src="{{ $media->getUrl() }}" alt="{{ $product->title }}" class="h-full w-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h1 class="text-3xl font-semibold">{{ $product->title }}</h1>
                <p class="mt-2 text-2xl">{{ number_format($product->price / 100, 2, ',', ' ') }} €</p>

                @if ($product->soundFile())
                    <div class="mt-6">
                        <x-audio-player :url="$product->soundFile()->getUrl()" />
                    </div>
                @endif

                <dl class="mt-8 grid grid-cols-2 gap-4 text-sm">
                    @if ($product->diameter_cm)
                        <div>
                            <dt class="text-stone-500">Diamètre</dt>
                            <dd class="mt-1 font-medium">{{ $product->diameter_cm }} cm</dd>
                        </div>
                    @endif
                    @if ($product->skin_type)
                        <div>
                            <dt class="text-stone-500">Peau</dt>
                            <dd class="mt-1 font-medium">{{ $product->skin_type }}</dd>
                        </div>
                    @endif
                    @if ($product->wood_type)
                        <div>
                            <dt class="text-stone-500">Bois</dt>
                            <dd class="mt-1 font-medium">{{ $product->wood_type }}</dd>
                        </div>
                    @endif
                    @if ($product->weight_grams)
                        <div>
                            <dt class="text-stone-500">Poids</dt>
                            <dd class="mt-1 font-medium">{{ $product->weight_grams }} g</dd>
                        </div>
                    @endif
                </dl>

                @if ($product->description)
                    <div class="mt-8 space-y-4 text-stone-700">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                @endif

                <div class="mt-8 space-y-2 rounded-2xl bg-stone-100 p-4 text-sm text-stone-700">
                    <p>🖐️ Fabriqué à la main dans notre atelier</p>
                    <p>📦 Livraison soignée, emballage protecteur</p>
                    <p>🛠️ Garantie 12 mois sur la structure</p>
                </div>

                <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-8 flex gap-4">
                    @csrf
                    <button type="submit" class="flex-1 rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
                        Ajouter au panier
                    </button>
                    <a href="#" class="rounded-full border border-stone-300 px-6 py-3 text-sm">
                        Me conseiller par message
                    </a>
                </form>
            </div>
        </div>
    </section>
@endsection
