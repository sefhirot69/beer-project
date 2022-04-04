<?php

declare(strict_types=1);

namespace App\Tests\Unitary\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Beer\Infrastructure\ApiPunkGetBeerRepository;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ApiPunkGetBeerRepositoryTest extends TestCase
{
    /**
     * @var HttpClientDataSource|MockObject
     */
    private $httpClientMock;

    protected function setUp(): void
    {
        $this->httpClientMock = $this->createMock(HttpClientDataSource::class);
    }

    /**
     * @test
     */
    public function shouldExpectBeerNotFound(): void
    {
        // THEN
        $this->expectException(BeersNotFoundException::class);

        // GIVEN
        $beer = [];

        $this->httpClientMock
            ->expects(self::once())
            ->method('fetch')
            ->willReturn($beer);

        // WHEN

        $repository = new ApiPunkGetBeerRepository($this->httpClientMock);
        $repository->get();
    }
}
