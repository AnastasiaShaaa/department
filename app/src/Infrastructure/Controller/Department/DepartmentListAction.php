<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Department;

use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Department\Handler\AllList\DepartmentListHandler;
use Department\Module\Department\Handler\AllList\DepartmentListOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class DepartmentListAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private DepartmentListHandler $handler,
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

    private function handle(): DepartmentListOutput
    {
        return $this->handler->handle();
    }
}
