<?php

namespace BeerCatalog\Tests\Beer\Infrastructure;

use App\Tests\DataMock\ApiPunkResponse;
use BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use BeerCatalog\Beer\Domain\Dto\BeerDto;
use BeerCatalog\Beer\Infrastructure\ApiPunkFinderBeerRepository;
use BeerCatalog\Shared\Domain\HttpClientDataSource;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ApiPunkFinderBeerRepositoryTest extends TestCase
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
     * @given
     * @when
     * @then
     */
    public function findBeerByFoodShouldReturnCatalogBeerDtoWithoutDetails(): void
    {
        //GIVEN
        $fakeResponse = json_decode(ApiPunkResponse::responseOk(), true);

        //WHEN
        $this->httpClientMock
            ->expects(self::once())
            ->method('fetch')
            ->willReturn($fakeResponse);
        $res = new ApiPunkFinderBeerRepository($this->httpClientMock, '');

        //THEN
        $result = $res->findBeerByFood(FindBeerByFoodQuery::create('a', false));

        foreach ($result->getCatalogBeer() as $beerDto) {
            self::assertInstanceOf(BeerDto::class,$beerDto);
            self::assertNull($beerDto->getDetails());
        }
    }


}
