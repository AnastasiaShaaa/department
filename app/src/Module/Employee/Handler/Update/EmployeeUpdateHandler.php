<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Update;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Model\Employee;
use Department\Module\Employee\Repository\EmployeeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class EmployeeUpdateHandler
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(EmployeeUpdateInput $input): EmployeeUpdateOutput
    {
        $employee = $this->find($input->getId());
        $this->assertExistence($employee);
        $this->assertUnique($input->getEmail(), $input->getId());
        $this->update($employee, $input);
        $this->flush();

        return $this->makeOutput($employee);
    }

    private function find(UuidInterface $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
    }

    private function assertExistence(?Employee $employee): void
    {
        if (!$employee) {
            throw new DomainException('Employee doesn\'t exist');
        }
    }

    private function assertUnique(Email $email, UuidInterface $id): void
    {
        if ($this->employeeRepository->isDuplicate($email, $id)) {
            throw new DomainException('Employee is duplicated');
        }
    }

    private function update(Employee $employee, EmployeeUpdateInput $input): void
    {
        $employee->setEmail($input->getEmail());
        $employee->setAddress($input->getAddress());
        $employee->setExperience($input->getExperience());

        if ($input->getAge()) {
            $employee->setAge($input->getAge());
        }
        if ($input->getPhone()) {
            $employee->setPhone($input->getPhone());
        }
        if ($input->getFullName()) {
            $employee->setFullName($input->getFullName());
        }

        $this->employeeRepository->save($employee);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(Employee $employee): EmployeeUpdateOutput
    {
        return new EmployeeUpdateOutput(
            $employee->getId(),
            $employee->getFullName(),
            $employee->getEmail(),
            $employee->getPhone(),
            $employee->getAge(),
            $employee->getAddress(),
            $employee->getExperience(),
        );
    }
}
