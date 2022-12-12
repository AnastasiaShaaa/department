<?php

declare(strict_types=1);

namespace Department\Module\Grade\Model;

use DateTimeImmutable;
use Department\Module\Department\Model\Department;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Grade
{
    private ?Collection $employees;

    public function __construct(
        private UuidInterface $id,
        private string $name,
        private int $salary,
        private Department $department,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
        private ?string $description,
        private ?string $instruction,
    ) {
        $this->employees = new ArrayCollection();
    }

    public static function make(
        UuidInterface $id,
        string $name,
        int $salary,
        Department $department,
        ?string $description,
        ?string $instruction,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
    ): Grade {
        return new Grade(
            $id,
            $name,
            $salary,
            $department,
            $createdAt ?? new DateTimeImmutable(),
            $updatedAt ?? new DateTimeImmutable(),
            $description,
            $instruction,
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
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

    public function getDepartment(): Department
    {
        return $this->department;
    }
}
