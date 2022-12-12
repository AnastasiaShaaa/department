<?php

declare(strict_types=1);

namespace Department\Module\Employee\Model;

use DateTimeImmutable;
use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Field\Phone;
use Department\Module\Grade\Model\Grade;
use Ramsey\Uuid\UuidInterface;

final class Employee
{
    private ?Grade $grade = null;

    public function __construct(
        private UuidInterface $id,
        private string $fullname,
        private Email $email,
        private Phone $phone,
        private int $age,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
        private ?string $address,
        private ?string $experience,
    ) {}

    public static function make(
        UuidInterface $id,
        string $fullname,
        Email $email,
        Phone $phone,
        int $age,
        ?string $address,
        ?string $experience,
        DateTimeImmutable $createdAt = null,
        DateTimeImmutable $updatedAt = null,
    ): Employee {
        return new Employee(
            $id,
            $fullname,
            $email,
            $phone,
            $age,
            $createdAt ?? new DateTimeImmutable(),
            $updatedAt ?? new DateTimeImmutable(),
            $address,
            $experience,
        );
    }

    public function getId(): UuidInterface
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

    public function getPhone(): Phone
    {
        return $this->phone;
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

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getGrade(): ?Grade
    {
        return $this->grade;
    }

    public function setGrade(?Grade $grade): void
    {
        $this->grade = $grade;
    }
}
