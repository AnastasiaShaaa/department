<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire();

    $services
        ->load('Department\\Module\\Auth\\Handler\\', __DIR__ . '/Handler/')
        ->load('Department\\Module\\Auth\\Repository\\', __DIR__ . '/Repository/')
        ->load('Department\\Module\\Auth\\Service\\', __DIR__ . '/Service/');

//    $services->load('Nutricology\\Module\\Profile\\Handler\\Dashboard\\Widget\\', __DIR__ . '/Handler/Dashboard/Widget/')
//        ->public();

//    $services
//        ->set(DashboardWidgetContainer::class)
//        ->arg('$container', service('service_container'));
//
//    $services
//        ->set(ProcessingStrategyContextInterface::class, ProcessingContext::class);
//
//    $services
//        ->set(MerchantInterface::class, Merchant::class)
//        ->arg('$key', env('CLOUDPAYMENT_API_PUBLIC_KEY'))
//        ->arg('$secret', env('CLOUDPAYMENT_API_KEY'));
//
//    $services
//        ->set(MerchantCollection::class)
//        ->arg('$merchants', [
//            service(MerchantInterface::class)
//        ]);
};
