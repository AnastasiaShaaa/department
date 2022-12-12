<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Delete;

final class GradeDeleteOutput
{
    public function __construct(
        private string $message,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }
}
