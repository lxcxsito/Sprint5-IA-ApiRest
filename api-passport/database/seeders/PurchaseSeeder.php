<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $games = Game::all();

        if ($users->isEmpty() || $games->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $randomGames = $games->random(rand(1, min(5, $games->count())));

            foreach ($randomGames as $game) {
                Purchase::create([
                    'user_id' => $user->id,
                    'game_id' => $game->id,
                    'purchase_date' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
