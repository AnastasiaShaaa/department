<?php

declare(strict_types=1);

namespace Department\Module\Department\Repository;

use Department\Module\Department\Model\Department;
use Ramsey\Uuid\UuidInterface;

interface DepartmentRepositoryInterface
{
    public function isExist(string $name): bool;

    public function findById(UuidInterface $id): ?Department;

    public function isDuplicate(string $name, UuidInterface $id): bool;

    public function findList(): array;

    public function save(Department $department): void;

    public function remove(Department $department): void;
}
