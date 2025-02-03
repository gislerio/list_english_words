<?php

namespace Tests\Unit;

use App\Repositories\HistoryRepository;
use App\Services\HistoryService;
use Tests\TestCase;

class HistoryServiceTest extends TestCase
{
    private HistoryService $historyService;
    private HistoryRepository $historyRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->historyRepository = $this->createMock(HistoryRepository::class);
        $this->historyService = new HistoryService($this->historyRepository);
    }

    public function test_get_user_history()
    {
        $mockHistory = collect([]);

        $this->historyRepository->method('getUserHistory')->willReturn($mockHistory);

        $history = $this->historyService->getUserHistory(1);

        $this->assertCount(0, $history);
    }
}
