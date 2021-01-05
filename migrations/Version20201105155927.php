<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105155927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, status TINYINT UNSIGNED DEFAULT 1 NOT NULL, created_by INT UNSIGNED DEFAULT 0 NOT NULL, edited_by INT UNSIGNED DEFAULT 0 NOT NULL, deleted_by INT UNSIGNED DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL, edited_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, `key` VARCHAR(255) NOT NULL, value VARCHAR(255) DEFAULT NULL, status TINYINT UNSIGNED DEFAULT 1 NOT NULL, created_by INT UNSIGNED DEFAULT 0 NOT NULL, edited_by INT UNSIGNED DEFAULT 0 NOT NULL, deleted_by INT UNSIGNED DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL, edited_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D48A2F7C8A90ABA9 (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, company VARCHAR(255) NOT NULL, company_logo VARCHAR(255) DEFAULT NULL, job_type VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, website VARCHAR(150) DEFAULT NULL, start_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, status TINYINT UNSIGNED DEFAULT 1 NOT NULL, created_by INT UNSIGNED DEFAULT 0 NOT NULL, edited_by INT UNSIGNED DEFAULT 0 NOT NULL, deleted_by INT UNSIGNED DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL, edited_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_FBD8E0F812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_apply (id INT AUTO_INCREMENT NOT NULL, job_id INT NOT NULL, user_id INT NOT NULL, apply_at DATETIME NOT NULL, resume VARCHAR(255) DEFAULT NULL, is_view TINYINT UNSIGNED DEFAULT 0 NOT NULL, status TINYINT UNSIGNED DEFAULT 1 NOT NULL, INDEX IDX_BC73316FBE04EA9 (job_id), INDEX IDX_BC73316FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, email VARCHAR(120) NOT NULL, password VARCHAR(255) NOT NULL, profile_photo VARCHAR(255) DEFAULT NULL, type TINYINT UNSIGNED DEFAULT 0 NOT NULL, status TINYINT UNSIGNED DEFAULT 1 NOT NULL, created_by INT UNSIGNED DEFAULT 0 NOT NULL, edited_by INT UNSIGNED DEFAULT 0 NOT NULL, deleted_by INT UNSIGNED DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL, edited_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE job_apply ADD CONSTRAINT FK_BC73316FBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE job_apply ADD CONSTRAINT FK_BC73316FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F812469DE2');
        $this->addSql('ALTER TABLE job_apply DROP FOREIGN KEY FK_BC73316FBE04EA9');
        $this->addSql('ALTER TABLE job_apply DROP FOREIGN KEY FK_BC73316FA76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE config');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_apply');
        $this->addSql('DROP TABLE user');
    }
}
