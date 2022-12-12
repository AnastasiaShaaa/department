<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Update;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Field\Phone;
use Ramsey\Uuid\UuidInterface;

final class EmployeeUpdateInput
{
    public function __construct(
        private UuidInterface $id,
        private string $email,
        private ?string $fullName,
        private ?string $phone,
        private ?int $age,
        private ?string $address,
        private ?string $experience,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function getPhone(): ?Phone
    {
        return $this->phone ? new Phone($this->phone) : null;
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
}
