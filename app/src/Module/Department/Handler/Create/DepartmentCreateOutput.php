<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Create;

final class DepartmentCreateOutput
{
    public function __construct(
        private string $id,
        private string $message,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
