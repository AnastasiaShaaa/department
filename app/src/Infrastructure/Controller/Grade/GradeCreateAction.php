<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Grade;

use Department\Infrastructure\Collector\Grade\GradeCreateCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Grade\Handler\GradeCreateHandler;
use Department\Module\Grade\Handler\GradeCreateInput;
use Department\Module\Grade\Handler\GradeCreateOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GradeCreateAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private GradeCreateCollector $collector,
        private GradeCreateHandler $handler,
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

    protected function handle(GradeCreateInput $input): GradeCreateOutput
    {
        return $this->handler->handle($input);
    }

    protected function makeResponse(GradeCreateOutput $output): JsonResponse
    {
        return new JsonResponse([
            // TODO: что возвращать при создании
            'id' => $output->getId(),
            'message' => $output->getMessage(),
        ]);
    }
}
