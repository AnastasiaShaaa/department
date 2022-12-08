<?php

declare(strict_types=1);

namespace Department\Infrastructure\Doctrine\Repository;

use Department\Module\Auth\Model\UserToken;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Department\Module\Auth\Repository\UserTokenRepositoryInterface;

final class DoctrineUserTokenRepository implements UserTokenRepositoryInterface
{
    private EntityManagerInterface $em;
    private EntityRepository $entityRepository;

    public function __construct(
        EntityManagerInterface $em,
    ) {
        $this->em = $em;
        $this->entityRepository = $em->getRepository(UserToken::class);
    }

    public function save(UserToken $token): void
    {
        $this->em->persist($token);
    }
}
