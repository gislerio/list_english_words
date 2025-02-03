<?php

namespace App\Http\Controllers;

use App\Services\WordService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WordController extends Controller
{
    public function __construct(private WordService $wordService) {}

    public function index(Request $request): JsonResponse
    {
        $search = $request->query('search', '');
        $words = $this->wordService->searchWords($search);
        return response()->json($words);
    }

    public function show(Request $request, string $word): JsonResponse
    {
        $userId = $request->user()?->id;
        $wordDetails = $this->wordService->getWordDetails($word, $userId);

        if (!$wordDetails) {
            return response()->json(['message' => 'Word not found'], 404);
        }

        return response()->json($wordDetails);
    }
}
