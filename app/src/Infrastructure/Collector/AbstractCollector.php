<?php

declare(strict_types=1);

namespace Department\Infrastructure\Collector;

use PHPUnit\Util\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Composite;

abstract class AbstractCollector
{
    abstract public function collect(Request $request): mixed;

    abstract protected function constraints(): Composite;

    public function validate(Request $request): void
    {
        $errors = $this->validator->validate($this->getContent($request), $this->constraints());
        if ($errors->count()) {
            throw new Exception('Invalid data');
        }
    }

    private function getContent(Request $request): array
    {
        // TODO: разобраться с реквестом
        return array_merge(
            $request->query->all(),
            $request->toArray(),
            $request->files->all()
        );
    }
}
