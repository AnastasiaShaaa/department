<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Employee;

use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Employee\Handler\ChangeGrade\EmployeeChangeGradeHandler;
use Department\Module\Employee\Handler\ChangeGrade\EmployeeChangeGradeInput;
use Department\Module\Employee\Handler\ChangeGrade\EmployeeChangeGradeOutput;
use Exception;
use Department\Infrastructure\Collector\Employee\EmployeeChangeGradeCollector;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class EmployeeChangeGradeAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private EmployeeChangeGradeCollector $collector,
        private EmployeeChangeGradeHandler $handler,
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

    protected function handle(EmployeeChangeGradeInput $input): EmployeeChangeGradeOutput
    {
        return $this->handler->handle($input);
    }
}
