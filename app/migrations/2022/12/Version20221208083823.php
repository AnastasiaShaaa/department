<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221208083823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX uniq_13d2a585fe19a1a8');
        $this->addSql('CREATE INDEX IDX_13D2A585FE19A1A8 ON employee_grades (grade_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AE361105E237E06 ON grades (name)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX IDX_13D2A585FE19A1A8');
        $this->addSql('CREATE UNIQUE INDEX uniq_13d2a585fe19a1a8 ON employee_grades (grade_id)');
        $this->addSql('DROP INDEX UNIQ_3AE361105E237E06');
    }
}
