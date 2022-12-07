<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Department\Module\Employee\Field\Phone;

final class PhoneType extends StringType
{
    private const NAME = 'phone_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Phone ? $value->getValue() : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Phone
    {
        return is_string($value) ? new Phone($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
