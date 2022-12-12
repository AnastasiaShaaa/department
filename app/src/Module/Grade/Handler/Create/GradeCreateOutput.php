<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Create;

final class GradeCreateOutput
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
