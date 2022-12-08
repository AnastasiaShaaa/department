<?php

declare(strict_types=1);

namespace Department\Module\Auth\Repository;

use Department\Module\Auth\Model\User;

interface UserRepositoryInterface
{
    public function find(string $email): ?User;
}
