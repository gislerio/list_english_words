<?php

namespace App\Services;

use App\Repositories\WordRepository;
use App\Models\Word;
use Illuminate\Database\Eloquent\Collection;

class WordService
{
    private WordRepository $wordRepository;

    public function __construct(WordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    public function findByWord(string $word): ?Word
    {
        return $this->wordRepository->findByWord($word);
    }

    public function getAllWords(): Collection
    {
        return $this->wordRepository->getAllWords();
    }

    public function createWord(array $data): Word
    {
        return $this->wordRepository->create($data);
    }

    public function updateWord(Word $word, array $data): bool
    {
        return $this->wordRepository->update($word, $data);
    }

    public function deleteWord(Word $word): bool
    {
        return $this->wordRepository->delete($word);
    }
}
