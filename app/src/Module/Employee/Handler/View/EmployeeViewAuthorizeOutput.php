<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\View;

use Department\Module\Employee\Model\Employee;

final class EmployeeViewAuthorizeOutput implements EmployeeViewOutputInterface
{
    public function __construct(
        private Employee $employee,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->employee->getId(),
            'fullName' => $this->employee->getFullName(),
            'grade' => $this->employee->getGrade()->getName(),
            'department' => $this->employee->getGrade()->getDepartment()->getName(),
            'email' => $this->employee->getEmail()->getValue(),
            'age' => $this->employee->getAge(),
            'salary' => $this->employee->getGrade()->getSalary(), // TODO: Price type
            'address' => $this->employee->getAddress(),
            'experience' => $this->employee->getExperience(),
            'phone' => $this->employee->getPhone()->getValue(),
        ];
    }
}
