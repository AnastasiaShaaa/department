<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\ViewGrade;

use Ramsey\Uuid\UuidInterface;

final class DepartmentViewGradeInput
{
    public function __construct(
        private UuidInterface $id,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
