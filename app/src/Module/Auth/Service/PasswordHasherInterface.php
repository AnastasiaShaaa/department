<?php

declare(strict_types=1);

namespace Department\Module\Auth\Service;

interface PasswordHasherInterface
{
    public function verify(string $hash, string $password): bool;
    public function hash(string $password): string;
}
