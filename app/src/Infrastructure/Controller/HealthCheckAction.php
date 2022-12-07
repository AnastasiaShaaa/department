<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HealthCheckAction extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
//        dd('test');
        return new JsonResponse('test');
    }
}
