<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'game_id' => Game::factory(),
            'purchase_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}