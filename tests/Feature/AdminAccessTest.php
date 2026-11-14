<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitante_nao_acessa_admin(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_usuario_comum_nao_acessa_admin(): void
    {
        $user = User::factory()->create();

        $user->profile()->create([
            'type' => 'comum',
            'description' => 'Usuário comum',
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertForbidden();
    }

    public function test_administrador_acessa_admin(): void
    {
        $user = User::factory()->create();

        $user->profile()->create([
            'type' => 'admin',
            'description' => 'Administrador',
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertOk();
    }
}