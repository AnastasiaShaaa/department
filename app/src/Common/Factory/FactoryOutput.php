<?php

declare(strict_types=1);

namespace Common\Factory;

use Common\Output\Output;
use Common\Output\OutputInterface;
use Department\Module\Department\Handler\View\DepartmentViewAuthorizeOutput;
use Department\Module\Department\Handler\View\DepartmentViewOutputInterface;
use Department\Module\Employee\Handler\View\EmployeeViewAuthorizeOutput;
use Department\Module\Employee\Handler\View\EmployeeViewOutputInterface;
use Department\Module\Grade\Handler\View\GradeViewAuthorizeOutput;
use Department\Module\Grade\Handler\View\GradeViewOutputInterface;

final class FactoryOutput
{
    public static function makeOutput(bool $isAuthorized, string $class): OutputInterface
    {
        return $isAuthorized ? self::makeAuthorizedOutput($class) : self::makePublicOutput($class);
    }

    private static function makeAuthorizedOutput(string $class): ?OutputInterface
    {
        return match ($class) {
            DepartmentViewOutputInterface::class => new DepartmentViewAuthorizeOutput(),
            EmployeeViewOutputInterface::class => new EmployeeViewAuthorizeOutput(),
            GradeViewOutputInterface::class => new GradeViewAuthorizeOutput(),
            default => new Output(),
        };
    }

    private static function makePublicOutput(string $class): ?OutputInterface
    {
        return match ($class) {
            DepartmentViewOutputInterface::class => new DepartmentViewAuthorizeOutput(),
            EmployeeViewOutputInterface::class => new EmployeeViewAuthorizeOutput(),
            GradeViewOutputInterface::class => new GradeViewAuthorizeOutput(),
            default => new Output(),
        };
    }
}
