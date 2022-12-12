<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Create;

use Ramsey\Uuid\UuidInterface;

final class GradeCreateInput
{
    public function __construct(
        private string $name,
        private UuidInterface $department_id,
        private int $salary,
        private ?string $description,
        private ?string $instruction,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDepartmentId(): UuidInterface
    {
        return $this->department_id;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }
}
