<?php

declare(strict_types=1);

namespace Department\Infrastructure\Controller;

use Department\Module\Auth\Handler\Login\LoginHandler;
use Department\Module\Auth\Handler\Login\LoginInput;
use Department\Infrastructure\Collector\LoginCollector;
use Department\Module\Auth\Handler\Login\LoginOutput;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LoginAction extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
        private LoginCollector $collector,
        private LoginHandler $handler,
    ) {}

    public function __invoke(Request $request): Response
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

    protected function execute(LoginInput $input): LoginOutput
    {
        return $this->handler->handle($input);
    }
}
