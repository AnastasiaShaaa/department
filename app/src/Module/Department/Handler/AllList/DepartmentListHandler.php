<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\AllList;

use Department\Module\Department\Repository\DepartmentRepositoryInterface;

final class DepartmentListHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
    ) {}

    public function handle(): DepartmentListOutput
    {
        $list = $this->findList();

        return $this->makeOutput($list);
    }

    private function findList(): array
    {
        return $this->departmentRepository->findList();
    }

    private function makeOutput(array $list): DepartmentListOutput
    {
        return new DepartmentListOutput(
            $list,
            count($list),
        );
    }
}
