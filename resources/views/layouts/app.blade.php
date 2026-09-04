<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name'))</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 text-stone-900 antialiased">
        <header class="border-b border-stone-200">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <a href="{{ route('home') }}" class="text-lg font-semibold tracking-wide">Tambour</a>

                <nav class="hidden items-center gap-6 text-sm sm:flex">
                    <a href="{{ route('home') }}" class="hover:text-stone-600">Accueil</a>
                    <a href="{{ route('products.tambours') }}" class="hover:text-stone-600">Tambours</a>
                    <a href="{{ route('products.accessoires') }}" class="hover:text-stone-600">Accessoires</a>
                    <a href="{{ route('guide') }}" class="hover:text-stone-600">Guide</a>
                    <a href="{{ route('about') }}" class="hover:text-stone-600">À propos</a>
                </nav>

                <a href="{{ route('cart.show') }}" class="rounded-full border border-stone-300 px-4 py-2 text-sm hover:border-stone-400">
                    Panier
                </a>
            </div>
        </header>

        @if (session('success'))
            <div class="mx-auto mt-4 max-w-6xl px-6">
                <div class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mx-auto mt-4 max-w-6xl px-6">
                <div class="rounded-lg bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <main>
            @yield('content')
        </main>

        <footer class="mt-20 border-t border-stone-200 bg-stone-100">
            <div class="mx-auto grid max-w-6xl gap-8 px-6 py-12 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <p class="text-sm font-semibold">À propos</p>
                    <p class="mt-3 text-sm text-stone-600">
                        Tambour façonne des tambours chamaniques artisanaux, dans le respect des matières et des
                        traditions.
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold">Navigation</p>
                    <ul class="mt-3 space-y-2 text-sm text-stone-600">
                        <li><a href="{{ route('products.tambours') }}" class="hover:text-stone-900">Tambours</a></li>
                        <li><a href="{{ route('products.accessoires') }}" class="hover:text-stone-900">Accessoires</a></li>
                        <li><a href="{{ route('guide') }}" class="hover:text-stone-900">Guide</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-stone-900">À propos</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold">Aide</p>
                    <ul class="mt-3 space-y-2 text-sm text-stone-600">
                        <li>Livraison &amp; retours</li>
                        <li>Paiement sécurisé</li>
                        <li>FAQ</li>
                        <li>Nous contacter</li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold">Newsletter</p>
                    <p class="mt-3 text-sm text-stone-600">Recevez nos nouveaux tambours et nos conseils de pratique.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
