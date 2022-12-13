<?php

declare(strict_types=1);

namespace Common\Output;

use JsonSerializable;

final class Output implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
}
