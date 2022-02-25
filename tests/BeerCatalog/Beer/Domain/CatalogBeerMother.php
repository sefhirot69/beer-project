<?php

declare(strict_types=1);

namespace BeerCatalog\Tests\Beer\Domain;

use BeerCatalog\Beer\Domain\CatalogBeer;

final class CatalogBeerMother
{
    public static function create(array $catalog): CatalogBeer
    {
        return new CatalogBeer($catalog);
    }

    public static function randomBeer(): CatalogBeer
    {
        $limit = random_int(1, 5);
        for ($i = 0; $i <= $limit; $i++) {
            $result[] = BeerMother::randomBeer();
        }
        return CatalogBeer::create($result);
    }

    public static function randomBeerWithDetail(): CatalogBeer
    {
        $limit = random_int(1, 5);
        for ($i = 0; $i <= $limit; $i++) {
            $result[] = BeerMother::randomBeerWithDetail();
        }
        return CatalogBeer::create($result);
    }
}
