<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221207185309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE employee_grades_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee_grades (id INT NOT NULL, employee_id UUID DEFAULT NULL, grade_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B157A34D8C03F15C ON employee_grades (employee_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B157A34DFE19A1A8 ON employee_grades (grade_id)');
        $this->addSql('COMMENT ON COLUMN employee_grades.employee_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employee_grades.grade_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE employee_grades ADD CONSTRAINT FK_B157A34D8C03F15C FOREIGN KEY (employee_id) REFERENCES employees (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_grades ADD CONSTRAINT FK_B157A34DFE19A1A8 FOREIGN KEY (grade_id) REFERENCES grades (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX grade_name_idx');
        $this->addSql('ALTER TABLE grades ADD department_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN grades.department_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110AE80F5DF FOREIGN KEY (department_id) REFERENCES departments (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3AE36110AE80F5DF ON grades (department_id)');
        $this->addSql('ALTER INDEX grade_search_idx RENAME TO UNIQ_3AE361105E237E06');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE employee_grades_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee_grades DROP CONSTRAINT FK_B157A34D8C03F15C');
        $this->addSql('ALTER TABLE employee_grades DROP CONSTRAINT FK_B157A34DFE19A1A8');
        $this->addSql('DROP TABLE employee_grades');
        $this->addSql('ALTER TABLE grades DROP CONSTRAINT FK_3AE36110AE80F5DF');
        $this->addSql('DROP INDEX IDX_3AE36110AE80F5DF');
        $this->addSql('ALTER TABLE grades DROP department_id');
        $this->addSql('CREATE INDEX grade_name_idx ON grades (name)');
        $this->addSql('ALTER INDEX uniq_3ae361105e237e06 RENAME TO grade_search_idx');
    }
}
