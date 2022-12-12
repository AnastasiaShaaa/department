<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\ChangeGrade;

use Department\Module\Department\Model\Department;
use Department\Module\Employee\Model\Employee;
use Department\Module\Employee\Repository\EmployeeRepositoryInterface;
use Department\Module\Grade\Model\Grade;
use Department\Module\Grade\Repository\GradeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class EmployeeChangeGradeHandler
{
    public function __construct(
        private EntityManagerInterface $em,
        private EmployeeRepositoryInterface $employeeRepository,
        private GradeRepositoryInterface $gradeRepository,
    ) {}

    public function handle(EmployeeChangeGradeInput $input): EmployeeChangeGradeOutput
    {
        $employee = $this->findEmployee($input->getId());
        $this->assertExistenceEmployee($employee);

        $grade = $this->findGrade($input->getGradeId());
        $this->assertExistenceGrade($grade);

        $this->updateEmployeeGrade($employee, $grade);

        $this->flush();

        return $this->makeOutput($input);
    }

    private function findEmployee(UuidInterface $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
    }

    private function findGrade(UuidInterface $id): ?Grade
    {
        return $this->gradeRepository->findById($id);
    }

    private function assertExistenceEmployee(?Employee $employee): void
    {
        if (!$employee) {
            throw new DomainException('Employee doesn\'t exist');
        }
    }

    private function assertExistenceGrade(?Grade $grade): void
    {
        if (!$grade) {
            throw new DomainException('Grade doesn\'t exist');
        }
    }

    private function updateEmployeeGrade(?Employee $employee, ?Grade $grade)
    {
        $employee->setGrade($grade);
    }

    private function flush()
    {
        $this->em->flush();
    }

    private function makeOutput(EmployeeChangeGradeInput $input): EmployeeChangeGradeOutput
    {
        return new EmployeeChangeGradeOutput(
            $input->getId(),
            $input->getGradeId(),
        );
    }
}
