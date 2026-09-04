# CLAUDE.md

Ce fichier guide Claude Code (claude.ai/code) dans ce dépôt.

## État du projet

Site e-commerce de tambours chamaniques bâti sur Laravel 13. Structure de base en place :
catalogue de produits (tambours/accessoires), fiche produit avec galerie et lecteur audio,
panier en session, amorce de checkout Stripe, panel d'administration Filament (`/admin`)
réservé aux utilisateurs `is_admin`. Ce document décrit l'état **réel** du code —
à mettre à jour au fur et à mesure que le projet évolue, plutôt que de documenter une
architecture cible non encore construite.

## Commandes essentielles

```bash
# Installation
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate

# Développement (serveur + queue + logs + Vite en parallèle, via composer.json "dev")
composer dev

# Tests (Pest)
php artisan test
php artisan test --filter=NomDuTest
./vendor/bin/pest

# Migrations
php artisan migrate
php artisan migrate:fresh --seed

# Linter PHP (Laravel Pint)
./vendor/bin/pint

# Assets front-end
npm run dev    # développement
npm run build  # production
```

## Stack technique réelle

| Technologie | Version | Usage |
|---|---|---|
| PHP | ^8.3 | Runtime |
| Laravel | ^13.17 (installé : 13.30.1) | Backend |
| Tailwind CSS | ^4.0.0 (plugin Vite) | Styling |
| Vite | ^8.0.0 | Bundler front-end |
| Pest | ^4.7 | Tests |
| Laravel Pint | ^1.27 | Linting/formatting |
| Alpine.js | (npm) | Interactivité front (lecteur audio, etc.) |
| Spatie Media Library | ^11.23 | Galeries photo/audio des produits |
| Stripe PHP | ^21.3 | Paiement (Stripe Checkout) |
| Filament | ^4.0 | Panel d'administration (`/admin`) |
| MySQL | — | Base de données de dev (`DB_CONNECTION=mysql`, base `laraveltambour`) |
| Laravel Tinker | ^3.0 | REPL |
| laravel-lang/lang | ^15.34 (dev) | Génère `lang/fr/*` (validation, auth, pagination) |

Locale de l'application : `APP_LOCALE=fr` (`.env`). Le panel Filament utilise ses
traductions françaises intégrées ; les messages de validation Laravel utilisent
`lang/fr/*.php` généré via `php artisan lang:add fr`.

**Non installés actuellement** (mentionnés dans une ancienne version de ce fichier, à
réintroduire ici seulement une fois réellement ajoutés au projet) : Livewire, Volt,
DaisyUI, Mary UI, Laravel DomPDF, Darryldecode Cart, PHPStan/Larastan, Rector,
Spatie Permission, Mews Purifier, Intervention Image.

Les tests utilisent toujours SQLite en mémoire (`phpunit.xml`), indépendamment de la
base MySQL de développement.

## Architecture actuelle

```
app/
├── Enums/
│   ├── TambourCategoryType.php   # Tambour | Accessoire
│   └── OrderStatus.php           # Pending | Paid | Cancelled
├── Http/
│   └── Controllers/
│       ├── HomeController.php
│       ├── ProductController.php   # catalogue + fiche produit
│       ├── CartController.php      # panier en session
│       ├── CheckoutController.php  # Stripe Checkout
│       └── PageController.php      # À propos / Guide
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Product.php   # HasMedia (galerie + son)
│   ├── Order.php
│   └── OrderItem.php
├── Services/
│   ├── CartService.php       # panier stocké en session
│   └── CheckoutService.php   # création commande + session Stripe
├── Filament/
│   └── Resources/            # ProductResource, CategoryResource, OrderResource, UserResource
└── Providers/
    ├── AppServiceProvider.php
    └── Filament/AdminPanelProvider.php   # panel /admin

resources/
├── views/
│   ├── layouts/app.blade.php
│   ├── home.blade.php
│   ├── products/{index,show}.blade.php
│   ├── cart/show.blade.php
│   ├── checkout/{success,cancel}.blade.php
│   ├── pages/{about,guide}.blade.php
│   └── components/{product-card,audio-player}.blade.php
└── css/, js/                # Tailwind + Alpine.js via Vite

routes/
└── web.php

tests/
├── Unit/CartServiceTest.php
└── Feature/{HomePageTest,ProductPageTest,CartTest,AdminAccessTest}.php
```

