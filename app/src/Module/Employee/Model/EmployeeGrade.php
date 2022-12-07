<?php

declare(strict_types=1);

namespace Department\Module\Employee\Model;

use Department\Module\Grade\Model\Grade;

class EmployeeGrade
{
    public function __construct(
        private int $id,
        private Grade $grade,
        private Employee $employee,
    ) {}

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function getGrade(): Grade
    {
        return $this->grade;
    }
}
