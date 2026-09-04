<?php

use App\Models\User;

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

test('un visiteur non authentifié est redirigé vers la connexion', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/admin/login');
});
