<?php

namespace Tests\Unit;

use App\Repositories\FavoriteRepository;
use App\Services\FavoriteService;
use Tests\TestCase;

class FavoriteServiceTest extends TestCase
{
    private FavoriteService $favoriteService;
    private FavoriteRepository $favoriteRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->favoriteRepository = $this->createMock(FavoriteRepository::class);
        $this->favoriteService = new FavoriteService($this->favoriteRepository);
    }

    public function test_add_favorite()
    {
        $this->favoriteRepository->method('addFavorite')->willReturn(true);

        $result = $this->favoriteService->addFavorite(1, 1);

        $this->assertTrue($result);
    }

    public function test_remove_favorite()
    {
        $this->favoriteRepository->method('removeFavorite')->willReturn(true);

        $result = $this->favoriteService->removeFavorite(1, 1);

        $this->assertTrue($result);
    }
}
