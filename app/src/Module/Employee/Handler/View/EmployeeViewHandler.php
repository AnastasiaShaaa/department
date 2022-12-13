<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\View;

use Department\Module\Employee\Model\Employee;
use Department\Module\Employee\Repository\EmployeeRepositoryInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class EmployeeViewHandler
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
    ) {}

    public function handle(EmployeeViewInput $input, bool $isAuthorized = false): EmployeeViewOutputInterface
    {
        $employee = $this->findEmployee($input->getId());
        $this->assertExistence($employee);

        return $this->makeOutput($employee, $isAuthorized);
    }

    private function findEmployee(UuidInterface $id): ?Employee
    {
        return $this->employeeRepository->findActiveById($id);
    }

    private function assertExistence(?Employee $employee): void
    {
        if (!$employee) {
            throw new DomainException('Employee doesn\'t exist');
        }
    }

    private function makeOutput(Employee $employee, bool $isAuthorized): EmployeeViewOutputInterface
    {
        // TODO: Abstract Fabric ($isAuthorized, EmployeeViewOutputInterface::class)
        if ($isAuthorized) {
            return new EmployeeViewAuthorizeOutput(
                $employee,
            );
        }

        return new EmployeeViewPublicOutput(
            $employee,
        );
    }
}
