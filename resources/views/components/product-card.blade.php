@props(['product'])

<a href="{{ route('products.show', $product) }}" class="group block overflow-hidden rounded-2xl border border-stone-200 bg-white">
    <div class="aspect-square bg-stone-100">
        @if ($product->coverImage())
            <img
                src="{{ $product->coverImage()->getUrl() }}"
                alt="{{ $product->title }}"
                class="h-full w-full object-cover transition group-hover:scale-105"
            >
        @endif
    </div>
    <div class="p-4">
        <p class="font-medium">{{ $product->title }}</p>
        <p class="mt-1 text-sm text-stone-600">{{ number_format($product->price / 100, 2, ',', ' ') }} €</p>
    </div>
</a>
