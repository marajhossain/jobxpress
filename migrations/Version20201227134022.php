<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201227134022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE job_post_copy');
        $this->addSql('ALTER TABLE category CHANGE updated_by updated_by INT DEFAULT NULL, CHANGE updated_time updated_time INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_post ADD token VARCHAR(255) NOT NULL, ADD job_posting_time INT NOT NULL, CHANGE logo logo VARCHAR(255) DEFAULT NULL, CHANGE total_applied total_applied INT DEFAULT NULL, CHANGE total_view total_view INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE job_post_copy (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, company_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, position VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, location VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, logo VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, total_applied INT DEFAULT NULL, total_view INT DEFAULT NULL, poster_email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, status VARCHAR(15) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_DD461ACC12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE job_post_copy ADD CONSTRAINT job_post_copy_ibfk_1 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category CHANGE updated_by updated_by INT DEFAULT NULL, CHANGE updated_time updated_time INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_post DROP token, DROP job_posting_time, CHANGE logo logo VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE total_applied total_applied INT DEFAULT NULL, CHANGE total_view total_view INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
