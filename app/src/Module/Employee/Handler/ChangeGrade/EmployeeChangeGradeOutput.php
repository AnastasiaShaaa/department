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
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'grade_id' => $this->gradeId,
        ];
    }
}
