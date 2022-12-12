<?php

declare(strict_types=1);

namespace Department\Module\Auth\Handler\Login;

use JsonSerializable;

final class LoginOutput implements JsonSerializable
{
    public function __construct(
        private string $token,
        private string $refreshToken,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'token' => $this->token,
            'refresh' => $this->refreshToken,
        ];
    }
}
