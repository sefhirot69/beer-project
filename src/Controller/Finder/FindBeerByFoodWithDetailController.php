<?php

declare(strict_types=1);

namespace App\Controller\Finder;

use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class FindBeerByFoodWithDetailController extends FindBeerByFoodController
{
    /**
     * @Route("/beer/detail", name="app_find_beer_detail", methods={"GET"})
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $foodFilter = $request->query->get('food');

            $this->checkArgument($foodFilter);

            $catalog = ($this->findBeerByFoodQueryHandler)(FindBeerByFoodQuery::create($foodFilter, true));

            return new JsonResponse($catalog->getCatalogBeer(), Response::HTTP_OK);
        } catch (BeersNotFoundException|HttpClientException|\InvalidArgumentException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        } catch (\Exception|\TypeError $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
