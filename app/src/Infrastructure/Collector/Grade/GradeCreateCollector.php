<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Grade;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Grade\Handler\GradeCreateInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Ramsey\Uuid\Uuid as UuidEntity;

final class GradeCreateCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): GradeCreateInput
    {
        $requestData = $request->toArray();

        return new GradeCreateInput(
            $requestData['name'],
            UuidEntity::fromString($requestData['department']),
            $requestData['salary'],
            $requestData['description'],
            $requestData['instruction'],
        );
    }

    protected function constraints(): Composite
    {
        return new Collection([
            'name' => new Required([
                new Length(['max' => 100]),
            ]),
            'department' => new Required([
                new Uuid(),
            ]),
            // TODO: сделать необязательным поле и null по умолчанию
            'description' => new Optional([
                new Length(['max' => 100]),
            ]),
            'instruction' => new Optional([
                new Length(['max' => 250]),
            ]),
            'salary' => new Required([
                new Positive(),
            ]),
        ]);
    }
}
