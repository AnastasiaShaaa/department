<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire();

    $services
        ->load('Department\\Module\\Department\\Handler\\', __DIR__ . '/Handler/')
        ->load('Department\\Module\\Department\\Repository\\', __DIR__ . '/Repository/');
};
