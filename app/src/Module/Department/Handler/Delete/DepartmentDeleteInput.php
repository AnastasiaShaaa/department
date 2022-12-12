<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Delete;

use Ramsey\Uuid\UuidInterface;

final class DepartmentDeleteInput
{
    public function __construct(
        private UuidInterface $id,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
