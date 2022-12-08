<?php

declare(strict_types=1);

namespace Department\Module\Auth\Model;

use DateTimeImmutable;
use Department\Module\Employee\Field\Email;

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $id;
    private string $role;
    private string $password;
    private Email $email;
    private DateTimeImmutable $signupAt;
    private ?Collection $tokens = null;

    public static function signup(
        UuidInterface $id,
        string $role,
        DateTimeImmutable $signupAt,
        Email $email,
    ): self {
        $model = new self($id, $role, $signupAt);

        $model->email = $email;

        return $model;
    }

    public function __construct(
        UuidInterface $id,
        string $role,
        DateTimeImmutable $signupAt,
    ) {
        $this->id = $id;
        $this->role = $role;
        $this->signupAt = $signupAt;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function updateEmail(Email $email): void
    {
        if (!$this->email->equal($email)) {
            $this->email = $email;
        }
    }

    public function equals(self $user): bool
    {
        return $this->getId()->equals($user->getId());
    }
}
