<?php

declare(strict_types=1);

namespace Department\Module\Auth\Handler\Login;

final class LoginOutput
{
    public function __construct(
        private string $token,
        private string $refreshToken,
    ) {}

    public function getToken(): string
    {
        return $this->token;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}
