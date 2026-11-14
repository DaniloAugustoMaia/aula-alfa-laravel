<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('visitante é redirecionado para o login', function () {
    $response = $this->get('/');

    $response->assertRedirect('/login');
});

test('usuário autenticado acessa a página inicial', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertOk();
});