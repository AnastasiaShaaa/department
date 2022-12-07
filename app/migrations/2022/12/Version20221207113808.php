<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221207113808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Module Grade';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE grades (id UUID NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(100) DEFAULT NULL, instruction VARCHAR(250) DEFAULT NULL, salary INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX name_idx ON grades (name)');
        $this->addSql('CREATE UNIQUE INDEX search_idx ON grades (name)');
        $this->addSql('COMMENT ON COLUMN grades.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN grades.name IS \'(DC2Type:enum_grade_type)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE grades');
    }
}
