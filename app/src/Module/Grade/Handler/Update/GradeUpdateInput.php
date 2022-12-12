<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Update;

use Ramsey\Uuid\UuidInterface;

final class GradeUpdateInput
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private UuidInterface $department_id,
        private int $salary,
        private ?string $description,
        private ?string $instruction,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }

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
