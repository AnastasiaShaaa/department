<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Department;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Department\Handler\Create\DepartmentCreateInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class DepartmentCreateCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): DepartmentCreateInput
    {
        $requestData = $request->toArray();

        return new DepartmentCreateInput(
            $requestData['name'],
            $requestData['description'],
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'name' => new Required([
                new Length(['max' => 100]),
            ]),
            // TODO: сделать необязательным поле и null по умолчанию
            'description' => new Optional([
                new Length(['max' => 100]),
            ]),
        ]);
    }
}
