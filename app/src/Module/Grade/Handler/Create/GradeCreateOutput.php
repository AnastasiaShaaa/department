<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Create;

use JsonSerializable;

final class GradeCreateOutput implements JsonSerializable
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
