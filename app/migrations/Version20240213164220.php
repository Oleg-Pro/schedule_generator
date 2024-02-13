<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213164220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tournament DROP CONSTRAINT fk_bd5fb8d933d1a3e7');
        $this->addSql('DROP INDEX idx_bd5fb8d933d1a3e7');
        $this->addSql('ALTER TABLE tournament DROP tournament_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tournament ADD tournament_id INT NOT NULL');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT fk_bd5fb8d933d1a3e7 FOREIGN KEY (tournament_id) REFERENCES tournament_participant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_bd5fb8d933d1a3e7 ON tournament (tournament_id)');
    }
}
