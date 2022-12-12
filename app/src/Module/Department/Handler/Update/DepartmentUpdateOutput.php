<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Update;

use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

final class DepartmentUpdateOutput implements JsonSerializable
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $description,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
