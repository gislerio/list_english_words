<?php

namespace Tests\Unit;

use App\Models\Word;
use App\Repositories\WordRepository;
use App\Repositories\HistoryRepository;
use App\Services\WordService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class WordServiceTest extends TestCase
{
    private WordService $wordService;
    private WordRepository $wordRepository;
    private HistoryRepository $historyRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->wordRepository = $this->createMock(WordRepository::class);
        $this->historyRepository = $this->createMock(HistoryRepository::class);
        $this->wordService = new WordService($this->wordRepository, $this->historyRepository);
    }

    public function test_search_words()
    {
        $mockWords = collect([(new Word(['word' => 'example']))]);

        $this->wordRepository->method('searchWords')->willReturn($mockWords);

        $words = $this->wordService->searchWords('example');

        $this->assertCount(1, $words);
        $this->assertEquals('example', $words->first()->word);
    }

    public function test_get_word_details_with_cache()
    {
        Cache::shouldReceive('remember')->once()->andReturn(new Word(['word' => 'test']));

        $word = $this->wordService->getWordDetails('test');

        $this->assertEquals('test', $word->word);
    }
}
