<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller;

use Department\Module\Auth\Handler\Refresh\RefreshHandler;
use Department\Module\Auth\Handler\Refresh\RefreshInput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RefreshAction extends AbstractController
{
    public function __construct(
        private RefreshHandler $handler,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $input = new RefreshInput($request);

        $result = $this->handler->handle($input);

        return new JsonResponse([
            'token' => $result->getToken(),
            'refresh' => $result->getRefreshToken(),
        ]);
    }
}
