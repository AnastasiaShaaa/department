<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Department;

use Department\Infrastructure\Collector\Department\DepartmentDeleteCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Department\Handler\Delete\DepartmentDeleteHandler;
use Department\Module\Department\Handler\Delete\DepartmentDeleteInput;
use Department\Module\Department\Handler\Delete\DepartmentDeleteOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DepartmentDeleteAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private DepartmentDeleteCollector $collector,
        private DepartmentDeleteHandler $handler,
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

    protected function handle(DepartmentDeleteInput $input): DepartmentDeleteOutput
    {
        return $this->handler->handle($input);
    }

    protected function makeResponse(DepartmentDeleteOutput $output): JsonResponse
    {
        return new JsonResponse([
            // TODO: что возвращать при delete
            'message' => $output->getMessage(),
        ]);
    }
}
