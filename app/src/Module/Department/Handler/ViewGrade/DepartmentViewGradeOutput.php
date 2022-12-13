<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\ViewGrade;

use Department\Module\Department\Model\Department;
use Department\Module\Grade\Model\Grade;
use Doctrine\Common\Collections\Collection;
use JsonSerializable;

final class DepartmentViewGradeOutput implements JsonSerializable
{
    public function __construct(
        private Department $department,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->department->getId(),
            'grades' => $this->department->getGrades() ?
                $this->prepareGrades($this->department->getGrades()) :
                [],
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
}
