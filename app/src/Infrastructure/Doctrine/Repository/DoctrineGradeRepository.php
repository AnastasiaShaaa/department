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

    public function save(Grade $grade): void
    {
        $this->em->persist($grade);
    }
}
