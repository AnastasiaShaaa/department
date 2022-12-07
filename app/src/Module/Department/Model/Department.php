<?php

declare(strict_types=1);

namespace Department\Module\Department\Model;

use Department\Module\Department\Enum\DepartmentTypeEnum;
use Ramsey\Uuid\Uuid;

class Department
{
    public function __construct(
        private Uuid $id,
        private DepartmentTypeEnum $name,
        private ?string $description,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getName(): DepartmentTypeEnum
    {
        return $this->name;
    }

}
