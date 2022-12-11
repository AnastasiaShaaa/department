<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Department;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Department\Handler\Delete\DepartmentDeleteInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Ramsey\Uuid\Uuid as UuidEntity;

final class DepartmentDeleteCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): DepartmentDeleteInput
    {
        $requestData = $request->toArray();

        return new DepartmentDeleteInput(
            UuidEntity::fromString($requestData['id']),
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'id' => new Required([
                new Uuid(),
            ]),
        ]);
    }
}
