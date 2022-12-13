<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\View;

use Common\Factory\FactoryOutput;
use Department\Module\Grade\Model\Grade;
use Department\Module\Grade\Repository\GradeRepositoryInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class GradeViewHandler
{
    public function __construct(
        private GradeRepositoryInterface $gradeRepository,
        private FactoryOutput $factoryOutput,
    ) {}

    public function handle(GradeViewInput $input, bool $isAuthorized = false): GradeViewOutputInterface
    {
        $grade = $this->findGrade($input->getId());
        $this->assertExistence($grade);

        return $this->makeOutput($grade, $isAuthorized);
    }

    private function findGrade(UuidInterface $id): ?Grade
    {
        return $this->gradeRepository->findById($id);
    }

    private function assertExistence(?Grade $grade): void
    {
        if (!$grade) {
            throw new DomainException('Grade doesn\'t exist');
        }
    }

    private function makeOutput(Grade $grade, bool $isAuthorized): GradeViewOutputInterface
    {
        /** @var GradeViewOutputInterface $output */
        $output = $this->factoryOutput->makeOutput($isAuthorized, GradeViewOutputInterface::class);
        $output->setGrade($grade);

        return $output;
    }
}
