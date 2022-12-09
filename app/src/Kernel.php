<?php

namespace Department;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private function configureContainer(ContainerConfigurator $container): void
    {
        $configDir = $this->getConfigDir();

        $container->import("{$configDir}/{packages}/*.yaml");
        $container->import("{$configDir}/{packages}/{$this->environment}/*.yaml");
        $container->import("{$configDir}/services.php");
    }
//
//    protected function configureRoutes(RoutingConfigurator $routes): void
//    {
//        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
//        $routes->import('../config/{routes}/*.yaml');
//
//        if (is_file(\dirname(__DIR__).'/config/routes.yaml')) {
//            $routes->import('../config/routes.yaml');
//        } elseif (is_file($path = \dirname(__DIR__).'/config/routes.php')) {
//            (require $path)($routes->withPath($path), $this);
//        }
//    }
}
