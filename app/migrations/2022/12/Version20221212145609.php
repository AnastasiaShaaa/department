<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221212145609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employees ADD grade_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN employees.grade_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grades (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BA82C300FE19A1A8 ON employees (grade_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employees DROP CONSTRAINT FK_BA82C300FE19A1A8');
        $this->addSql('DROP INDEX IDX_BA82C300FE19A1A8');
        $this->addSql('ALTER TABLE employees DROP grade_id');
    }
}
