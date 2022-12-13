<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller\Department;

use Department\Infrastructure\Collector\Department\DepartmentViewCollector;
use Department\Infrastructure\Controller\AbstractController;
use Department\Module\Department\Handler\View\DepartmentViewHandler;
use Department\Module\Department\Handler\View\DepartmentViewInput;
use Department\Module\Department\Handler\View\DepartmentViewOutputInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

final class DepartmentViewAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private DepartmentViewCollector $collector,
        private DepartmentViewHandler $handler,
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

    protected function handle(DepartmentViewInput $input): DepartmentViewOutputInterface
    {
        return $this->handler->handle($input, (bool) $this->security->getUser());
    }
}
