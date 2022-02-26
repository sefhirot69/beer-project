<?php

declare(strict_types=1);


namespace App\Controller\Finder;

use App\BeerCatalog\Beer\Application\Find\FindBeerByFoodQueryHandlerInterface;
use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class FindBeerByFoodController extends AbstractController
{
    private FindBeerByFoodQueryHandlerInterface $findBeerByFoodQueryHandler;

    /**
     * @param FindBeerByFoodQueryHandlerInterface $findBeerByFoodQueryHandler
     */
    public function __construct(FindBeerByFoodQueryHandlerInterface $findBeerByFoodQueryHandler)
    {
        $this->findBeerByFoodQueryHandler = $findBeerByFoodQueryHandler;
    }

    /**
     * @Route("/beer", name="app_find_beer", methods={"GET"})
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            ($this->findBeerByFoodQueryHandler)(FindBeerByFoodQuery::create('cru'))->getCatalogBeer(), 200
        );
    }
}