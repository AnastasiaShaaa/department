<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\View;

use Common\Output\OutputInterface;
use Department\Module\Department\Model\Department;
use JsonSerializable;

interface DepartmentViewOutputInterface extends JsonSerializable, OutputInterface
{
    public function setDepartment(Department $department): void;
}
