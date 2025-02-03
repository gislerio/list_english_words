<?php

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Support\Facades\DB;

class ImportWordsRepository
{
    public function importFromFile(string $filePath): void
    {
        DB::transaction(function () use ($filePath) {
            $handle = fopen($filePath, 'r');
            if (!$handle) {
                throw new \Exception("Não foi possível abrir o arquivo.");
            }

            while (($line = fgets($handle)) !== false) {
                $word = trim($line);
                if (!empty($word)) {
                    Word::firstOrCreate(['word' => $word]);
                }
            }

            fclose($handle);
        });
    }
}
