<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Department\Module\Department\Enum\DepartmentTypeEnum;

final class DepartmentType extends Type
{
    private const NAME = 'enum_department_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof DepartmentTypeEnum ? $value->value : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?DepartmentTypeEnum
    {
        return is_string($value) ? DepartmentTypeEnum::tryFrom($value) : null;
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
