<?php

namespace App\Services;

use App\Repositories\HistoryRepository;

class HistoryService
{
    public function __construct(private HistoryRepository $historyRepository) {}

    public function getUserHistory(int $userId, int $limit = 10)
    {
        return $this->historyRepository->getUserHistory($userId, $limit);
    }
}
