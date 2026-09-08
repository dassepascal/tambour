<?php

use App\Filament\Widgets\StatsOverview;
use App\Models\User;
use Livewire\Livewire;

test('un utilisateur non-admin ne peut pas accéder au panel admin', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertForbidden();
});

test('un utilisateur admin peut accéder au panel admin', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin');

    $response->assertOk();
});

test('le dashboard admin affiche les statistiques', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    Livewire::actingAs($admin)
        ->test(StatsOverview::class)
        ->assertSeeText("Chiffre d'affaires");
});

test('un visiteur non authentifié est redirigé vers la connexion', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/admin/login');
});

test('un admin peut accéder au formulaire de création de produit', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin/products/create');

    $response->assertOk();
    $response->assertSeeText('Galerie photo');
    $response->assertSeeText('Vue à 360°');
});
