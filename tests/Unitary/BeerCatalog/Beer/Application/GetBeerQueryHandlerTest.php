<?php

namespace App\Tests\Unitary\BeerCatalog\Beer\Application;

use App\BeerCatalog\Beer\Application\GetBeerQueryHandler;
use App\BeerCatalog\Beer\Domain\DataSource\GetBeerDataSource;
use App\Tests\Unitary\BeerCatalog\Beer\Domain\BeerMother;
use PHPUnit\Framework\MockObject\MockObject;
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
            ->with($this->equalTo(false))
            ->willReturn($beer->mapToDto());

        $result = new GetBeerQueryHandler($this->getBeerDS);
        $result();
    }

    /**
     * @test
     */
    public function shouldReturnBeerDtoWithDetail(): void
    {
        // GIVEN
        $beer = BeerMother::randomBeerWithDetail();

        $this->getBeerDS
            ->expects(self::once())
            ->method('get')
            ->with($this->equalTo(false))
            ->willReturn($beer->mapToDto());

        $result = new GetBeerQueryHandler($this->getBeerDS);
        $result();
    }
}
