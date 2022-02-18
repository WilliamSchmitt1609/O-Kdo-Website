<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201132256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE age ADD value VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD value VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD value VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE genre ADD value VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE age DROP value');
        $this->addSql('ALTER TABLE category DROP value');
        $this->addSql('ALTER TABLE event DROP value');
        $this->addSql('ALTER TABLE genre DROP value');
    }
}
