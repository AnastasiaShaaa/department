<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Department;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Department\Handler\Update\DepartmentUpdateInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Ramsey\Uuid\Uuid as UuidEntity;

final class DepartmentUpdateCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): DepartmentUpdateInput
    {
        $requestData = $request->toArray();

        return new DepartmentUpdateInput(
            UuidEntity::fromString($requestData['id']),
            $requestData['name'],
            $requestData['description'],
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'id' => new Required([
                new Uuid(),
            ]),
            'name' => new Optional([
                new Length(['max' => 100]),
                new NotBlank(),
            ]),
            // TODO: сделать необязательным поле и null по умолчанию
            'description' => new Optional([
                new Length(['max' => 100]),
            ]),
        ]);
    }
}
