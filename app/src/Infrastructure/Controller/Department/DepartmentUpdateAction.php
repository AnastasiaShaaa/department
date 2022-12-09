<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Department;

use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Department\Handler\Update\DepartmentUpdateOutput;
use Exception;
use Department\Infrastructure\Collector\Department\DepartmentUpdateCollector;
use Department\Module\Department\Handler\Update\DepartmentUpdateHandler;
use Department\Module\Department\Handler\Update\DepartmentUpdateInput;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DepartmentUpdateAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private DepartmentUpdateCollector $collector,
        private DepartmentUpdateHandler $handler,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->validate($request, $this->collector);
            $output = $this->execute($this->collectData($request, $this->collector));
            return $this->makeResponse($output);
        } catch (Exception $e) {
            // TODO: пока так, потом события
            return $this->reactOnError($this->logger, $e);
        }
    }

    protected function execute(DepartmentUpdateInput $input): DepartmentUpdateOutput
    {
        return $this->handler->handle($input);
    }

    protected function makeResponse(DepartmentUpdateOutput $output): JsonResponse
    {
        return new JsonResponse([
//            'id' => $output->getId(),
        ]);
    }
}
