<?php

declare(strict_types=1);

namespace Department\Module\Grade\Repository;

use Department\Module\Department\Model\Department;
use Department\Module\Grade\Model\Grade;
use Ramsey\Uuid\UuidInterface;

interface GradeRepositoryInterface
{
    public function isExist(string $name, Department $department): bool;

    public function findById(UuidInterface $id): ?Grade;

    public function isDuplicate(Department $department, string $name, UuidInterface $id): bool;

    public function findList(): array;

    public function save(Grade $grade): void;

    public function remove(Grade $grade): void;
}
