<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HealthCheck extends AbstractController
{
    /**
     * @Route("/healthcheck", name="app_healthcheck")
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {

        return $this->json([
            'status' => true
        ], Response::HTTP_OK);
    }

}