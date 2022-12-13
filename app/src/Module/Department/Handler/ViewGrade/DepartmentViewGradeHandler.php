<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\ViewGrade;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class DepartmentViewGradeHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
    ) {}

    public function handle(DepartmentViewGradeInput $input): DepartmentViewGradeOutput
    {
        $department = $this->findDepartment($input->getId());
        $this->assertExistence($department);

        return $this->makeOutput($department);
    }

    private function findDepartment(UuidInterface $id): ?Department
    {
        return $this->departmentRepository->findById($id);
    }

    private function assertExistence(?Department $department): void
    {
        if (!$department) {
            throw new DomainException('Department doesn\'t exist');
        }
    }

    private function makeOutput(Department $department): DepartmentViewGradeOutput
    {
        return new DepartmentViewGradeOutput(
            $department,
        );
    }
}
