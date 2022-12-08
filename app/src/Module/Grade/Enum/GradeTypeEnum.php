<?php

declare(strict_types=1);

namespace Department\Module\Grade\Enum;

enum GradeTypeEnum: string
{
    case SIMPLE = 'simple';
    case BOSS = 'boss';
}
