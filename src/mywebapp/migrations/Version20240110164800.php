<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110164800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_car ADD model_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_car ADD CONSTRAINT FK_9C2B87167975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9C2B87167975B7E7 ON user_car (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_car DROP CONSTRAINT FK_9C2B87167975B7E7');
        $this->addSql('DROP INDEX IDX_9C2B87167975B7E7');
        $this->addSql('ALTER TABLE user_car DROP model_id');
    }
}
