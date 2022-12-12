<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Employee;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Employee\Handler\ChangeGrade\EmployeeChangeGradeInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Ramsey\Uuid\Uuid as UuidEntity;
use Symfony\Component\Validator\Constraints\Composite;

final class EmployeeChangeGradeCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): EmployeeChangeGradeInput
    {
        $requestData = $request->toArray();

        return new EmployeeChangeGradeInput(
            UuidEntity::fromString($requestData['id']),
            UuidEntity::fromString($requestData['grade_id']),
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'id' => new Required([
                new Uuid(),
            ]),
            'grade_id' => new Required([
                new Uuid(),
            ]),
        ]);
    }
}
