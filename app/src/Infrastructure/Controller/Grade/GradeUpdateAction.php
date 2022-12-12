<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Grade;

use Department\Infrastructure\Collector\Grade\GradeUpdateCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Grade\Handler\Update\GradeUpdateHandler;
use Department\Module\Grade\Handler\Update\GradeUpdateInput;
use Department\Module\Grade\Handler\Update\GradeUpdateOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GradeUpdateAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private GradeUpdateCollector $collector,
        private GradeUpdateHandler $handler,
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

    protected function handle(GradeUpdateInput $input): GradeUpdateOutput
    {
        return $this->handler->handle($input);
    }

    protected function makeResponse(GradeUpdateOutput $output): JsonResponse
    {
        return new JsonResponse([
            // TODO: что возвращать при update
            'message' => $output->getMessage(),
        ]);
    }
}
