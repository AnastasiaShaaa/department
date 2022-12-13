<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\View;

use Ramsey\Uuid\UuidInterface;

final class EmployeeViewInput
{
    public function __construct(
        private UuidInterface $id,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
