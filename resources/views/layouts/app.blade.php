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
        <header class="border-b border-stone-200" x-data="{ mobileMenuOpen: false }">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <a href="{{ route('home') }}" class="text-lg font-semibold tracking-wide">Tambour</a>

                <nav class="hidden items-center gap-6 text-sm sm:flex">
                    <a href="{{ route('home') }}" class="hover:text-stone-600">Accueil</a>
                    <a href="{{ route('products.tambours') }}" class="hover:text-stone-600">Tambours</a>
                    <a href="{{ route('products.accessoires') }}" class="hover:text-stone-600">Accessoires</a>
                    <a href="{{ route('guide') }}" class="hover:text-stone-600">Guide</a>
                    <a href="{{ route('about') }}" class="hover:text-stone-600">À propos</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="{{ route('filament.admin.auth.login') }}" class="hidden text-sm hover:text-stone-600 sm:inline">
                        Connexion
                    </a>

                    <a href="{{ route('cart.show') }}" class="rounded-full border border-stone-300 px-4 py-2 text-sm hover:border-stone-400">
                        Panier
                    </a>

                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="-mr-2 flex h-9 w-9 items-center justify-center sm:hidden" aria-label="Ouvrir le menu">
                        <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" style="display: none;"><path d="M6 6l12 12M18 6L6 18"/></svg>
                    </button>
                </div>
            </div>

            <nav x-show="mobileMenuOpen" x-transition @click.outside="mobileMenuOpen = false" class="border-t border-stone-200 sm:hidden" style="display: none;">
                <div class="flex flex-col px-6 py-4 text-sm">
                    <a href="{{ route('home') }}" class="py-2 hover:text-stone-600">Accueil</a>
                    <a href="{{ route('products.tambours') }}" class="py-2 hover:text-stone-600">Tambours</a>
                    <a href="{{ route('products.accessoires') }}" class="py-2 hover:text-stone-600">Accessoires</a>
                    <a href="{{ route('guide') }}" class="py-2 hover:text-stone-600">Guide</a>
                    <a href="{{ route('about') }}" class="py-2 hover:text-stone-600">À propos</a>
                    <a href="{{ route('filament.admin.auth.login') }}" class="py-2 hover:text-stone-600">Connexion</a>
                </div>
            </nav>
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

        @stack('scripts')
    </body>
</html>
