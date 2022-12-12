<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Create;

use JsonSerializable;

final class DepartmentCreateOutput implements JsonSerializable
{
    public function __construct(
        private string $id,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
