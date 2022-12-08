<?php

declare(strict_types=1);

namespace Department\Common\Helper;

final class GenerateString
{
    public static function generate(int $strength = 32): string
    {
        return \hash('md5', \random_bytes($strength));
    }
}
