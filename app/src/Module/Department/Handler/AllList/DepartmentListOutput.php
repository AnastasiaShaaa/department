<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\AllList;

use JsonSerializable;

final class DepartmentListOutput implements JsonSerializable
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
