<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\AllList;

use Department\Module\Grade\Repository\GradeRepositoryInterface;

final class GradeListHandler
{
    public function __construct(
        private GradeRepositoryInterface $gradeRepository,
    ) {}

    public function handle(): GradeListOutput
    {
        $list = $this->findList();

        return $this->makeOutput($list);
    }

    private function findList(): array
    {
        return $this->gradeRepository->findList();
    }

    private function makeOutput(array $list): GradeListOutput
    {
        return new GradeListOutput(
            $list,
            count($list),
        );
    }
}
