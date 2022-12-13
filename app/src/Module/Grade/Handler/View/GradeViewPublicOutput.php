<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\View;

use Department\Module\Grade\Model\Grade;

final class GradeViewPublicOutput implements GradeViewOutputInterface
{
    public function __construct(
        private Grade $grade,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->grade->getId(),
            'name' => $this->grade->getName(),
            'description' => $this->grade->getDescription(),
            'department' => $this->grade->getDepartment()->getName(),
        ];
    }
}
