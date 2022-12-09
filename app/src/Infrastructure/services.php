
return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
    ->defaults()
    ->autowire();

    $services
    ->load('Nutricology\\Infrastructure\\EventSubscriber\\', __DIR__ . '/EventSubscriber/')
    ->tag('kernel.event_subscriber');

    $services
    ->set(AppHelpEventSubscriber::class)
    ->tag('kernel.event_subscriber')
    ->args([
    '$infoEmail' => '%env(MAILER_SUPPORT)%',
    ]);

    $services
    ->load('Nutricology\\Infrastructure\\Messenger\\', __DIR__ . '/Messenger/')
    ->autoconfigure();

    // Middleware configuration
    $services->set(DatabaseErrorHandler::class)->public();
    $services->set(HttpErrorHandler::class)->public();
    $services->set(ValidateErrorHandler::class)->public();

    $services->set(PersistenceFlushMiddleware::class)->public();

    $services
    ->set(ErrorMiddleware::class)
    ->public()
    ->args([
    '$logger' => service('logger'),
    '$container' => service('service_container'),
    '$translator' => service('translator'),
    '$handlers' => [
    HttpErrorHandler::class,
    ValidateErrorHandler::class,
    DatabaseErrorHandler::class,
    ],
    ]);

    $services
    ->set(MiddlewareKernelSubscriber::class)
    ->tag('kernel.event_subscriber')
    ->args([
    '$container' => service('service_container'),
    '$defaultMiddlewares' => [
    ErrorMiddleware::class,
    ],
    ]);

    // Controllers and commands
    $services
    ->load('Nutricology\\Infrastructure\\Controller\\', __DIR__ . '/Controller/')
    ->tag('controller.service_arguments')
    ->autoconfigure();
}