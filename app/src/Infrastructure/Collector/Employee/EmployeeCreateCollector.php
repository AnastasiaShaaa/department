<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Employee;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Employee\Handler\Create\EmployeeCreateInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class EmployeeCreateCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): EmployeeCreateInput
    {
        $requestData = $request->toArray();

        return new EmployeeCreateInput(
            $requestData['fullName'],
            $requestData['email'],
            $requestData['phone'],
            $requestData['age'],
            $requestData['address'],
            $requestData['experience'],
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'fullName' => new Required([
                new Length(['max' => 255]),
            ]),
            'email' => new Required([
                new Email(),
            ]),
            'phone' => new Required([
                new Length(['max' => 255]),
            ]),
            'age' => new Required([
                new Positive(),
            ]),
            // TODO: сделать необязательным поле и null по умолчанию
            'address' => new Optional([
                new Length(['max' => 255]),
            ]),
            'experience' => new Optional([
                new Length(['max' => 50]),
            ]),
        ]);
    }
}
