<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Update;

use Ramsey\Uuid\UuidInterface;

final class DepartmentUpdateInput
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private ?string $description,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
