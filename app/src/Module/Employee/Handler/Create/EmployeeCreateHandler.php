<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Create;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Model\Employee;
use Department\Module\Employee\Repository\EmployeeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class EmployeeCreateHandler
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(EmployeeCreateInput $input): EmployeeCreateOutput
    {
        $this->assertExistence($input->getEmail());
        $employee = $this->makeEmployee($input);
        $this->save($employee);
        $this->flush();

        return $this->makeOutput($employee->getId());
    }

    private function makeEmployee(EmployeeCreateInput $input): Employee
    {
        return Employee::make(
            Uuid::uuid7(),
            $input->getFullName(),
            $input->getEmail(),
            $input->getPhone(),
            $input->getAge(),
            $input->getAddress(),
            $input->getExperience(),
        );
    }

    public function assertExistence(Email $email): void
    {
        if ($this->employeeRepository->isExist($email)) {
            throw new DomainException('Employee already exist');
        }
    }

    private function save(Employee $employee): void
    {
        $this->employeeRepository->save($employee);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(UuidInterface $id): EmployeeCreateOutput
    {
        return new EmployeeCreateOutput(
            $id,
        );
    }
}
