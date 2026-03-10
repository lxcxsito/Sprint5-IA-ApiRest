<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Game;
use App\Models\Category;
use App\Models\Review;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class StatsTest extends TestCase
{
    use RefreshDatabase;

    private $category;
    private $games;
    private $users;

    protected function setUp(): void
    {
        parent::setUp();

        // Categoria
        $this->category = Category::factory()->create();

        // Juegos
        $this->games = Game::factory()->count(5)->create([
            'category_id' => $this->category->id
        ]);

        // Usuarios
        $this->users = User::factory()->count(3)->create();
    }

    /** @test */
    public function top_rated_games_returns_games_ordered_by_average_rating()
    {
        // Crear reviews
        Review::factory()->create([
            'game_id' => $this->games[0]->id,
            'rating' => 5
        ]);
        Review::factory()->create([
            'game_id' => $this->games[1]->id,
            'rating' => 3
        ]);
        Review::factory()->create([
            'game_id' => $this->games[2]->id,
            'rating' => 4
        ]);

        $response = $this->getJson('/api/games/top-rated');

        $response->assertStatus(200);

        $json = $response->json();

        $this->assertEquals(5, $json[0]['reviews_avg_rating']);
    }

    /** @test */
    public function most_sold_games_returns_games_ordered_by_purchases_count()
    {
        // Crear compras
        Purchase::factory()->count(3)->create([
            'game_id' => $this->games[0]->id,
            'user_id' => $this->users[0]->id
        ]);
        Purchase::factory()->count(1)->create([
            'game_id' => $this->games[1]->id,
            'user_id' => $this->users[1]->id
        ]);

        $response = $this->getJson('/api/games/most-sold');

        $response->assertStatus(200);

        $json = $response->json();

        $this->assertEquals($this->games[0]->id, $json[0]['id']);
        $this->assertEquals(3, $json[0]['purchases_count']);
    }

    /** @test */
    public function top_buyers_returns_users_ordered_by_games_count()
    {
        // Admin para autenticación
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        Passport::actingAs($admin);

        // Crear compras
        Purchase::factory()->create([
            'user_id' => $this->users[0]->id,
            'game_id' => $this->games[0]->id
        ]);
        Purchase::factory()->count(2)->create([
            'user_id' => $this->users[1]->id,
            'game_id' => $this->games[1]->id
        ]);

        $response = $this->getJson('/api/users/top-buyers');

        $response->assertStatus(200);

        $json = $response->json();

        $this->assertEquals($this->users[1]->id, $json[0]['id']);
        $this->assertEquals(2, $json[0]['games_count']);
    }
}