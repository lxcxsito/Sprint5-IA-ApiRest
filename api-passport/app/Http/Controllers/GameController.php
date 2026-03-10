<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        $games = Game::with('category')->get();

        return response()->json($games);
    }

    public function show($id)
    {
        $game = Game::with(['category', 'reviews'])
                    ->find($id);

        if (!$game) {
            return response()->json([
                'message' => 'Juego no encontrado'
            ], 404);
        }

        return response()->json($game);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'urlImage' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $game = Game::create($validated);

        return response()->json($game, 201);
    }

    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Game not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'urlImage' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $game->update($validated);

        return response()->json($game);
    }

    public function destroy($id)
{
    $game = Game::find($id);

    if (!$game) {
        return response()->json(['message' => 'Juego no encontrado'], 404);
    }

    // Borra relaciones
    $game->purchases()->delete();
    $game->reviews()->delete();

    $game->delete();

    return response()->json(['message' => 'Game deleted successfully'], 200);
}

    
}