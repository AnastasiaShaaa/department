<?php

declare(strict_types=1);

namespace Department\Module\Employee\Field;

final class Phone
{
    private string $phone;

    public function __construct(
        string $phone,
    ) {
        $phone = preg_replace('/[^\d]/', '', $phone);
        if (empty($phone) || strlen($phone) > 16) {
            throw new \Exception('Incorrect value of phone');
        }
        $this->phone = $phone;
    }

    public function __toString(): string
    {
        return $this->phone;
    }

    public function getValue(): string
    {
        return $this->phone;
    }
}
