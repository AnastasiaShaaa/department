<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\ChangeGrade;

use Department\Module\Department\Model\Department;
use Department\Module\Employee\Model\Employee;
use Department\Module\Grade\Model\Grade;
use Ramsey\Uuid\UuidInterface;

final class EmployeeChangeGradeHandler
{
    public function handle(EmployeeChangeGradeInput $input): EmployeeChangeGradeOutput
    {
        $employee = $this->findEmployee($input->getId());
        $this->assertExistenceEmployee($employee);

        $grade = $this->findGrade($input->getGradeId(), $input->getDepartmentId());

        if (!$grade) {
            $department = $this->findDepartment($input->getDepartmentId());
            $this->assertExistenceDepartment($department);

            $grade = $this->makeGrade($department);
        }

        $this->updateGrade($employee, $grade);

        $this->flush();

        return $this->makeOutput($input);
    }

    private function makeOutput(EmployeeChangeGradeInput $input): EmployeeChangeGradeOutput
    {
        return new EmployeeChangeGradeOutput(
            $input->getId(),
            $input->getGradeId(),
            $input->getDepartmentId()
        );
    }

    private function findEmployee(UuidInterface $id): ?Employee
    {
    }

    private function findGrade(UuidInterface $id): ?Grade
    {
    }

    private function findDepartment(?UuidInterface $id): ?Department
    {
    }
}
