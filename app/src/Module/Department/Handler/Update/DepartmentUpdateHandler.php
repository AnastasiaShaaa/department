<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Update;

final class DepartmentUpdateHandler
{
    public function handle(DepartmentUpdateInput $input): DepartmentUpdateOutput
    {

        return $this->makeOutput();
    }

    private function makeOutput(): DepartmentUpdateOutput
    {
        return new DepartmentUpdateOutput();
    }
}
