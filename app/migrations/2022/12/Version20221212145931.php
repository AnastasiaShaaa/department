<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221212145931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE employee_grades_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee_grades DROP CONSTRAINT fk_b157a34d8c03f15c');
        $this->addSql('ALTER TABLE employee_grades DROP CONSTRAINT fk_b157a34dfe19a1a8');
        $this->addSql('DROP TABLE employee_grades');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE employee_grades_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee_grades (id INT NOT NULL, employee_id UUID DEFAULT NULL, grade_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_13d2a585fe19a1a8 ON employee_grades (grade_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_13d2a5858c03f15c ON employee_grades (employee_id)');
        $this->addSql('COMMENT ON COLUMN employee_grades.employee_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employee_grades.grade_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE employee_grades ADD CONSTRAINT fk_b157a34d8c03f15c FOREIGN KEY (employee_id) REFERENCES employees (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_grades ADD CONSTRAINT fk_b157a34dfe19a1a8 FOREIGN KEY (grade_id) REFERENCES grades (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
