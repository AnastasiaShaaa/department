<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller;

use Department\Common\Exception\ErrorException;
use Exception;
use Department\Infrastructure\Collector\AbstractCollector;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    protected function validate(Request $request, AbstractCollector $collector): void
    {
        $collector->validate($request);
    }

    protected function collectData(Request $request, AbstractCollector $collector): mixed
    {
        return $collector->collect($request);
    }

    protected function reactOnError(LoggerInterface $logger, Exception $e): JsonResponse
    {
        $logger->error(new ErrorException($e));

        return new JsonResponse([
            'message' => $e->getMessage(),
        ]);
    }
}
