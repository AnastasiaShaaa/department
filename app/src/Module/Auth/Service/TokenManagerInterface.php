<?php

declare(strict_types=1);

namespace Department\Module\Auth\Service;

use Department\Module\Auth\Model\User;

interface TokenManagerInterface
{
    public function makeToken(User $user): string;
    public function makeRefreshToken(User $user): string;
}
