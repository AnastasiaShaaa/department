<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\View;

use Department\Module\Employee\Model\Employee;
use Department\Module\Grade\Model\Grade;
use Doctrine\Common\Collections\Collection;

final class GradeViewAuthorizeOutput implements GradeViewOutputInterface
{
    private Grade $grade;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->grade->getId(),
            'name' => $this->grade->getName(),
            'description' => $this->grade->getDescription(),
            'department' => $this->grade->getDepartment()->getName(),
            'instruction' => $this->grade->getInstruction(),
            'salary' => $this->grade->getSalary(), // TODO: Price Type
            'employees' => $this->grade->getEmployees() ?
                $this->prepareEmployees($this->grade->getEmployees()) :
                [],
        ];
    }

    private function prepareEmployees(Collection $employees): array
    {
        $employees = $employees->filter(fn (Employee $employee) => is_null($employee->getDeletedAt()));

        $result['count'] = $count = $employees->count();
        $result['items'] = $count ?
            $employees->map(fn (Employee $employee) => $this->prepareEmployee($employee))->toArray() :
            [];

        return $result;
    }

    private function prepareEmployee(Employee $employee): array
    {
        return [
            'id' => $employee->getId(),
            'fullName' => $employee->getFullName(),
        ];
    }

    public function setGrade(Grade $grade): void
    {
        $this->grade = $grade;
    }
}
