@extends('layouts.app')

@section('title', 'Commande confirmée — Tambour')

@section('content')
    <section class="mx-auto max-w-2xl px-6 py-20 text-center">
        <h1 class="text-3xl font-semibold">Merci pour votre commande !</h1>
        <p class="mt-4 text-stone-600">
            Votre commande n°{{ $order->id }} a bien été enregistrée. Un email de confirmation vous sera envoyé à
            {{ $order->email }}.
        </p>
        <a href="{{ route('home') }}" class="mt-8 inline-block rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
            Retour à l'accueil
        </a>
    </section>
@endsection
