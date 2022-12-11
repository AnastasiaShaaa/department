<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Create;

final class DepartmentCreateInput
{
    public function __construct(
        private string $name,
        private ?string $description,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
