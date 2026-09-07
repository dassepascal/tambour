@extends('layouts.app')

@section('title', 'Tambour — Tambours chamaniques faits main')

@section('content')
    <section class="w-full">
        <img src="{{ asset('images/hero-tambour.jpg') }}" alt="Musicien jouant du tambour, entouré de plumes colorées"
             class="h-[45vh] w-full object-cover sm:h-[55vh]">
    </section>

    <section class="mx-auto max-w-6xl px-6 pt-16 pb-20 text-center">
        <h1 class="mx-auto max-w-3xl text-4xl font-semibold tracking-tight sm:text-5xl">
            Des tambours chamaniques façonnés à la main, pour retrouver votre rythme intérieur
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-lg text-stone-600">
            Chaque tambour est fabriqué pièce par pièce dans notre atelier, avec des matières naturelles choisies
            avec soin — pour vous accompagner dans votre pratique, vos cercles ou votre quête de calme.
        </p>
        <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="{{ route('products.tambours') }}" class="rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
                Découvrir nos tambours
            </a>
            <a href="#audio" class="rounded-full border border-stone-300 px-6 py-3 text-sm">
                Écouter leur son
            </a>
        </div>
    </section>

    <section class="border-y border-stone-200 bg-stone-100">
        <div class="mx-auto grid max-w-6xl gap-6 px-6 py-8 text-center text-sm text-stone-700 sm:grid-cols-4">
            <p>🖐️ Fait main dans notre atelier</p>
            <p>🌿 Matières naturelles sélectionnées</p>
            <p>📦 Emballage protecteur soigné</p>
            <p>🔊 Chaque tambour a son propre son</p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-20 text-center">
        <h2 class="text-2xl font-semibold sm:text-3xl">Chaque tambour a sa voix. Trouvez celle qui vous parle.</h2>
        <p class="mx-auto mt-4 max-w-2xl text-stone-600">
            Diamètre, type de peau, tonalité, intention... Un tambour chamanique ne se choisit pas comme un simple
            objet. Répondez à quelques questions et laissez-nous vous guider vers celui qui vous correspond.
        </p>
        <a href="#" class="mt-6 inline-block rounded-full border border-stone-300 px-6 py-3 text-sm">
            Faire le quiz « Trouver mon tambour »
        </a>
    </section>

    @if ($featuredProducts->isNotEmpty())
        <section class="mx-auto max-w-6xl px-6 py-20">
            <div class="text-center">
                <h2 class="text-2xl font-semibold sm:text-3xl">Nos tambours du moment</h2>
                <p class="mt-2 text-stone-600">Une sélection de pièces uniques, chacune façonnée à la main</p>
            </div>

            <div class="mt-10 grid grid-cols-2 gap-6 lg:grid-cols-3">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('products.tambours') }}" class="rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
                    Voir tous les tambours
                </a>
            </div>
        </section>
    @endif

    <section class="border-y border-stone-200 bg-stone-100">
        <div class="mx-auto max-w-3xl px-6 py-20 text-center">
            <h2 class="text-2xl font-semibold sm:text-3xl">Plus qu'un objet, une intention</h2>
            <p class="mt-4 text-stone-600">
                Derrière chaque tambour, il y a un geste, un choix de matière, une histoire. Nous travaillons le bois
                et la peau avec respect, dans une démarche éthique et artisanale, en lien avec les traditions
                chamaniques que nous honorons sans jamais les dénaturer.
            </p>
            <a href="{{ route('about') }}" class="mt-6 inline-block rounded-full border border-stone-300 px-6 py-3 text-sm">
                Découvrir notre atelier
            </a>
        </div>
    </section>

    <section id="audio" class="mx-auto max-w-3xl px-6 py-20 text-center">
        <h2 class="text-2xl font-semibold sm:text-3xl">Fermez les yeux. Écoutez.</h2>
        <p class="mt-4 text-stone-600">
            Le son est au cœur de chaque tambour. Avant de choisir, laissez-vous porter par les vibrations de nos
            créations — chaque peau, chaque tension, chaque diamètre donne une voix différente.
        </p>
        <a href="{{ route('products.tambours') }}" class="mt-6 inline-block rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
            Écouter notre galerie sonore
        </a>
    </section>

    <section class="border-y border-stone-200 bg-stone-100">
        <div class="mx-auto max-w-3xl px-6 py-20 text-center">
            <h2 class="text-2xl font-semibold sm:text-3xl">Envie d'un tambour unique, à votre image ?</h2>
            <p class="mt-4 text-stone-600">
                Diamètre, type de peau, motifs, intention personnelle... Commandez un tambour sur-mesure, pensé et
                fabriqué spécialement pour vous.
            </p>
            <a href="#" class="mt-6 inline-block rounded-full border border-stone-300 px-6 py-3 text-sm">
                Créer mon tambour sur-mesure
            </a>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-20">
        <h2 class="text-center text-2xl font-semibold sm:text-3xl">Apprendre, comprendre, entretenir</h2>

        <div class="mt-10 grid gap-6 sm:grid-cols-3">
            <div class="rounded-2xl border border-stone-200 bg-white p-6">
                <p class="font-medium">Comment choisir son premier tambour chamanique ?</p>
            </div>
            <div class="rounded-2xl border border-stone-200 bg-white p-6">
                <p class="font-medium">Peau de cheval, cerf ou chèvre : quelles différences ?</p>
            </div>
            <div class="rounded-2xl border border-stone-200 bg-white p-6">
                <p class="font-medium">Entretenir son tambour : humidité, stockage, nettoyage</p>
            </div>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('guide') }}" class="rounded-full border border-stone-300 px-6 py-3 text-sm">
                Voir tous les articles
            </a>
        </div>
    </section>

    <section class="border-y border-stone-200 bg-stone-100">
        <div class="mx-auto max-w-3xl px-6 py-20 text-center">
            <h2 class="text-2xl font-semibold sm:text-3xl">Ils ont trouvé leur tambour</h2>
            <blockquote class="mt-6 text-stone-600 italic">
                « Dès que j'ai posé les mains sur ce tambour, j'ai su que c'était le bon. Le son est chaud, profond,
                exactement ce que je cherchais pour mes cercles. »
            </blockquote>
            <p class="mt-3 text-sm text-stone-500">— Camille, Lyon</p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-20 text-center">
        <h2 class="text-2xl font-semibold sm:text-3xl">Une commande en toute confiance</h2>
        <div class="mx-auto mt-8 grid max-w-2xl gap-4 text-sm text-stone-700 sm:grid-cols-2">
            <p>🔒 Paiement 100% sécurisé</p>
            <p>🚚 Livraison soignée et suivie</p>
            <p>↩️ Retours possibles sous 14 jours</p>
            <p>🛠️ Garantie 12 mois sur la structure</p>
        </div>
        <a href="{{ route('products.tambours') }}" class="mt-8 inline-block rounded-full bg-stone-900 px-6 py-3 text-sm text-white">
            Découvrir la boutique
        </a>
    </section>
@endsection
