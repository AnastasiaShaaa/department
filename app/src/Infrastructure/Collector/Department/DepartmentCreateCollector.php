<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Department;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Department\Enum\DepartmentTypeEnum;
use Department\Module\Department\Handler\DepartmentCreateInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
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
        return new DepartmentCreateInput(
            $request->toArray()['name'],
            $request->toArray()['description'],
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'name' => new Required([
                new Length(['max' => 100]),
            ]),
            'description' => new Optional([
                new Length(['max' => 100]),
            ]),
        ]);
    }
}
