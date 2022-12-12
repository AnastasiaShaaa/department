<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Update;

use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

final class GradeUpdateOutput implements JsonSerializable
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $department_id,
        private string $name,
        private int $salary,
        private ?string $description,
        private ?string $instruction,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'department_id' => $this->department_id,
            'salary' => $this->salary,
            'description' => $this->description,
            'instruction' => $this->instruction,
        ];
    }
}
