<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ClientRepository;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $clientRepository = new ClientRepository();
        $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            'http://localhost'
        );
    }

    /** @test */
    public function register_ok()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => 'secret123'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => 'lucas@example.com'
        ]);
    }

    /** @test */
    public function register_email_exists()
    {
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->postJson('/api/register', [
            'name' => 'Otro',
            'email' => 'lucas@example.com',
            'password' => 'secret123'
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function login_ok()
    {
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'lucas@example.com',
            'password' => 'secret123'
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function login_wrong_password()
    {
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'lucas@example.com',
            'password' => 'wrong'
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function logout_ok()
    {
        $user = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->postJson('/api/logout');

        $response->assertStatus(200);
    }

    /** @test */
    public function logout_without_token()
    {
        $response = $this->postJson('/api/logout');

        $response->assertStatus(401);
    }
}