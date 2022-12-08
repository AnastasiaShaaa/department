<?php

declare(strict_types=1);

namespace Department\Module\Auth\Repository;

use Department\Module\Auth\Model\UserToken;

interface UserTokenRepositoryInterface
{
    public function save(UserToken $token): void;
}
