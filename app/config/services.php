<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function(ContainerConfigurator $configurator): void {
    // Register global simple value parameters
    $parameters = $configurator->parameters();
    $parameters
        ->set('expire', 30 * 86400);

    // Import project configuration
    $projectDirectory = dirname(__DIR__) . '/src';

    $configurator->import("{$projectDirectory}/Common/services.php");
    $configurator->import("{$projectDirectory}/Infrastructure/services.php");
    $configurator->import("{$projectDirectory}/Module/**/services.php");
};
