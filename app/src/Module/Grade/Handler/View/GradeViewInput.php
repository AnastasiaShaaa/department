<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\View;

use Ramsey\Uuid\UuidInterface;

final class GradeViewInput
{
    public function __construct(
        private UuidInterface $id,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
