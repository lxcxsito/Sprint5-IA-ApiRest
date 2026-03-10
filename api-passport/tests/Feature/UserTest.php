<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_user_cannot_access_user_data()
    {
        $user = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->getJson("/api/users/{$user->id}");
        $response->assertStatus(401);
    }

    /** @test */
    public function authenticated_user_can_view_user_data()
    {
        $user = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        Passport::actingAs($user);

        $response = $this->getJson("/api/users/{$user->id}");
        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $user->id,
                     'email' => $user->email
                 ]);
    }

    /** @test */
    public function viewing_nonexistent_user_returns_404()
    {
        $user = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        Passport::actingAs($user);

        $response = $this->getJson("/api/users/999");
        $response->assertStatus(404)
                 ->assertJson(['message' => 'Usuario no encontrado']);
    }

    /** @test */
    public function authenticated_user_can_update_own_data()
    {
        $user = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        Passport::actingAs($user);

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Lucas Updated',
            'email' => 'lucas2@example.com',
            'password' => 'newpass123'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => 'Lucas Updated',
                     'email' => 'lucas2@example.com'
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Lucas Updated',
            'email' => 'lucas2@example.com'
        ]);
    }

    /** @test */
    public function updating_nonexistent_user_returns_404()
    {
        $user = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        Passport::actingAs($user);

        $response = $this->putJson("/api/users/999", [
            'name' => 'Does Not Exist'
        ]);

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Usuario no encontrado']);
    }

    /** @test */
    public function updating_with_invalid_data_returns_422()
    {
        $user = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@example.com',
            'password' => Hash::make('secret123')
        ]);

        Passport::actingAs($user);

        // Contraseña demasiado corta
        $response = $this->putJson("/api/users/{$user->id}", [
            'password' => '123'
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['password']);
    }
}
