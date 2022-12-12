<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Employee;

use Department\Infrastructure\Collector\Employee\EmployeeUpdateCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Employee\Handler\Update\EmployeeUpdateHandler;
use Department\Module\Employee\Handler\Update\EmployeeUpdateInput;
use Department\Module\Employee\Handler\Update\EmployeeUpdateOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class EmployeeUpdateAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private EmployeeUpdateCollector $collector,
        private EmployeeUpdateHandler $handler,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->validate($request, $this->collector);
            $output = $this->handle($this->collectData($request, $this->collector));
            return $this->makeResponse($output);
        } catch (Exception $e) {
            // TODO: пока так, потом события
            return $this->reactOnError($this->logger, $e);
        }
    }

    protected function handle(EmployeeUpdateInput $input): EmployeeUpdateOutput
    {
        return $this->handler->handle($input);
    }
}
