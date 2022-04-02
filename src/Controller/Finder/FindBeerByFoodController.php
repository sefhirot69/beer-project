<?php

declare(strict_types=1);

namespace App\Controller\Finder;

use App\BeerCatalog\Beer\Application\Find\FindBeerByFoodQueryHandlerInterface;
use App\BeerCatalog\Beer\Application\Find\Query\FindBeerByFoodQuery;
use App\BeerCatalog\Beer\Domain\Exceptions\BeersNotFoundException;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class FindBeerByFoodController extends AbstractController
{
    public function __construct(protected FindBeerByFoodQueryHandlerInterface $findBeerByFoodQueryHandler)
    {
    }

    #[Route('/beer/food/{request}', name: 'app_find_beer_by_food', methods: ['GET'])]
    public function __invoke(string|Request $request): JsonResponse
    {
        try {
            $catalog = ($this->findBeerByFoodQueryHandler)(FindBeerByFoodQuery::create($request));

            return new JsonResponse($catalog->getCatalogBeer(), Response::HTTP_OK);
        } catch (BeersNotFoundException|HttpClientException|InvalidArgumentException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        } catch (\Exception|\TypeError $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/beer/food/{request}/detail', name: 'app_find_beer_by_food_with_detail', methods: ['GET'])]
    public function withDetail(string|Request $request): JsonResponse
    {
        try {

            $catalog = ($this->findBeerByFoodQueryHandler)(FindBeerByFoodQuery::create($request, true));

            return new JsonResponse($catalog->getCatalogBeer(), Response::HTTP_OK);
        } catch (BeersNotFoundException|HttpClientException|InvalidArgumentException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        } catch (\Exception|\TypeError $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
