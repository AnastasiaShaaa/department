<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Employee;

use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Employee\Handler\AllList\EmployeeListHandler;
use Department\Module\Employee\Handler\AllList\EmployeeListOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class EmployeeListAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private EmployeeListHandler $handler,
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

    private function handle(): EmployeeListOutput
    {
        return $this->handler->handle();
    }
}
