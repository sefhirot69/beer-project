<?php

namespace App\Tests\Unitary\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use App\Tests\DataMock\ApiPunkResponse;
use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Dto\BeerDetailsDto;
use App\BeerCatalog\Beer\Domain\Dto\BeerDto;
use App\BeerCatalog\Beer\Infrastructure\ApiPunkFinderBeerRepository;
use App\BeerCatalog\Shared\Domain\HttpClientDataSource;
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
        $query = FindBeerByFoodQuery::create('a', false);

        //WHEN
        $this->httpClientMock
            ->expects(self::once())
            ->method('fetch')
            ->willReturn($fakeResponse);
        $res = new ApiPunkFinderBeerRepository($this->httpClientMock, '');

        //THEN
        $result = $res->findBeerByFood($query);

        foreach ($result->getCatalogBeer() as $beerDto) {
            self::assertInstanceOf(BeerDto::class, $beerDto);
            self::assertNull($beerDto->getDetails());
        }
    }

    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function findBeerByFoodShouldReturnCatalogBeerDtoWithDetails(): void
    {
        //GIVEN
        $fakeResponse = json_decode(ApiPunkResponse::responseOk(), true);
        $query = FindBeerByFoodQuery::create('a', true);

        //WHEN
        $this->httpClientMock
            ->expects(self::once())
            ->method('fetch')
            ->willReturn($fakeResponse);
        $res = new ApiPunkFinderBeerRepository($this->httpClientMock, '');

        //THEN
        $result = $res->findBeerByFood($query);

        foreach ($result->getCatalogBeer() as $beerDto) {
            self::assertInstanceOf(BeerDto::class, $beerDto);
            self::assertNotNull($beerDto->getDetails());
            self::assertInstanceOf(BeerDetailsDto::class, $beerDto->getDetails());
        }
    }

    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function findBeerByFoodShouldReturnExceptionNotFoundFood(): void
    {
        $this->expectException(BeersNotFoundException::class);
        $this->expectExceptionCode(404);

        //GIVEN
        $query = FindBeerByFoodQuery::create('a', false);
        $fakeResponse = json_decode(ApiPunkResponse::responseEmpty(), true);

        //WHEN
        $this->httpClientMock
            ->expects(self::once())
            ->method('fetch')
            ->willReturn($fakeResponse);
        $res = new ApiPunkFinderBeerRepository($this->httpClientMock, '');

        //THEN
        $res->findBeerByFood($query);
    }


    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function findBeerByFoodShouldReturnExceptionHttpClient(): void
    {
        //GIVEN
        $messageError = 'An error occur';
        $exceptionHttp = new HttpClientException($messageError);
        $query = FindBeerByFoodQuery::create('a', false);

        $this->expectException(HttpClientException::class);
        $this->expectExceptionCode(400);

        //WHEN
        $this->httpClientMock
            ->expects(self::once())
            ->method('fetch')
            ->willThrowException($exceptionHttp);
        $res = new ApiPunkFinderBeerRepository($this->httpClientMock, '');

        //THEN
        $res->findBeerByFood($query);
    }

}
