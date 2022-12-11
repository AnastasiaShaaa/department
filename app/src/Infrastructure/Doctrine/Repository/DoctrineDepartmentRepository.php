<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Repository;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineDepartmentRepository implements DepartmentRepositoryInterface
{
    private EntityManagerInterface $em;
    private EntityRepository $entityRepository;

    public function __construct(
        EntityManagerInterface $em,
    ) {
        $this->em = $em;
        $this->entityRepository = $this->em->getRepository(Department::class);
    }

    public function save(Department $department): void
    {
        $this->em->persist($department);
    }

    public function isExist(string $name): bool
    {
        $qb = $this->entityRepository->createQueryBuilder('d');

        return $qb
            ->select('COUNT(d.id)')
            ->andWhere($qb->expr()->eq('d.name', ':name'))
            ->setParameter('name', $name)
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }

    public function findById(UuidInterface $id): ?Department
    {
        return $this->entityRepository->find($id);
    }

    public function isDuplicate(string $name, UuidInterface $id): bool
    {
        $qb = $this->entityRepository->createQueryBuilder('d');

        return $qb
                ->select('COUNT(d.id)')
                ->andWhere($qb->expr()->eq('d.name', ':name'))
                ->andWhere($qb->expr()->neq('d.id', ':id'))
                ->setParameters([
                    'name' => $name,
                    'id' => $id,
                ])
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }
}
