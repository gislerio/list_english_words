<?php

use App\Http\Controllers\ApiDocumentationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return response()->json(['message' => 'Fullstack Challenge 🏅 - Dictionary']);
});

Route::prefix('auth')->group(function () {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::middleware('auth:sanctum')->post('/signout', [AuthController::class, 'signout']);
});

Route::get('/doc/openapi', [ApiDocumentationController::class, 'openApi']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/me', [AuthController::class, 'me']);
    Route::get('/user/me/history', [HistoryController::class, 'listHistory']);
    Route::get('/user/me/favorites', [FavoriteController::class, 'listFavorites']);

    Route::prefix('entries/en')->group(function () {
        Route::get('/', [WordController::class, 'index']);
        Route::get('/{word}', [WordController::class, 'show']);
        Route::post('/{word}/favorite', [FavoriteController::class, 'addFavorite']);
        Route::delete('/{word}/unfavorite', [FavoriteController::class, 'removeFavorite']);
    });
});
