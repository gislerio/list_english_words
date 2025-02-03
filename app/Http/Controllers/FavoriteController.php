<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FavoriteController extends Controller
{
    public function __construct(private FavoriteService $favoriteService) {}

    public function addFavorite(Request $request, string $word): JsonResponse
    {
        $userId = $request->user()->id;
        $favorite = $this->favoriteService->addFavorite($userId, $word);

        return response()->json($favorite, 201);
    }

    public function removeFavorite(Request $request, string $word): JsonResponse
    {
        $userId = $request->user()->id;
        $this->favoriteService->removeFavorite($userId, $word);

        return response()->json(['message' => 'Favorito removido com sucesso']);
    }

    public function listFavorites(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $favorites = $this->favoriteService->getUserFavorites($userId);

        return response()->json($favorites);
    }
}
