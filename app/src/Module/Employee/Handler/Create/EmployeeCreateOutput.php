<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Create;

use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

final class EmployeeCreateOutput implements JsonSerializable
{
    public function __construct(
        private UuidInterface $id,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
