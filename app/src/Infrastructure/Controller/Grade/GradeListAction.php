<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Grade;

use Department\Infrastructure\Controller\AbstractController;
use Exception;
use Department\Module\Grade\Handler\AllList\GradeListHandler;
use Department\Module\Grade\Handler\AllList\GradeListOutput;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GradeListAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private GradeListHandler $handler,
    ) {}

    public function __invoke(): JsonResponse
    {
        try {
            $output = $this->handle();
            return $this->makeResponse($output);
        } catch (Exception $e) {
            // TODO: пока так, потом события
            return $this->reactOnError($this->logger, $e);
        }
    }

    private function handle(): GradeListOutput
    {
        return $this->handler->handle();
    }
}
