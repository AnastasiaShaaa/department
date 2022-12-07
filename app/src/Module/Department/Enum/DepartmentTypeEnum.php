<?php

declare(strict_types=1);

namespace Department\Module\Department\Enum;

enum DepartmentTypeEnum: string
{
    case MARKETING = 'marketing';
    case DEVELOPMENT = 'development';
    case ACCOUNTING = 'accounting';
}
