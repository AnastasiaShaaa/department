<?php

declare(strict_types=1);

namespace Department\Module\Department\Model;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Department
{
    private ?Collection $grades;

    public function __construct(
        private UuidInterface $id,
        private string $name,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
        private ?string $description,
    ) {
        $this->grades = new ArrayCollection();
    }

    public static function make(
        UuidInterface $id,
        string $name,
        ?string $description,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
    ): Department {
        return new Department(
          $id,
          $name,
        $createdAt ?? new DateTimeImmutable(),
        $updatedAt ?? new DateTimeImmutable(),
            $description,
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getName(): string
    {
        return $this->name;
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
