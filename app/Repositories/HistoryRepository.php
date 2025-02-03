<?php

namespace App\Repositories;

use App\Models\History;

class HistoryRepository
{
    public function saveSearchHistory(int $userId, int $wordId): void
    {
        History::create([
            'user_id' => $userId,
            'word_id' => $wordId,
        ]);
    }

    public function getUserHistory(int $userId, int $limit = 10)
    {
        return History::where('user_id', $userId)
            ->with('word')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }
}
