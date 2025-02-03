<?php

namespace App\Services;

use App\Models\User;
use App\Models\Word;
use App\Repositories\FavoriteRepository;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Collection;

class FavoriteService
{
    private FavoriteRepository $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function getUserFavorites(int $userId): Collection
    {
        return $this->favoriteRepository->getUserFavorites($userId);
    }

    public function addFavorite(User $user, Word $word): Favorite
    {
        return $this->favoriteRepository->addFavorite($user->id, $word->id);
    }

    public function removeFavorite(int $userId, int $wordId): bool
    {
        $favorite = $this->favoriteRepository->findFavorite($userId, $wordId);

        return $favorite ? $this->favoriteRepository->removeFavorite($favorite) : false;
    }
}
