<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Repository;

use Department\Module\Auth\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Department\Module\Auth\Repository\UserRepositoryInterface;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $em;
    private EntityRepository $entityRepository;

    public function __construct(
        EntityManagerInterface $em,
    ) {
        $this->em = $em;
        $this->entityRepository = $em->getRepository(User::class);
    }

    public function find(string $email): ?User
    {
        $qb = $this->entityRepository->createQueryBuilder('us');

        // TODO: поправить возврат ответа
        return $qb
            ->andWhere($qb->expr()->eq(':email', 'us.email'))
            ->setParameter('email', $email)
            ->getQuery()
            ->execute()[0];
    }
}
