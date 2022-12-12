<?php

declare(strict_types=1);

namespace Department\Module\Employee\Repository;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Model\Employee;
use Ramsey\Uuid\UuidInterface;

interface EmployeeRepositoryInterface
{
    public function isExist(Email $email): bool;

    public function findById(UuidInterface $id): ?Employee;

    public function findActiveById(UuidInterface $id): ?Employee;

    public function isDuplicate(Email $email, UuidInterface $id): bool;

    public function save(Employee $employee);
}
