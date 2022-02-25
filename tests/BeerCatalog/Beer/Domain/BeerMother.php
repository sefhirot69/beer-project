<?php

declare(strict_types=1);

namespace BeerCatalog\Tests\Beer\Domain;

use App\Tests\Shared\ObjectMother\MotherCreator;
use BeerCatalog\Beer\Domain\Beer;
use BeerCatalog\Beer\Domain\BeerDetails;

final class BeerMother
{
    public static function create(
        int $id,
        string $name,
        string $description,
        ?BeerDetails $details = null
    ): Beer {

        return Beer::create($id, $name, $description, $details);
    }

    public static function randomBeer(): Beer
    {

        return self::create(
            MotherCreator::random()->randomNumber(3),
            MotherCreator::random()->name(),
            MotherCreator::random()->text(),
        );
    }

    public static function randomBeerWithDetail(): Beer
    {

        return self::create(
            MotherCreator::random()->randomNumber(3),
            MotherCreator::random()->name(),
            MotherCreator::random()->text(),
            BeerDetailsMother::random()
        );
    }

}