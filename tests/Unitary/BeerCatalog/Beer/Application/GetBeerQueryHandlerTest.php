<?php

namespace App\Tests\Unitary\BeerCatalog\Beer\Application;

use App\BeerCatalog\Beer\Application\GetBeerQueryHandler;
use App\BeerCatalog\Beer\Domain\DataSource\GetBeerDataSource;
use App\Tests\Unitary\BeerCatalog\Beer\Domain\BeerMother;
use PHPUnit\Framework\TestCase;

class GetBeerQueryHandlerTest extends TestCase
{
    private GetBeerDataSource|MockObject $getBeerDS;

    protected function setUp(): void
    {
        $this->getBeerDS = $this->createMock(GetBeerDataSource::class);
    }

    /**
     * @test
     */
    public function shouldReturnBeerDto(): void
    {
        // GIVEN
        $beer = BeerMother::randomBeer();

        $this->getBeerDS
            ->expects(self::once())
            ->method('get')
            ->willReturn($beer->mapToDto());

        $result = new GetBeerQueryHandler($this->getBeerDS);
        $result();
    }
}
