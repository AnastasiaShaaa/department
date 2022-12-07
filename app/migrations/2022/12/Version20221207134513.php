<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221207134513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Module employee';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE employees (id UUID NOT NULL, fullname VARCHAR(255) NOT NULL, email VARCHAR(50) NOT NULL, phone VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, experience VARCHAR(50) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA82C300E7927C74 ON employees (email)');
        $this->addSql('CREATE INDEX employee_email_idx ON employees (email)');
        $this->addSql('COMMENT ON COLUMN employees.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employees.email IS \'(DC2Type:email_type)\'');
        $this->addSql('COMMENT ON COLUMN employees.phone IS \'(DC2Type:phone_type)\'');
        $this->addSql('COMMENT ON COLUMN employees.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN employees.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE departments ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE departments ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN departments.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN departments.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE grades ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE grades ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN grades.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN grades.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_BA82C300E7927C74');
        $this->addSql('DROP INDEX employee_email_idx');
        $this->addSql('DROP TABLE employees');
        $this->addSql('ALTER TABLE grades DROP created_at');
        $this->addSql('ALTER TABLE grades DROP updated_at');
        $this->addSql('ALTER TABLE departments DROP created_at');
        $this->addSql('ALTER TABLE departments DROP updated_at');
    }
}
