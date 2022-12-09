<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire();

    $services
        ->load('Department\\Module\\Auth\\Handler\\', __DIR__ . '/Handler/')
        ->load('Department\\Module\\Auth\\Repository\\', __DIR__ . '/Repository/')
        ->load('Department\\Module\\Auth\\Service\\', __DIR__ . '/Service/');
};
