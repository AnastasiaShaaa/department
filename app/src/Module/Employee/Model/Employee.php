<?php

declare(strict_types=1);

namespace Department\Module\Employee\Model;

use DateTimeImmutable;
use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Field\Phone;
use Ramsey\Uuid\Uuid;

final class Employee
{
    public function __construct(
        private Uuid $id,
        private string $fullname,
        private Email $email,
        private ?Phone $phone,
        private ?int $age,
        private ?string $address,
        private ?string $experience,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->fullname;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPhone(): ?Phone
    {
        return $this->phone;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
