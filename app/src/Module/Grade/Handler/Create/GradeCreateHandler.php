<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Create;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Department\Module\Grade\Model\Grade;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Department\Module\Grade\Repository\GradeRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class GradeCreateHandler
{
    public function __construct(
        private GradeRepositoryInterface $gradeRepository,
        private DepartmentRepositoryInterface $departmentRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(GradeCreateInput $input): GradeCreateOutput
    {
        $department = $this->findDepartment($input->getDepartmentId());
        $this->assertExistenceDepartment($department);
        $this->assertExistenceGrade($input->getName(), $department);
        $grade = $this->makeGrade($input, $department);
        $this->save($grade);
        $this->flush();

        return $this->makeOutput($grade->getId());
    }

    public function assertExistenceGrade(string $name, Department $department): void
    {
        if ($this->gradeRepository->isExist($name, $department)) {
            throw new DomainException('Grade already exist');
        }
    }

    private function assertExistenceDepartment(?Department $department): void
    {
        if (!$department) {
            throw new DomainException('Department doesn\'t exist');
        }
    }

    private function makeGrade(GradeCreateInput $input, Department $department): Grade
    {
        return Grade::make(
            Uuid::uuid7(),
            $input->getName(),
            $input->getSalary(),
            $department,
            $input->getDescription(),
            $input->getInstruction(),
        );
    }

    private function findDepartment(UuidInterface $id): ?Department
    {
        return $this->departmentRepository->findById($id);
    }

    private function save(Grade $grade): void
    {
        $this->gradeRepository->save($grade);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(UuidInterface $uuid): GradeCreateOutput
    {
        return new GradeCreateOutput(
            $uuid->toString(),
        );
    }
}
