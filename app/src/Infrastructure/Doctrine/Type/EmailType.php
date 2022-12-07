<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Department\Module\Employee\Field\Email;

final class EmailType extends StringType
{
    private const NAME = 'email_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Email ? $value->getValue() : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        return is_string($value) ? new Email($value) : null;
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
