<?php

declare(strict_types=1);

namespace Department\Module\Department\Handler\Update;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class DepartmentUpdateHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(DepartmentUpdateInput $input): DepartmentUpdateOutput
    {
        $department = $this->find($input->getId());
        $this->assertExistence($department);
        $this->assertUnique($input->getName(), $input->getId());
        $this->update($department, $input);
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

    private function assertUnique(string $name, UuidInterface $id): void
    {
        if ($this->departmentRepository->isDuplicate($name, $id)) {
            throw new DomainException('Department is duplicated');
        }
    }

    private function update(Department $department, DepartmentUpdateInput $input): void
    {
        $department->setName($input->getName());
        $department->setDescription($input->getDescription());
        $this->departmentRepository->save($department);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(): DepartmentUpdateOutput
    {
        return new DepartmentUpdateOutput(
            'Successful updating of department!',
        );
    }
}
