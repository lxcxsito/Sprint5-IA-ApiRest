<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\ReviewController;


// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/games/top-rated', [StatsController::class, 'topRatedGames']);
Route::get('/games/most-sold', [StatsController::class, 'mostSoldGames']);
Route::middleware('auth:api')->get('/users/top-buyers', [StatsController::class, 'topBuyers']);

Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);


// Rutas protegidas por auth
Route::middleware('auth:api')->group(function () {
    // Auth
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Users
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Purchases
    Route::post('/purchases/{id}', [PurchaseController::class, 'store']);
    Route::get('/my-games', [PurchaseController::class, 'myGames']);
});

// Rutas de admin
Route::middleware(['auth:api', 'admin'])->group(function () {
    // Juegos
    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{id}', [GameController::class, 'update']);
    Route::delete('/games/{id}', [GameController::class, 'destroy']);

    // Compras
    Route::get('/purchases', [PurchaseController::class, 'index']);
});

//Reviews
Route::middleware('auth:api')->group(function () {

    Route::get('/games/{id}/reviews', [ReviewController::class, 'index']);

    Route::post('/games/{id}/reviews', [ReviewController::class, 'store']);

});



