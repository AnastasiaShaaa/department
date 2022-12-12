<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209145647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE departments ALTER name TYPE VARCHAR(100)');
        $this->addSql('COMMENT ON COLUMN departments.name IS NULL');
        $this->addSql('ALTER TABLE grades ALTER name TYPE VARCHAR(100)');
        $this->addSql('COMMENT ON COLUMN grades.name IS NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE departments ALTER name TYPE VARCHAR(100)');
        $this->addSql('COMMENT ON COLUMN departments.name IS \'(DC2Type:enum_department_type)\'');
        $this->addSql('ALTER TABLE grades ALTER name TYPE VARCHAR(100)');
        $this->addSql('COMMENT ON COLUMN grades.name IS \'(DC2Type:enum_grade_type)\'');
    }
}
