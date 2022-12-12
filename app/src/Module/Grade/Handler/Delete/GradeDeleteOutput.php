<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Delete;

use JsonSerializable;

final class GradeDeleteOutput implements JsonSerializable
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
