<?php

declare(strict_types=1);

namespace Department\Module\Employee\Handler\AllList;

use Department\Module\Employee\Repository\EmployeeRepositoryInterface;

final class EmployeeListHandler
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
    ) {}

    public function handle(): EmployeeListOutput
    {
        $list = $this->findList();

        return $this->makeOutput($list);
    }

    private function findList(): array
    {
        return $this->employeeRepository->findList();
    }

    private function makeOutput(array $list): EmployeeListOutput
    {
        return new EmployeeListOutput(
            $list,
            count($list),
        );
    }
}
