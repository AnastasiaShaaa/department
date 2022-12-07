<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221207195332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX department_name_idx');
        $this->addSql('ALTER TABLE departments ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE departments ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER INDEX uniq_b157a34d8c03f15c RENAME TO UNIQ_13D2A5858C03F15C');
        $this->addSql('ALTER INDEX uniq_b157a34dfe19a1a8 RENAME TO UNIQ_13D2A585FE19A1A8');
        $this->addSql('ALTER TABLE employees ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE employees ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE grades ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE grades ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE UNIQUE INDEX grade_search_idx ON grades (name, department_id)');
        $this->addSql('DROP INDEX uniq_3ae361105e237e06');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employees ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE employees ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE departments ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE departments ALTER updated_at DROP DEFAULT');
        $this->addSql('CREATE INDEX department_name_idx ON departments (name)');
        $this->addSql('DROP INDEX grade_search_idx');
        $this->addSql('ALTER TABLE grades ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE grades ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER INDEX uniq_13d2a585fe19a1a8 RENAME TO uniq_b157a34dfe19a1a8');
        $this->addSql('ALTER INDEX uniq_13d2a5858c03f15c RENAME TO uniq_b157a34d8c03f15c');
    }
}
