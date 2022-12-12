<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Delete;

use DateTimeImmutable;
use Department\Module\Employee\Model\Employee;
use Department\Module\Employee\Repository\EmployeeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class EmployeeDeleteHandler
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(EmployeeDeleteInput $input): EmployeeDeleteOutput
    {
        $employee = $this->find($input->getId());
        $this->assertExistence($employee);
        $this->remove($employee);
        $this->flush();

        return $this->makeOutput($input->getId());
    }

    private function find(UuidInterface $id): ?Employee
    {
        return $this->employeeRepository->findActiveById($id);
    }

    private function assertExistence(?Employee $employee): void
    {
        if (!$employee) {
            throw new DomainException('Employee doesn\'t exist');
        }
    }

    private function remove(Employee $employee): void
    {
        $employee->setDeletedAt(new DateTimeImmutable());
        $employee->setGrade(null);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(UuidInterface $id): EmployeeDeleteOutput
    {
        return new EmployeeDeleteOutput(
            $id,
        );
    }
}
