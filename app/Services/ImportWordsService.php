<?php

namespace App\Services;

use App\Repositories\ImportWordsRepository;

class ImportWordsService
{
    public function __construct(private ImportWordsRepository $importWordsRepository) {}

    public function importWords(string $filePath): void
    {
        $this->importWordsRepository->importFromFile($filePath);
    }
}
