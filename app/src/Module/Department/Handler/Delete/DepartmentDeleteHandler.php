<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Delete;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class DepartmentDeleteHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(DepartmentDeleteInput $input): DepartmentDeleteOutput
    {
        $department = $this->find($input->getId());
        $this->assertExistence($department);
        $this->remove($department);
        $this->flush();

        return $this->makeOutput();
    }

    private function find(UuidInterface $id): ?Department
    {
        return $this->departmentRepository->findById($id);
    }

    private function assertExistence(?Department $department): void
    {
        if (!$department) {
            throw new DomainException('Department doesn\'t exist');
        }
    }

    private function remove(Department $department): void
    {
        // TODO: возможно удаление должностей
        $this->departmentRepository->remove($department);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(): DepartmentDeleteOutput
    {
        return new DepartmentDeleteOutput(
            'Successful deleting of department!',
        );
    }
}
