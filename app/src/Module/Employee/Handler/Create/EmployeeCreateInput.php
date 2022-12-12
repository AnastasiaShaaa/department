<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Create;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Field\Phone;

final class EmployeeCreateInput
{
    public function __construct(
        private string $fullName,
        private string $email,
        private string $phone,
        private int $age,
        private ?string $address,
        private ?string $experience,
    ) {}

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    public function getPhone(): Phone
    {
        return new Phone($this->phone);
    }

    public function getAge(): int
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
