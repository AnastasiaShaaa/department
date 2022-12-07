<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Module\Grade\Enum\GradeTypeEnum;

final class GradeType extends Type
{
    private const NAME = 'enum_grade_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof GradeTypeEnum ? $value->value : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?GradeTypeEnum
    {
        return is_string($value) ? GradeTypeEnum::tryFrom($value) : null;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
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