Aucun dossier `Actions/`, `Rules/`, `Repositories/`, `Mail/`, `Notifications/`,
`Traits/` n'existe pour l'instant. Créer ces dossiers seulement quand un
besoin réel se présente, pas par anticipation.

Le panier vit en session (pas de modèle `Cart` en base) via `App\Services\CartService`.
L'intégration Stripe Checkout est branchée (`App\Services\CheckoutService`) mais nécessite
les clés `STRIPE_KEY`/`STRIPE_SECRET` dans `.env` pour fonctionner réellement.

L'accès au panel Filament (`/admin`) est réservé aux utilisateurs dont `is_admin` vaut
`true` (`App\Models\User::canAccessPanel()`, interface `FilamentUser`).

## Conventions modèles

Les attributs `$fillable` et `$hidden` utilisent les attributs PHP 8 natifs :

```php
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable { ... }
```

Cette convention est déjà en place sur `App\Models\User` et doit être suivie pour tout
nouveau modèle.

## Tests

- Le projet utilise **Pest** (`pestphp/pest` + `pestphp/pest-plugin-laravel`).
- `tests/Unit/` — logique métier isolée.
- `tests/Feature/` — workflows HTTP, contrôleurs.
- `tests/Pest.php` — configuration Pest (binding de `Tests\TestCase` sur `Feature` et `Unit`).
- `phpunit.xml` configure SQLite en mémoire (`:memory:`) pour les tests.

## Configuration

- Variables d'env dans `.env` (copie de `.env.example`).
- `config/` — configuration de l'app (database, cache, queue, etc.).
- `phpunit.xml` — configuration des tests.
- Aucun `.claude/settings.json` n'existe actuellement dans ce dépôt.

## Conventions Git

- Aucun dépôt git n'est initialisé pour l'instant (`git init` à faire avant tout
  versionnement).
- Préfixe des commits (une fois le dépôt créé) : `[Claude] `
- Préfixe des branches : `claude/`
- Toujours confirmer avant de committer/pousser.

## Notes pour l'évolution de ce fichier

Quand une nouvelle dépendance ou un nouveau dossier d'architecture est ajouté au projet
(Livewire, Filament, un dossier `Services/`, etc.), mettre à jour les sections
correspondantes ci-dessus plutôt que de laisser ce fichier dériver du code réel.

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application running on PHP 8.3. You are an expert with the Laravel ecosystem. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists (settled decisions, non-obvious traps, standing constraints). Framework and package guidelines that only apply to specific paths (testing, frontend, components) also live there, under `.ai/rules/boost` — this is not just recorded decisions, it is load-bearing guidance you have not seen inline. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.
- Record durable rules with `record-rule` so the next agent or teammate inherits them instead of working them out again. Pass a `glob` (e.g. `app/Http/Controllers/**`), a short `title`, and a few-line `note`. Always use `record-rule`, never your native memory or notes tool — native memory is personal and session-scoped; only `.ai/rules` is shared with the team and persists in the repo.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== tests rules ===

# Test Enforcement

- Test every code change by adding or updating a test.
- Run the affected tests and ensure they pass.
- Test the changed behavior and its important failure modes, but do not add tests beyond them.
- Read the `testing-best-practices` skill before writing tests.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

# Pest

- This project uses Pest. Create tests with `php artisan make:test --pest {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.
- Do not delete tests or test files without approval. They are part of the application.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/pest` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.
- After the feature tests pass, ask the user to run the complete suite with `php artisan test --compact`.

</laravel-boost-guidelines>
