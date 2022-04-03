<?php

declare(strict_types=1);

namespace App\Controller\Finder;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetBeerController extends AbstractController
{
    public function __construct()
    {}

    #[Route('/beer', name: 'app_get_beer', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {

        return new JsonResponse([], Response::HTTP_OK);

    }

}
