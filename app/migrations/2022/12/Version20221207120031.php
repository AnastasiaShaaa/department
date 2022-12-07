<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221207120031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Department module';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE departments (id UUID NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX department_name_idx ON departments (name)');
        $this->addSql('CREATE UNIQUE INDEX department_search_idx ON departments (name)');
        $this->addSql('COMMENT ON COLUMN departments.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN departments.name IS \'(DC2Type:enum_department_type)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX department_name_idx');
        $this->addSql('DROP INDEX department_search_idx');
        $this->addSql('DROP TABLE departments');
    }
}
