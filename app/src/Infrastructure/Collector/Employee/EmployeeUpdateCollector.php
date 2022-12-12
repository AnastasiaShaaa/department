<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Employee;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Employee\Handler\Update\EmployeeUpdateInput;
use Ramsey\Uuid\Uuid as UuidEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class EmployeeUpdateCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): EmployeeUpdateInput
    {
        $requestData = $request->toArray();

        return new EmployeeUpdateInput(
            UuidEntity::fromString($requestData['id']),
            $requestData['email'],
            $requestData['fullName'],
            $requestData['phone'],
            $requestData['age'],
            $requestData['address'],
            $requestData['experience'],
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'id' => new Required([
                new Uuid(),
            ]),
            'fullName' => new Optional([
                new Length(['max' => 255]),
                new NotBlank(),
            ]),
            'email' => new Required([
                new Email(),
            ]),
            'phone' => new Optional([
                new Length(['max' => 255]),
                new NotBlank(),
            ]),
            'age' => new Optional([
                new Positive(),
                new NotBlank(),
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
