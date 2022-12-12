<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Employee;

use Department\Infrastructure\Collector\Employee\EmployeeDeleteCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Employee\Handler\Delete\EmployeeDeleteHandler;
use Department\Module\Employee\Handler\Delete\EmployeeDeleteInput;
use Department\Module\Employee\Handler\Delete\EmployeeDeleteOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class EmployeeDeleteAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private EmployeeDeleteCollector $collector,
        private EmployeeDeleteHandler $handler,
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

    protected function handle(EmployeeDeleteInput $input): EmployeeDeleteOutput
    {
        return $this->handler->handle($input);
    }
}
