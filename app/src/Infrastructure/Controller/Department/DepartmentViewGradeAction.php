<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Department;

use Department\Infrastructure\Collector\Department\DepartmentViewGradeCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Department\Handler\ViewGrade\DepartmentViewGradeHandler;
use Department\Module\Department\Handler\ViewGrade\DepartmentViewGradeInput;
use Department\Module\Department\Handler\ViewGrade\DepartmentViewGradeOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DepartmentViewGradeAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private DepartmentViewGradeCollector $collector,
        private DepartmentViewGradeHandler $handler,
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

    protected function handle(DepartmentViewGradeInput $input): DepartmentViewGradeOutput
    {
        return $this->handler->handle($input);
    }
}
