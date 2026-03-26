<?php 
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateReviewController extends Controller
{
    public function index(Game $game)
    {
        if (!Auth::check()) {
            return redirect()->route('login.index');
        }

        return view('games.createReview', compact('game'));
    }

    public function createReview(Request $request, Game $game)
    {
        $request->validate([
            'description' => 'required|min:10',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'game_id' => $game->id,
            'comment' => $request->description,
            'rating' => $request->rating,
        ]);

        return redirect()
            ->route('games.reviews', $game)
            ->with('success', 'Review created successfully!');
    }
}

?>