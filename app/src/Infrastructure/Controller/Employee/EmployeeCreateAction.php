<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Employee;

use Department\Infrastructure\Collector\Employee\EmployeeCreateCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Employee\Handler\Create\EmployeeCreateHandler;
use Department\Module\Employee\Handler\Create\EmployeeCreateInput;
use Department\Module\Employee\Handler\Create\EmployeeCreateOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class EmployeeCreateAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private EmployeeCreateCollector $collector,
        private EmployeeCreateHandler $handler,
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

    protected function handle(EmployeeCreateInput $input): EmployeeCreateOutput
    {
        return $this->handler->handle($input);
    }
}
