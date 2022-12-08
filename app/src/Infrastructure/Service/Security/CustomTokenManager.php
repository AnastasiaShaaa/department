<?php

declare(strict_types=1);

namespace Department\Infrastructure\Service\Security;

use Department\Common\Helper\GenerateString;
use Department\Module\Auth\Model\User;
use Department\Module\Auth\Model\UserToken;
use Department\Module\Auth\Service\TokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Department\Module\Auth\Repository\UserTokenRepositoryInterface;

final class CustomTokenManager implements TokenManagerInterface
{
    public function __construct(
        private JWTTokenManagerInterface $tokenManager,
        private UserTokenRepositoryInterface $tokenRepository,
        private int $expire,
    ) {}

    public function makeToken(User $user): string
    {
        return $this->tokenManager->create(
            new JWTUser(
                $user->getId()->toString(),
                $user->getRoles()
            )
        );
    }

    public function makeRefreshToken(User $user): string
    {
        $token = UserToken::refreshToken(
            $user,
            GenerateString::generate(),
            $this->expire,
        );

        $this->tokenRepository->save($token);

        return $token->getToken();
    }
}
