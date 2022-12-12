<?php

declare(strict_types=1);

namespace Department\Module\Employee\Repository;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Model\Employee;

interface EmployeeRepositoryInterface
{
    public function isExist(Email $email): bool;

    public function save(Employee $employee);
}
