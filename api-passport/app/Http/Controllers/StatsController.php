<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Review;

class StatsController extends Controller
{
    public function topRatedGames()
    {
        $games = Game::withAvg('reviews', 'rating')
                     ->orderByDesc('reviews_avg_rating')
                     ->take(10)
                     ->get();

        return response()->json($games);
    }

    // Juegos más vendidos
    public function mostSoldGames()
    {
        $games = Game::withCount('purchases')
                     ->orderByDesc('purchases_count')
                     ->take(10)
                     ->get();

        return response()->json($games);
    }

    // Usuarios que más han comprado
    public function topBuyers()
    {
        $users = User::withCount('games')
                     ->orderByDesc('games_count')
                     ->take(10)
                     ->get();

        return response()->json($users);
    }
}