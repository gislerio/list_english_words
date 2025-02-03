<?php

namespace App\Repositories;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Eloquent\Collection;

class FavoriteRepository
{
    public function getUserFavorites(int $userId): Collection
    {
        return Favorite::where('user_id', $userId)->get();
    }

    public function findFavorite(int $userId, int $wordId): ?Favorite
    {
        return Favorite::where('user_id', $userId)
            ->where('word_id', $wordId)
            ->first();
    }

    public function addFavorite(User $userId, Word $wordId): Favorite
    {
        return Favorite::firstOrCreate(['user_id' => $userId, 'word_id' => $wordId]);
    }

    public function removeFavorite(int $userId, int $wordId): bool
    {
        return Favorite::where('user_id', $userId)
                ->where('word_id', $wordId)
                ->delete() > 0;
    }
}
