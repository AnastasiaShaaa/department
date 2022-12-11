<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Delete;

final class DepartmentDeleteOutput
{
    public function __construct(
        private string $message,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }
}
