<?php

namespace App\Http\Controllers;

use App\Services\HistoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HistoryController extends Controller
{
    public function __construct(private HistoryService $historyService) {}

    public function listHistory(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $history = $this->historyService->getUserHistory($userId);

        return response()->json($history);
    }
}


