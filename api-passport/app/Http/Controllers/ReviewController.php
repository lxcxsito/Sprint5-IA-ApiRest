<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Game;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($gameId)
    {
        $reviews = Review::with('user')
            ->where('game_id', $gameId)
            ->get();

        return response()->json($reviews);
    }

    public function store(Request $request, $gameId)
    {
        $user = auth()->user();

        $hasPurchased = $user->purchases()
            ->where('game_id', $gameId)
            ->exists();

        if (!$hasPurchased) {
            return response()->json([
                'message' => 'Debes comprar el juego antes de dejar una review'
            ], 403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $existing = Review::where('user_id', $user->id)
            ->where('game_id', $gameId)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Ya has hecho una review para este juego'
            ], 400);
        }

        $review = Review::create([
            'user_id' => $user->id,
            'game_id' => $gameId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]);

        return response()->json($review, 201);
    }
}