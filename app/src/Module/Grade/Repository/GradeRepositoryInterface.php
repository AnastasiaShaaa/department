<?php

declare(strict_types=1);

namespace Department\Module\Grade\Repository;

use Department\Module\Department\Model\Department;
use Department\Module\Grade\Model\Grade;

interface GradeRepositoryInterface
{
    public function isExist(string $name, Department $department): bool;

    public function save(Grade $grade): void;
}
