<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Repository;

use Department\Module\Department\Model\Department;
use Department\Module\Grade\Model\Grade;
use Department\Module\Grade\Repository\GradeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineGradeRepository implements GradeRepositoryInterface
{
    private EntityManagerInterface $em;
    private EntityRepository $entityRepository;

    public function __construct(
        EntityManagerInterface $em,
    ) {
        $this->em = $em;
        $this->entityRepository = $this->em->getRepository(Grade::class);
    }

    public function isExist(string $name, Department $department): bool
    {
        $qb = $this->entityRepository->createQueryBuilder('g');

        return $qb
                ->select('COUNT(g.id)')
                ->andWhere($qb->expr()->eq('g.name', ':name'))
                ->andWhere($qb->expr()->eq('g.department', ':department'))
                ->setParameters([
                    'name' => $name,
                    'department' => $department,
                ])
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    public function findById(UuidInterface $id): ?Grade
    {
        return $this->entityRepository->find($id);
    }

    public function isDuplicate(Department $department, string $name, UuidInterface $id): bool
    {
        $qb = $this->entityRepository->createQueryBuilder('g');

        return $qb
                ->select('COUNT(g.id)')
                ->andWhere($qb->expr()->eq('g.name', ':name'))
                ->andWhere($qb->expr()->eq('g.department', ':department'))
                ->andWhere($qb->expr()->neq('g.id', ':id'))
                ->setParameters([
                    'name' => $name,
                    'department' => $department,
                    'id' => $id,
                ])
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    public function findList(): array
    {
        $qb = $this->entityRepository->createQueryBuilder('g');

        return $qb
            ->select(['g.id', 'g.name', 'g.description'])
            ->getQuery()
            ->getArrayResult();
    }

    public function save(Grade $grade): void
    {
        $this->em->persist($grade);
    }

    public function remove(Grade $grade): void
    {
        $this->em->remove($grade);
    }
}
