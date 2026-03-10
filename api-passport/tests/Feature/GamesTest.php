<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Game;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear categorías necesarias
        $this->category1 = Category::create(['name' => 'Acción']);
        $this->category2 = Category::create(['name' => 'Deportes']);
    }

    /** @test */
    public function get_all_games()
    {
        // Crear juegos asociados a categorías
        Game::create([
            'title' => 'Counter Strike',
            'description' => 'Shooter 1st person',
            'price' => 0,
            'urlImage' => 'images/cs.jpg',
            'category_id' => $this->category1->id
        ]);

        Game::create([
            'title' => 'FIFA 25',
            'description' => 'Football game',
            'price' => 59.99,
            'urlImage' => 'images/fifa25.jpg',
            'category_id' => $this->category2->id
        ]);

        $response = $this->getJson('/api/games');

        $response->assertStatus(200)
                 ->assertJsonCount(2) // 2 juegos
                 ->assertJsonFragment(['title' => 'Counter Strike'])
                 ->assertJsonFragment(['title' => 'FIFA 25']);
    }

    /** @test */
    public function get_single_game()
    {
        $game = Game::create([
            'title' => 'Call Of Duty',
            'description' => 'Shooter arcade',
            'price' => 20,
            'urlImage' => 'images/cod.jpg',
            'category_id' => $this->category1->id
        ]);

        $response = $this->getJson("/api/games/{$game->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $game->id,
                     'title' => 'Call Of Duty'
                 ]);
    }
/** @test */
public function get_game_not_found()
{
    $response = $this->getJson('/api/games/999');

    $response->assertStatus(404)
             ->assertJson(['message' => 'Juego no encontrado']); // <-- aquí
}
}