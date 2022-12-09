<?php

declare(strict_types=1);

namespace Department\Module\Auth\Handler\Login;

use Department\Module\Auth\Model\User;
use Department\Module\Auth\Service\TokenManagerInterface;
use Department\Module\Auth\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Department\Module\Auth\Service\PasswordHasherInterface;
use DomainException;

final class LoginHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private TokenManagerInterface $tokenManager,
        private PasswordHasherInterface $hasher,
        private EntityManagerInterface $em,
    ) {}

    public function handle(LoginInput $input): LoginOutput
    {
        $user = $this->findUser($input);
        $this->validatePassword($input, $user);
        $output = $this->makeResponse($user);
        // TODO: должно быть в событии
        $this->em->flush();
        return $output;
    }

    private function findUser(LoginInput $input): User
    {
        if (!$user = $this->userRepository->findByEmail($input->getEmail()->getValue())) {
            throw new DomainException('User not exist');
        }
        return $user;
    }

    private function validatePassword(LoginInput $input, User $user)
    {
        if (!$this->hasher->verify($user->getPassword(), $input->getPassword())) {
            throw new DomainException('Incorrect password');
        }
    }

    private function makeResponse(User $user): LoginOutput
    {
        $token = $this->tokenManager->makeToken($user);
        $refreshToken = $this->tokenManager->makeRefreshToken($user);

        return new LoginOutput($token, $refreshToken);
    }
}
