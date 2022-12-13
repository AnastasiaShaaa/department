<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\View;

use Ramsey\Uuid\UuidInterface;

final class DepartmentViewInput
{
    public function __construct(
        private UuidInterface $id,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
