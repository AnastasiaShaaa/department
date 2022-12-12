<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Employee;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Employee\Handler\Delete\EmployeeDeleteInput;
use Ramsey\Uuid\Uuid as UuidEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class EmployeeDeleteCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): EmployeeDeleteInput
    {
        $requestData = $request->toArray();

        return new EmployeeDeleteInput(
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
