<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\View;

use Department\Module\Department\Model\Department;
use Department\Module\Employee\Model\Employee;
use Department\Module\Grade\Model\Grade;
use Doctrine\Common\Collections\Collection;

final class DepartmentViewAuthorizeOutput implements DepartmentViewOutputInterface
{
    private Department $department;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->department->getId(),
            'name' => $this->department->getName(),
            'description' => $this->department->getDescription(),
            'grades' => $this->department->getGrades() ?
                $this->prepareGrades($this->department->getGrades()) :
                [],
            'employees' => $this->prepareGradesEmployees(),
        ];
    }

    private function prepareGrades(Collection $grades): array
    {
        return $grades->count() ?
            $grades->map(fn (Grade $grade) => $this->prepareGrade($grade))->toArray()
            : [];
    }

    private function prepareGrade(Grade $grade): array
    {
        return [
            'id' => $grade->getId(),
            'name' => $grade->getName()
        ];
    }

    private function prepareGradesEmployees(): array
    {
        $gradesEmployees = $this->department->getGrades()->map(
            fn (Grade $grade) => $grade->getEmployees()->count() ? $grade->getEmployees() : null
        );

        $gradesEmployees = $gradesEmployees->filter(fn (?Collection $employees) => !is_null($employees));

        $allEmployees = $gradesEmployees->map(
            fn (Collection $gradeEmployees) => $this->prepareGradeEmployees($gradeEmployees),
        );

        $allEmployees = $allEmployees->filter(fn ($employeeCollection) => !is_null($employeeCollection));

        $result['count'] = $count = $allEmployees->count();
        $result['items'] = $count ? $allEmployees->first() : [];

        return $result;
    }

    private function prepareGradeEmployees(Collection $employees): array
    {
        return $employees->map(
            fn (Employee $employee) => is_null($employee->getDeletedAt()) ?
                $this->prepareEmployee($employee) :
                null
        )->toArray();
    }

    private function prepareEmployee(Employee $employee): array
    {
        return [
            'id' => $employee->getId(),
            'fullName' => $employee->getFullName(),
        ];
    }

    public function setDepartment(Department $department): void
    {
        $this->department = $department;
    }
}
