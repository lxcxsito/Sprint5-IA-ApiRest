<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Game;
use App\Models\Category;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'urlImage' => $this->faker->imageUrl(640, 480, 'games', true),
            'category_id' => Category::factory(),
        ];
    }
}
