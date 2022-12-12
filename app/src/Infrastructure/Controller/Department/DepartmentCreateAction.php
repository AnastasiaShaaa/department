<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Department;

use Department\Common\Exception\ErrorException;
use Department\Infrastructure\Collector\AbstractCollector;
use Department\Infrastructure\Collector\Department\DepartmentCreateCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Department\Handler\Create\DepartmentCreateHandler;
use Department\Module\Department\Handler\Create\DepartmentCreateInput;
use Department\Module\Department\Handler\Create\DepartmentCreateOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DepartmentCreateAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private DepartmentCreateCollector $collector,
        private DepartmentCreateHandler $handler,
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

    protected function handle(DepartmentCreateInput $input): DepartmentCreateOutput
    {
        return $this->handler->handle($input);
    }

    protected function makeResponse(DepartmentCreateOutput $output): JsonResponse
    {
        return new JsonResponse([
            // TODO: что возвращать при создании
            'id' => $output->getId(),
            'message' => $output->getMessage(),
        ]);
    }
}
