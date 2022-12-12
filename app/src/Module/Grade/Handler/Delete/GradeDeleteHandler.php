<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\Delete;

use Department\Module\Grade\Model\Grade;
use Department\Module\Grade\Repository\GradeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\UuidInterface;

final class GradeDeleteHandler
{
    public function __construct(
        private GradeRepositoryInterface $gradeRepository,
        private EntityManagerInterface $em,
    ) {}

    public function handle(GradeDeleteInput $input): GradeDeleteOutput
    {
        $grade = $this->find($input->getId());
        $this->assertExistence($grade);
        $this->remove($grade);
        $this->flush();

        return $this->makeOutput();
    }

    private function find(UuidInterface $id): ?Grade
    {
        return $this->gradeRepository->findById($id);
    }

    private function assertExistence(?Grade $grade): void
    {
        if (!$grade) {
            throw new DomainException('Grade doesn\'t exist');
        }
    }

    private function remove(Grade $grade): void
    {
        $this->gradeRepository->remove($grade);
    }

    private function flush(): void
    {
        $this->em->flush();
    }

    private function makeOutput(): GradeDeleteOutput
    {
        return new GradeDeleteOutput(
            'Successful deleting of grade!',
        );
    }
}
