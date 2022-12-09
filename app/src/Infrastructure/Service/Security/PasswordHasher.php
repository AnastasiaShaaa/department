<?php

declare(strict_types=1);

namespace Department\Infrastructure\Service\Security;

use Department\Module\Auth\Service\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface as SymfonyPasswordHasherInterface;

final class PasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private PasswordHasherFactoryInterface $factory,
    ) {}

    public function hash(string $password): string
    {
        return $this->getPasswordHasher()->hash($password);
    }

    public function verify(string $hash, string $password): bool
    {
        return $this->getPasswordHasher()->verify($hash, $password);
    }

    private function getPasswordHasher(): SymfonyPasswordHasherInterface
    {
        return $this->factory->getPasswordHasher(self::class);
    }


}