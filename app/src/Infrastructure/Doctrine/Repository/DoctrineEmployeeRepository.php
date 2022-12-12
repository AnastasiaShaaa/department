<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Repository;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Model\Employee;
use Department\Module\Employee\Repository\EmployeeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineEmployeeRepository implements EmployeeRepositoryInterface
{
    private EntityManagerInterface $em;
    private EntityRepository $entityRepository;

    public function __construct(
        EntityManagerInterface $em,
    ) {
        $this->em = $em;
        $this->entityRepository = $this->em->getRepository(Employee::class);
    }

    public function isExist(Email $email): bool
    {
        $qb = $this->entityRepository->createQueryBuilder('e');

        return $qb
                ->select('COUNT(e.id)')
                ->andWhere($qb->expr()->eq('e.email', ':email'))
                ->setParameter('email', $email)
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    public function findById(UuidInterface $id): ?Employee
    {
        return $this->entityRepository->find($id);
    }

    public function isDuplicate(Email $email, UuidInterface $id): bool
    {
        $qb = $this->entityRepository->createQueryBuilder('e');

        return $qb
                ->select('COUNT(e.id)')
                ->andWhere($qb->expr()->eq('e.email', ':email'))
                ->andWhere($qb->expr()->neq('e.id', ':id'))
                ->setParameters([
                    'email' => $email,
                    'id' => $id,
                ])
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    public function save(Employee $employee)
    {
        $this->em->persist($employee);
    }
}
