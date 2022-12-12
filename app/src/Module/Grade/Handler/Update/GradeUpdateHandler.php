<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Update;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Department\Module\Grade\Model\Grade;
use Department\Module\Grade\Repository\GradeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class GradeUpdateHandler
{
    public function __construct(
        private GradeRepositoryInterface $gradeRepository,
        private DepartmentRepositoryInterface $departmentRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(GradeUpdateInput $input): GradeUpdateOutput
    {
        $department = $this->findDepartment($input->getDepartmentId());
        $this->assertExistenceDepartment($department);

        $grade = $this->findGrade($input->getId());
        $this->assertExistenceGrade($grade);

        $this->assertUnique($department, $input->getName(), $input->getId());

        $this->update($grade, $department, $input);
        $this->flush();

        return $this->makeOutput($grade);
    }

    private function findDepartment(UuidInterface $id): ?Department
    {
        return $this->departmentRepository->findById($id);
    }

    private function assertExistenceDepartment(?Department $department): void
    {
        if (!$department) {
            throw new DomainException('Department doesn\'t exist');
        }
    }

    private function findGrade(UuidInterface $id): ?Grade
    {
        return $this->gradeRepository->findById($id);
    }

    private function assertExistenceGrade(?Grade $grade): void
    {
        if (!$grade) {
            throw new DomainException('Grade doesn\'t exist');
        }
    }

    private function assertUnique(Department $department, string $name, UuidInterface $id): void
    {
        if ($this->gradeRepository->isDuplicate($department, $name, $id)) {
            throw new DomainException('Grade is duplicated');
        }
    }

    private function update(Grade $grade, Department $department, GradeUpdateInput $input): void
    {
        $grade->setName($input->getName());
        $grade->setSalary($input->getSalary());
        $grade->setDescription($input->getDescription());
        $grade->setInstruction($input->getInstruction());

        $grade->setDepartment($department);

        $this->departmentRepository->save($department);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(Grade $grade): GradeUpdateOutput
    {
        return new GradeUpdateOutput(
            $grade->getId(),
            $grade->getDepartment()->getId(),
            $grade->getName(),
            $grade->getSalary(),
            $grade->getDescription(),
            $grade->getInstruction(),
        );
    }
}
