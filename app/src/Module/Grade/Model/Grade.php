<?php

declare(strict_types=1);

namespace Department\Module\Grade\Model;

use DateTimeImmutable;
use Module\Grade\Enum\GradeTypeEnum;
use Ramsey\Uuid\Uuid;

class Grade
{
    public function __construct(
        private Uuid $id,
        private GradeTypeEnum $name,
        private int $salary,
        private ?string $description,
        private ?string $instruction,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): GradeTypeEnum
    {
        return $this->name;
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

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
