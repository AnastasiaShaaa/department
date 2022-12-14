<?php

use Department\Infrastructure\Service\Security\CustomTokenManager;
use Department\Module\Auth\Service\TokenManagerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function(ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire();

//    $services  ->defaults()
//        ->bind('int $expire', 3600);

    $services->set(CustomTokenManager::class)
        ->arg('int $expire', '%expire%');
//        ->args(['$expire'=> 3600]);

    $services
        ->alias(TokenManagerInterface::class, CustomTokenManager::class);

    $services
        ->load('Department\\Common\\Output\\', __DIR__ . '/Output/')
        ->load('Department\\Common\\Factory\\', __DIR__ . '/Factory/');
};