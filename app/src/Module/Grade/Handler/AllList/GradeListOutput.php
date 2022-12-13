<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\AllList;

use JsonSerializable;

final class GradeListOutput implements JsonSerializable
{
    public function __construct(
        private array $data,
        private int $count,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'items' => $this->data,
            'count' => $this->count,
        ];
    }
}
