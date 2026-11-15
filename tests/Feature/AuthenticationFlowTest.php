<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_cadastro_publico_cria_usuario_comum(): void
    {
        $response = $this->post('/store', [
            'name' => 'Usuario Teste',
            'email' => 'usuario@teste.com',
            'password' => 'Senha@123456',
            'password_confirmation' => 'Senha@123456',
        ]);

        $response->assertRedirect('/login');

        $user = User::where('email', 'usuario@teste.com')->firstOrFail();

        $this->assertEquals('comum', $user->profile?->type);
    }

    public function test_administrador_cadastra_usuario_comum(): void
    {
        $admin = User::factory()->create();

        $admin->profile()->create([
            'type' => 'admin',
            'description' => 'Administrador',
        ]);

        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Novo Usuario',
            'email' => 'novo@teste.com',
            'password' => 'Senha@123456',
            'password_confirmation' => 'Senha@123456',
        ]);

        $response->assertRedirect('/admin/users');

        $user = User::where('email', 'novo@teste.com')->firstOrFail();

        $this->assertEquals('comum', $user->profile?->type);
    }

    public function test_usuario_comum_nao_pode_cadastrar_pelo_painel(): void
    {
        $user = User::factory()->create();

        $user->profile()->create([
            'type' => 'comum',
            'description' => 'Usuario comum',
        ]);

        $response = $this->actingAs($user)->post('/admin/users', [
            'name' => 'Usuario Indevido',
            'email' => 'indevido@teste.com',
            'password' => 'Senha@123456',
            'password_confirmation' => 'Senha@123456',
        ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('users', [
            'email' => 'indevido@teste.com',
        ]);
    }

    public function test_login_admin_redireciona_para_lista_administrativa(): void
    {
        $admin = User::factory()->create([
            'password' => 'Senha@123456',
        ]);

        $admin->profile()->create([
            'type' => 'admin',
            'description' => 'Administrador',
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'Senha@123456',
        ]);

        $response->assertRedirect('/admin/users');

        $this->assertAuthenticatedAs($admin);
    }

    public function test_login_usuario_comum_redireciona_para_inicio(): void
    {
        $user = User::factory()->create([
            'password' => 'Senha@123456',
        ]);

        $user->profile()->create([
            'type' => 'comum',
            'description' => 'Usuario comum',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Senha@123456',
        ]);

        $response->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }

    public function test_logout_encerra_a_sessao(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');

        $this->assertGuest();
    }
}