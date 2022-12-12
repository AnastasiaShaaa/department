<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\Update;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Field\Phone;
use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

final class EmployeeUpdateOutput implements JsonSerializable
{
    public function __construct(
        private UuidInterface $id,
        private string $fullName,
        private Email $email,
        private Phone $phone,
        private int $age,
        private ?string $address,
        private ?string $experience,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'email' => $this->email->getValue(),
            'fullName' => $this->fullName,
            'phone' => $this->phone->getValue(),
            'age' => $this->age,
            'address' => $this->address,
            'experience' => $this->experience,
        ];
    }
}
