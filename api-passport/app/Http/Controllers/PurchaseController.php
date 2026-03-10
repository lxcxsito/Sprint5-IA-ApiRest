<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    public function index()
    {
        $purchases = Purchase::with(['user', 'game'])->get();

        return response()->json($purchases, 200);
    }


    public function store($id)
    {
        $user = Auth::user();

        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'message' => 'Game not found'
            ], 404);
        }

        $alreadyPurchased = Purchase::where('user_id', $user->id)
            ->where('game_id', $id)
            ->exists();

        if ($alreadyPurchased) {
            return response()->json([
                'message' => 'You already own this game'
            ], 400);
        }

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'purchase_date' => now()
        ]);

        return response()->json([
            'message' => 'Purchase completed successfully',
            'purchase' => $purchase
        ], 201);
    }

    public function myGames()
    {
        $user = Auth::user();

        $games = $user->games()
            ->with('category')
            ->get();

        return response()->json($games, 200);
    }
}
