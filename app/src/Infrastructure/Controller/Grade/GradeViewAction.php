<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Grade;

use Department\Infrastructure\Collector\Grade\GradeViewCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Grade\Handler\View\GradeViewHandler;
use Department\Module\Grade\Handler\View\GradeViewInput;
use Department\Module\Grade\Handler\View\GradeViewOutputInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

final class GradeViewAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private GradeViewCollector $collector,
        private GradeViewHandler $handler,
        private Security $security,
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

    protected function handle(GradeViewInput $input): GradeViewOutputInterface
    {
        return $this->handler->handle($input, (bool) $this->security->getUser());
    }
}
