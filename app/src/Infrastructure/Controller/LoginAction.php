<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller;

use Department\Module\Auth\Handler\Login\LoginHandler;
use Department\Module\Auth\Handler\Login\LoginInput;
use Department\Infrastructure\Collector\LoginCollector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class LoginAction extends AbstractController
{
    public function __construct(
        private LoginHandler $handler,
        private LoginCollector $collector,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->validate($request);

            $result = $this->handler->handle($this->collectData($request));
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Failed authorization',
                'detail' => $e->getMessage(), // TODO: лучше в лог
            ]);
        }

        return new JsonResponse([
            'token' => $result->getToken(),
            'refresh' => $result->getRefreshToken(),
        ]);
    }

    private function validate(Request $request): void
    {
        $this->collector->validate($request);
    }

    private function collectData(Request $request): LoginInput
    {
        return $this->collector->collect($request);
    }
}
