<?php

declare(strict_types=1);

namespace Department\Module\Department\Model;

use DateTimeImmutable;
use Department\Module\Department\Enum\DepartmentTypeEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

class Department
{
    private ?Collection $grades;

    public function __construct(
        private Uuid $id,
        private DepartmentTypeEnum $name,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
        private ?string $description,
    ) {
        $this->grades = new ArrayCollection();
    }

    public static function make(
        Uuid $id,
        DepartmentTypeEnum $name,
        ?string $description,
        ?DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt,
    ): Department {
        return new Department(
          $id,
          $name,
        $createdAt ?? new DateTimeImmutable(),
        $updatedAt ?? new DateTimeImmutable(),
            $description,
        );
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getName(): DepartmentTypeEnum
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
