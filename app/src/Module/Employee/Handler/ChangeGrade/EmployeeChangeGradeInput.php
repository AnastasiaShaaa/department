<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\ChangeGrade;

use Ramsey\Uuid\UuidInterface;

final class EmployeeChangeGradeInput
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $gradeId,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getGradeId(): UuidInterface
    {
        return $this->gradeId;
    }
}
