<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\View;

use Department\Module\Grade\Model\Grade;

final class GradeViewPublicOutput implements GradeViewOutputInterface
{
    private Grade $grade;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->grade->getId(),
            'name' => $this->grade->getName(),
            'description' => $this->grade->getDescription(),
            'department' => $this->grade->getDepartment()->getName(),
        ];
    }

    public function setGrade(Grade $grade): void
    {
        $this->grade = $grade;
    }
}
