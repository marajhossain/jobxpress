<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105062240 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE updated_by updated_by INT DEFAULT NULL, CHANGE updated_time updated_time INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_post CHANGE logo logo VARCHAR(255) DEFAULT NULL, CHANGE total_applied total_applied INT DEFAULT NULL, CHANGE total_view total_view INT DEFAULT NULL');
        $this->addSql('ALTER TABLE system_config ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE updated_by updated_by INT DEFAULT NULL, CHANGE updated_time updated_time INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_post CHANGE logo logo VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE total_applied total_applied INT DEFAULT NULL, CHANGE total_view total_view INT DEFAULT NULL');
        $this->addSql('ALTER TABLE system_config DROP description');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
