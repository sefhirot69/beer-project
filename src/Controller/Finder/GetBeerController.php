<?php

declare(strict_types=1);

namespace App\Controller\Finder;

use App\BeerCatalog\Beer\Application\GetBeerQueryHandler;
use App\BeerCatalog\Shared\Domain\Exceptions\HttpClientException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetBeerController extends AbstractController
{
    public function __construct(private GetBeerQueryHandler $getBeerQueryHandler)
    {
    }

    #[Route('/beer', name: 'app_get_beer', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        try {
            $result = ($this->getBeerQueryHandler)();

            return new JsonResponse([], Response::HTTP_OK);
        } catch (HttpClientException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
