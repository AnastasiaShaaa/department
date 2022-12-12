<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector\Grade;

use Department\Infrastructure\Collector\AbstractCollector;
use Department\Module\Grade\Handler\Delete\GradeDeleteInput;
use Ramsey\Uuid\Uuid as UuidEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class GradeDeleteCollector extends AbstractCollector
{
    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    public function collect(Request $request): GradeDeleteInput
    {
        $requestData = $request->toArray();

        return new GradeDeleteInput(
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
