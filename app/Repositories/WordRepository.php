<?php

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Database\Eloquent\Collection;

class WordRepository
{
    public function findByWord(string $word): ?Word
    {
        return Word::where('word', $word)->first();
    }

    public function getAllWords(): Collection
    {
        return Word::all();
    }

    public function create(array $data): Word
    {
        return Word::create($data);
    }

    public function update(Word $word, array $data): bool
    {
        return $word->update($data);
    }

    public function delete(Word $word): bool
    {
        return $word->delete();
    }
}
