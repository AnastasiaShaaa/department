<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Create;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class DepartmentCreateHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(DepartmentCreateInput $input): DepartmentCreateOutput
    {
        $this->assertExistence($input->getName());
        $department = $this->makeDepartment($input);
        $this->save($department);
        $this->flush();

        return $this->makeOutput($department->getId());
    }

    private function makeDepartment(DepartmentCreateInput $input): Department
    {
        return Department::make(
            Uuid::uuid7(),
            $input->getName(),
            $input->getDescription(),
        );
    }

    public function assertExistence(string $name): void
    {
        if ($this->departmentRepository->isExist($name)) {
            throw new DomainException('Department already exist');
        }
    }

    private function save(Department $department): void
    {
        $this->departmentRepository->save($department);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(UuidInterface $id): DepartmentCreateOutput
    {
        return new DepartmentCreateOutput(
            $id,
        );
    }
}
