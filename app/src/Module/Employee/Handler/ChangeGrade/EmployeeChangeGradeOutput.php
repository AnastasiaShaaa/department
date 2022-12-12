<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\ChangeGrade;

use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

final class EmployeeChangeGradeOutput implements JsonSerializable
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $gradeId,
        private UuidInterface $departmentId,
    ) {}

    public function jsonSerialize(): mixed
    {
        // TODO: what is return answer
        return [
            'id' => $this->id,
            'grade_id' => $this->gradeId,
            'department_id' => $this->departmentId,
        ];
    }
}
