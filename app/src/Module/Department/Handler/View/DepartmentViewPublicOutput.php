<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\View;

use Department\Module\Department\Model\Department;
use Department\Module\Grade\Model\Grade;

final class DepartmentViewPublicOutput implements DepartmentViewOutputInterface
{
    private Department $department;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->department->getId(),
            'name' => $this->department->getName(),
            'description' => $this->department->getDescription(),
            'grades' => $this->department->getGrades() ?
                $this->department->getGrades()->map(fn (Grade $grade) => $this->prepareGrade($grade))->toArray() :
                [],
        ];
    }

    private function prepareGrade(Grade $grade): string
    {
        return $grade->getName();
    }

    public function setDepartment(Department $department): void
    {
        $this->department = $department;
    }
}
