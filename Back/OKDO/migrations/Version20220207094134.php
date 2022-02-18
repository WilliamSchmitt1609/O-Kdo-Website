<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207094134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_age (product_id INT NOT NULL, age_id INT NOT NULL, INDEX IDX_411F44AD4584665A (product_id), INDEX IDX_411F44ADCC80CD12 (age_id), PRIMARY KEY(product_id, age_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_age ADD CONSTRAINT FK_411F44AD4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_age ADD CONSTRAINT FK_411F44ADCC80CD12 FOREIGN KEY (age_id) REFERENCES age (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE age_product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE age_product (age_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_1D32194FCC80CD12 (age_id), INDEX IDX_1D32194F4584665A (product_id), PRIMARY KEY(age_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE age_product ADD CONSTRAINT FK_1D32194FCC80CD12 FOREIGN KEY (age_id) REFERENCES age (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE age_product ADD CONSTRAINT FK_1D32194F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_age');
    }
}
