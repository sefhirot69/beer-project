<?php

declare(strict_types=1);

namespace App\Tests\BeerCatalog\Beer\Application\Find;

use App\BeerCatalog\Beer\Application\Find\FindBeerByFoodQueryHandler;
use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\DataSource\FinderBeerDataSource;
use App\Tests\BeerCatalog\Beer\Domain\CatalogBeerMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class FindBeerByFoodQueryHandlerTest extends TestCase
{
    /**
     * @var FinderBeerDataSource|MockObject
     */
    private $finderBeerMock;

    protected function setUp(): void
    {
        $this->finderBeerMock = $this->createMock(FinderBeerDataSource::class);
    }


    /**
     * @test
     * @given
     * @when
     * @then
     */
    public function findBeerByFoodQueryHandlerShouldReturnOnceCatalogBeerDto() : void
    {
        //GIVEN
        $query = FindBeerByFoodQuery::create('crud',false);

        $this->finderBeerMock
            ->expects(self::once())
            ->method('findBeerByFood')
            ->willReturn(CatalogBeerMother::randomBeer()->mapToDto());

        //WHEN
        $findBeerByFoodQueryHandler = new FindBeerByFoodQueryHandler($this->finderBeerMock);

        //THEN
        ($findBeerByFoodQueryHandler)($query);
    }
}
