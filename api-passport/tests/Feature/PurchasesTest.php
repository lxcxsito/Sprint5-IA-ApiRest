<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Game;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class PurchasesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_purchase_game()
    {
        Passport::actingAs(User::factory()->create());

        $category = Category::factory()->create();

        $game = Game::factory()->create([
            'category_id' => $category->id
        ]);

        $response = $this->postJson("/api/purchases/{$game->id}");

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Purchase completed successfully'
                 ]);

        $this->assertDatabaseHas('purchases', [
            'game_id' => $game->id
        ]);
    }

    public function test_user_cannot_purchase_same_game()
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $category = Category::factory()->create();

        $game = Game::factory()->create([
            'category_id' => $category->id
        ]);

        $this->postJson("/api/purchases/{$game->id}");

        $response = $this->postJson("/api/purchases/{$game->id}");

        $response->assertStatus(400)
                 ->assertJson([
                     'message' => 'You already own this game'
                 ]);
    }

    public function test_user_can_view_my_games()
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $category = Category::factory()->create();

        $game = Game::factory()->create([
            'category_id' => $category->id
        ]);

        $this->postJson("/api/purchases/{$game->id}");

        $response = $this->getJson('/api/my-games');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $game->id
                 ]);
    }
}