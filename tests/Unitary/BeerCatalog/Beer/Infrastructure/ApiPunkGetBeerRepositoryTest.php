<?php

declare(strict_types=1);

namespace App\Tests\Unitary\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Domain\Beer;
use App\BeerCatalog\Beer\Domain\BeerDetails;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Beer\Infrastructure\ApiPunkGetBeerRepository;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;
use App\Tests\Shared\DataMock\ApiPunkResponse;
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

    /**
     * @test
     */
    public function shouldReturnBeerDto(): void
    {
        // GIVEN
        $beer = json_decode(ApiPunkResponse::responseBeerOk(), true, 512, JSON_THROW_ON_ERROR);

        $this->httpClientMock
            ->expects(self::once())
            ->method('fetch')
            ->willReturn($beer);

        // WHEN
        $repository = new ApiPunkGetBeerRepository($this->httpClientMock);
        $result = $repository->get();

        // THEN
    }
}
