<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Game;
use App\Models\Category;
use App\Models\Purchase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public $category = null;
    public $admin = null;

    public $user = null;
    protected function setUp(): void
    {
        parent::setUp();
        // Crear categoría de prueba
        $this->category = Category::factory()->create();
        // Crear usuario admin
        $this->admin = User::factory()->create([
            'role' => User::ROLE_ADMIN
        ]);
        // Crear usuario normal
        $this->user = User::factory()->create([
            'role' => User::ROLE_USER
        ]);
    }

    /** @test */
    public function admin_can_create_game()
    {

        Passport::actingAs($this->admin);

        $response = $this->postJson('/api/games', [
            'title' => 'Test Game',
            'description' => 'Descripción del juego',
            'price' => 50,
            'urlImage' => 'image.jpg',
            'category_id' => $this->category->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Test Game']);
    }

    /** @test */
    public function admin_can_update_game()
    {
        Passport::actingAs($this->admin);

        $game = Game::factory()->create(['category_id' => $this->category->id]);

        $response = $this->putJson("/api/games/{$game->id}", [
            'title' => 'Game Updated'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Game Updated']);
    }

    /** @test */
    public function admin_can_delete_game()
    {
        Passport::actingAs($this->admin);

        $game = Game::factory()->create(['category_id' => $this->category->id]);

        $response = $this->deleteJson("/api/games/{$game->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Game deleted successfully']);
    }

    /** @test */
    public function admin_can_view_all_purchases()
    {
        Passport::actingAs($this->admin);

        $game = Game::factory()->create(['category_id' => $this->category->id]);
        $purchase = Purchase::factory()->create([
            'user_id' => $this->user->id,
            'game_id' => $game->id,
        ]);

        $response = $this->getJson('/api/purchases');

        $response->assertStatus(200)
                 ->assertJsonFragment(['game_id' => $game->id]);
    }

    /** @test */
    public function normal_user_cannot_access_admin_routes()
    {
        Passport::actingAs($this->user);

        $game = Game::factory()->create(['category_id' => $this->category->id]);

        $response = $this->postJson('/api/games', [
            'title' => 'Hack Game',
            'description' => 'Trying to create',
            'price' => 10,
            'urlImage' => 'hack.jpg',
            'category_id' => $this->category->id,
        ]);

        $response->assertStatus(403)
         ->assertJson(['message' => 'Forbidden']);
    }
}