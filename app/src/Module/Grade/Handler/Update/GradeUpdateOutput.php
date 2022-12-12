<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Update;

final class GradeUpdateOutput
{
    public function __construct(
        private string $message,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }
}
