<?php

namespace Tests\Unit;

use App\Repositories\ImportWordsRepository;
use App\Services\ImportWordsService;
use Tests\TestCase;

class ImportWordsServiceTest extends TestCase
{
    private ImportWordsService $importWordsService;
    private ImportWordsRepository $importWordsRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->importWordsRepository = $this->createMock(ImportWordsRepository::class);
        $this->importWordsService = new ImportWordsService($this->importWordsRepository);
    }

    public function test_import_words()
    {
        $this->importWordsRepository->method('importFromFile')->willReturn(null);

        $result = $this->importWordsService->importWords('/path/to/file.txt');

        $this->assertNull($result);
    }
}

