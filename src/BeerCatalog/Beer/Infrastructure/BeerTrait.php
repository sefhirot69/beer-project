<?php

namespace App\BeerCatalog\Beer\Infrastructure;

use App\BeerCatalog\Beer\Domain\Beer;
use App\BeerCatalog\Beer\Domain\BeerDetails;

trait BeerTrait
{
    private function buildBeers(array $resultBeers, bool $withDetails): array
    {
        // Con detalles
        if ($withDetails) {
            return array_map(static function ($beer) {
                return Beer::create(
                    $beer['id'],
                    $beer['name'],
                    $beer['description'],
                    BeerDetails::create($beer['tagline'], $beer['first_brewed'], $beer['image_url']),
                );
            }, $resultBeers);
        }

        // Sin detalles
        return array_map(static function ($beer) {
            return Beer::create($beer['id'], $beer['name'], $beer['description']);
        }, $resultBeers);
    }
}
