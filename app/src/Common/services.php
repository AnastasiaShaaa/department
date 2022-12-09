<?php

use Department\Infrastructure\Service\Security\CustomTokenManager;
use Department\Module\Auth\Service\TokenManagerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function(ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire();

    $services->set(CustomTokenManager::class)
//        ->arg('$expire', '%expire%');
        ->arg('$expire', 3600);

    $services
        ->alias(TokenManagerInterface::class, CustomTokenManager::class);
};