<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Delete;

use Ramsey\Uuid\UuidInterface;

final class EmployeeDeleteInput
{
    public function __construct(
        private UuidInterface $id,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
