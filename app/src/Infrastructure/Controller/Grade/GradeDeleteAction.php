<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Grade;

use Department\Infrastructure\Collector\Grade\GradeDeleteCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Grade\Handler\Delete\GradeDeleteHandler;
use Department\Module\Grade\Handler\Delete\GradeDeleteInput;
use Department\Module\Grade\Handler\Delete\GradeDeleteOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GradeDeleteAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private GradeDeleteCollector $collector,
        private GradeDeleteHandler $handler,
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

    protected function handle(GradeDeleteInput $input): GradeDeleteOutput
    {
        return $this->handler->handle($input);
    }
}
