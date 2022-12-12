<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector;

use Department\Module\Auth\Handler\Login\LoginInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class LoginCollector extends AbstractCollector
{
    // TODO: as basil
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): LoginInput
    {
        // TODO: поправить получение параметров

        return new LoginInput(
            $request->toArray()['email'],
            $request->toArray()['password'],
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'email' => [
                new NotBlank(),
                new Email(),
            ],
            'password' => [
                new NotBlank(),
            ],
        ]);
    }
}
