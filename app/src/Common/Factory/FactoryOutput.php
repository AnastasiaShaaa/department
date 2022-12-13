<?php

declare(strict_types=1);

namespace Department\Common\Factory;

use Department\Common\Output\Output;
use Department\Common\Output\OutputInterface;
use Department\Module\Department\Handler\View\DepartmentViewAuthorizeOutput;
use Department\Module\Department\Handler\View\DepartmentViewOutputInterface;
use Department\Module\Employee\Handler\View\EmployeeViewAuthorizeOutput;
use Department\Module\Employee\Handler\View\EmployeeViewOutputInterface;
use Department\Module\Grade\Handler\View\GradeViewAuthorizeOutput;
use Department\Module\Grade\Handler\View\GradeViewOutputInterface;

final class FactoryOutput
{
    public function makeOutput(bool $isAuthorized, string $class): OutputInterface
    {
        return $isAuthorized ? $this->makeAuthorizedOutput($class) : $this->makePublicOutput($class);
    }

    private function makeAuthorizedOutput(string $class): ?OutputInterface
    {
        return match ($class) {
            DepartmentViewOutputInterface::class => new DepartmentViewAuthorizeOutput(),
            EmployeeViewOutputInterface::class => new EmployeeViewAuthorizeOutput(),
            GradeViewOutputInterface::class => new GradeViewAuthorizeOutput(),
            default => new Output(),
        };
    }

    private function makePublicOutput(string $class): ?OutputInterface
    {
        return match ($class) {
            DepartmentViewOutputInterface::class => new DepartmentViewAuthorizeOutput(),
            EmployeeViewOutputInterface::class => new EmployeeViewAuthorizeOutput(),
            GradeViewOutputInterface::class => new GradeViewAuthorizeOutput(),
            default => new Output(),
        };
    }
}
