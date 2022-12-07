<?php

declare(strict_types=1);

namespace Department\Module\Employee\Field;

final class Email
{
    private string $email;

    public function __construct(
        string $email,
    ) {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Incorrect value of email');
        }
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function getValue(): string
    {
        return $this->email;
    }
}
