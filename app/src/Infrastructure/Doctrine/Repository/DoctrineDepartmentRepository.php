<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Repository;

use Department\Module\Department\Model\Department;
use Department\Module\Department\Repository\DepartmentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

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
            ->andWhere($qb->expr()->eq('d.name', ':d'))
            ->setParameter('name', $name)
            ->getQuery()
            ->getSingleResult() > 0;
    }
}
