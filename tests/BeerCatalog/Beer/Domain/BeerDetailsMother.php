<?php

declare(strict_types=1);

namespace BeerCatalog\Tests\Beer\Domain;

use App\Tests\Shared\ObjectMother\MotherCreator;
use BeerCatalog\Beer\Domain\BeerDetails;

final class BeerDetailsMother
{
    public static function create(string $imageUrl, string $tagLine, string $firstBrewed): BeerDetails
    {

        return new BeerDetails($imageUrl, $tagLine, $firstBrewed);
    }

    public static function random(): BeerDetails
    {

        return self::create(
            MotherCreator::random()->imageUrl(),
            MotherCreator::random()->text(30),
            MotherCreator::random()->date('m/Y')
        );
}

}