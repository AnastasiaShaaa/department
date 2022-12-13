<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\View;

use Common\Output\OutputInterface;
use Department\Module\Employee\Model\Employee;
use JsonSerializable;

interface EmployeeViewOutputInterface extends JsonSerializable, OutputInterface
{
    public function setEmployee(Employee $employee): void;
}
