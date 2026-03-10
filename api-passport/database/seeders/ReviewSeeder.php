<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $games = Game::all();

        if ($users->isEmpty() || $games->isEmpty()) {
            return;
        }

        foreach ($games as $game) {
            // Cada juego tendrá entre 2 y 5 reviews
            $randomUsers = $users->random(rand(2, min(5, $users->count())));

            foreach ($randomUsers as $user) {
                Review::create([
                    'user_id' => $user->id,
                    'game_id' => $game->id,
                    'rating' => rand(3, 5),
                    'comment' => fake()->sentence(rand(8, 15)),
                ]);
            }
        }
    }
}
