<?php

declare(strict_types=1);

namespace Department\Module\Department\Repository;

use Department\Module\Department\Model\Department;

interface DepartmentRepositoryInterface
{
    public function save(Department $department): void;

    public function isExist(string $name): bool;
}
