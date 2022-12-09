<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector;

use Department\Module\Auth\Handler\Login\LoginInput;
use PHPUnit\Util\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class LoginCollector
{
    public function __construct(
        protected ValidatorInterface $validator,
    ) {}

    public function collect(Request $request): LoginInput
    {
        // TODO: поправить получение параметров

        return new LoginInput(
            $request->toArray()['email'],
            $request->toArray()['password'],
        );
    }

    public function validate(Request $request): void
    {
        $errors = $this->validator->validate($this->getContent($request), $this->constraints());
//        dd($errors);
        if ($errors->count()) {
            throw new Exception('Invalid data');
        }
    }

    private function constraints(): Composite
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

    protected function getContent(Request $request): array
    {
        return array_merge(
            $request->query->all(),
            $request->toArray(),
            $request->files->all()
        );
    }
}
