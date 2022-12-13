<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\AllList;

use JsonSerializable;

final class EmployeeListOutput implements JsonSerializable
{
    public function __construct(
        private array $data,
        private int $count,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'items' => $this->prepareEmployees(),
            'count' => $this->count,
        ];
    }

    private function prepareEmployees(): array
    {
        return array_map([$this, 'prepareEmployee'], $this->data);
    }

    private function prepareEmployee(array $employee): array
    {
        return [
            'id' => $employee['id'],
            'fullName' => $employee['fullname'],
            'grade' => $this->prepareGrade($employee),
            'department' => $this->prepareDepartment($employee),
        ];
    }

    private function prepareGrade(array $employee): array
    {
        return [
            'id' => $employee['grade_id'],
            'name' => $employee['grade_name'],
        ];
    }

    private function prepareDepartment(array $employee): array
    {
        return [
            'id' => $employee['department_id'],
            'name' => $employee['department_name'],
        ];
    }
}
