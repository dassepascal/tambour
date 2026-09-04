@extends('layouts.app')

@section('title', 'Commande annulée — Tambour')

@section('content')
    <section class="mx-auto max-w-2xl px-6 py-20 text-center">
        <h1 class="text-3xl font-semibold">Commande annulée</h1>
        <p class="mt-4 text-stone-600">
            Le paiement de la commande n°{{ $order->id }} a été annulé. Votre panier reste disponible si vous
            souhaitez réessayer.
        </p>
        <a href="{{ route('cart.show') }}" class="mt-8 inline-block rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
            Retour au panier
        </a>
    </section>
@endsection
