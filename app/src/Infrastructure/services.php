<?php

use Department\Infrastructure\Doctrine\Repository\DoctrineDepartmentRepository;
use Department\Infrastructure\Doctrine\Repository\DoctrineGradeRepository;
use Department\Infrastructure\Doctrine\Repository\DoctrineUserRepository;
use Department\Infrastructure\Doctrine\Repository\DoctrineUserTokenRepository;
use Department\Infrastructure\Service\Security\PasswordHasher;
use Department\Module\Auth\Repository\UserRepositoryInterface;
use Department\Module\Auth\Repository\UserTokenRepositoryInterface;
use Department\Module\Auth\Service\PasswordHasherInterface;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Department\Module\Grade\Repository\GradeRepositoryInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire();

//    $services
//        ->load('Department\\Infrastructure\\Messenger\\', __DIR__ . '/Messenger/')
//        ->autoconfigure();

    // Controllers
    $services
        ->load('Department\\Infrastructure\\Controller\\', __DIR__ . '/Controller/')
        ->tag('controller.service_arguments')
        ->autoconfigure();

    $services
        ->load('Department\\Infrastructure\\Collector\\', __DIR__ . '/Collector/')
        ->tag('collector.service_arguments')
        ->autoconfigure();

    $services
        ->load('Department\\Infrastructure\\Doctrine\\Repository\\', __DIR__ . '/Doctrine/Repository/')
        ->tag('repository.service_arguments')
        ->autoconfigure();

    $services
        ->load('Department\\Infrastructure\\Service\\Security\\', __DIR__ . '/Service/Security/')
        ->tag('service.security.service_arguments')
        ->autoconfigure();

    $services
        ->alias(UserRepositoryInterface::class, DoctrineUserRepository::class)
        ->alias(UserTokenRepositoryInterface::class, DoctrineUserTokenRepository::class)
        ->alias(DepartmentRepositoryInterface::class, DoctrineDepartmentRepository::class)
        ->alias(GradeRepositoryInterface::class, DoctrineGradeRepository::class)
        ->alias(PasswordHasherInterface::class, PasswordHasher::class);
};
