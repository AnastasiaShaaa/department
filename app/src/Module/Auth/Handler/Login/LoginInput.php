<?php

declare(strict_types=1);

namespace Department\Module\Auth\Handler\Login;

use Department\Module\Employee\Field\Email;

final class LoginInput
{
    public function __construct(
        private string $email,
        private string $password,
    ) {}

    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
