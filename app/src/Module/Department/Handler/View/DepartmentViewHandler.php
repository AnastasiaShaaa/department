<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\View;

use Common\Factory\FactoryOutput;
use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class DepartmentViewHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
        private FactoryOutput $factoryOutput,
    ) {}

    public function handle(DepartmentViewInput $input, bool $isAuthorized = false): DepartmentViewOutputInterface
    {
        $department = $this->findDepartment($input->getId());
        $this->assertExistence($department);

        return $this->makeOutput($department, $isAuthorized);
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

    private function makeOutput(Department $department, bool $isAuthorized): DepartmentViewOutputInterface
    {
        /** @var DepartmentViewOutputInterface $output */
        $output = $this->factoryOutput->makeOutput($isAuthorized, DepartmentViewOutputInterface::class);
        $output->setDepartment($department);

        return $output;
    }
}
