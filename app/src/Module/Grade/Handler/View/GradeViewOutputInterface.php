<?php

declare(strict_types=1);

namespace Department\Module\Grade\Handler\View;

use Common\Output\OutputInterface;
use Department\Module\Grade\Model\Grade;
use JsonSerializable;

interface GradeViewOutputInterface extends JsonSerializable, OutputInterface
{
    public function setGrade(Grade $grade): void;
}
