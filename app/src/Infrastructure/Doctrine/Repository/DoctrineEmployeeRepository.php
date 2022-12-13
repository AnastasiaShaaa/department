<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Repository;

use Department\Module\Employee\Field\Email;
use Department\Module\Employee\Model\Employee;
use Department\Module\Employee\Repository\EmployeeRepositoryInterface;
use Doctrine\ORM\AbstractQuery;
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

    public function findActiveById(UuidInterface $id): ?Employee
    {
        $qb = $this->entityRepository->createQueryBuilder('e');

        return $qb
            ->andWhere($qb->expr()->eq('e.id', ':id'))
            ->andWhere($qb->expr()->isNull('e.deletedAt'))
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult(AbstractQuery::HYDRATE_OBJECT);
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

    public function findList(): array
    {
        $qb = $this->em->getConnection()->createQueryBuilder();

        return $qb
            ->select([
                'e.id',
                'e.fullname',
                'g.id AS grade_id',
                'g.name AS grade_name',
                'd.id AS department_id',
                'd.name AS department_name',
            ])
            ->from('employees', 'e')
            ->leftJoin('e', 'grades', 'g', 'e.grade_id = g.id')
            ->leftJoin('g', 'departments', 'd', 'g.department_id = d.id')
            ->andWhere($qb->expr()->isNull('e.deleted_at'))
            ->fetchAllAssociative();
    }

    public function save(Employee $employee)
    {
        $this->em->persist($employee);
    }
}
