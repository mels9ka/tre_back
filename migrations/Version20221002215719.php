<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002215719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE language_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE text_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE translate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, project_id INT DEFAULT NULL, parent_category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19C1166D1F9C ON category (project_id)');
        $this->addSql('CREATE INDEX IDX_64C19C1796A8F92 ON category (parent_category_id)');
        $this->addSql('COMMENT ON COLUMN category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN category.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE language (id INT NOT NULL, code VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN language.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE2B36786B ON project (title)');
        $this->addSql('COMMENT ON COLUMN project.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE project_language (project_id INT NOT NULL, language_id INT NOT NULL, PRIMARY KEY(project_id, language_id))');
        $this->addSql('CREATE INDEX IDX_E995FA6E166D1F9C ON project_language (project_id)');
        $this->addSql('CREATE INDEX IDX_E995FA6E82F1BAF4 ON project_language (language_id)');
        $this->addSql('CREATE TABLE text (id INT NOT NULL, category_id INT DEFAULT NULL, key VARCHAR(255) NOT NULL, default_text TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B8BA7C712469DE2 ON text (category_id)');
        $this->addSql('COMMENT ON COLUMN text.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN text.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE translate (id INT NOT NULL, text_id INT DEFAULT NULL, language_id INT DEFAULT NULL, translate TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4A106377698D3548 ON translate (text_id)');
        $this->addSql('CREATE INDEX IDX_4A10637782F1BAF4 ON translate (language_id)');
        $this->addSql('COMMENT ON COLUMN translate.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN translate.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1796A8F92 FOREIGN KEY (parent_category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_language ADD CONSTRAINT FK_E995FA6E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_language ADD CONSTRAINT FK_E995FA6E82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A106377698D3548 FOREIGN KEY (text_id) REFERENCES text (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A10637782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE language_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE text_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE translate_id_seq CASCADE');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C1166D1F9C');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C1796A8F92');
        $this->addSql('ALTER TABLE project_language DROP CONSTRAINT FK_E995FA6E166D1F9C');
        $this->addSql('ALTER TABLE project_language DROP CONSTRAINT FK_E995FA6E82F1BAF4');
        $this->addSql('ALTER TABLE text DROP CONSTRAINT FK_3B8BA7C712469DE2');
        $this->addSql('ALTER TABLE translate DROP CONSTRAINT FK_4A106377698D3548');
        $this->addSql('ALTER TABLE translate DROP CONSTRAINT FK_4A10637782F1BAF4');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_language');
        $this->addSql('DROP TABLE text');
        $this->addSql('DROP TABLE translate');
    }
}
