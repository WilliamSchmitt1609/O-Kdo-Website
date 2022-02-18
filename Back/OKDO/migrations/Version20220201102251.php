<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201102251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE age (id INT AUTO_INCREMENT NOT NULL, age_range VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE age_profiles (age_id INT NOT NULL, profiles_id INT NOT NULL, INDEX IDX_C5FA7E79CC80CD12 (age_id), INDEX IDX_C5FA7E7922077C89 (profiles_id), PRIMARY KEY(age_id, profiles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE age_product (age_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_1D32194FCC80CD12 (age_id), INDEX IDX_1D32194F4584665A (product_id), PRIMARY KEY(age_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_profiles (category_id INT NOT NULL, profiles_id INT NOT NULL, INDEX IDX_3C4A014B12469DE2 (category_id), INDEX IDX_3C4A014B22077C89 (profiles_id), PRIMARY KEY(category_id, profiles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, number INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_product (event_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_561DAD0271F7E88B (event_id), INDEX IDX_561DAD024584665A (product_id), PRIMARY KEY(event_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, genre_id INT NOT NULL, name VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, picture VARCHAR(2000) NOT NULL, shopping_link VARCHAR(2000) NOT NULL, age_range VARCHAR(50) DEFAULT NULL, gender VARCHAR(50) DEFAULT NULL, status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D34A04AD4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profiles (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, genre_id INT NOT NULL, event_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_8B308530A76ED395 (user_id), INDEX IDX_8B3085304296D31F (genre_id), INDEX IDX_8B30853071F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nickname VARCHAR(50) NOT NULL, email VARCHAR(128) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE age_profiles ADD CONSTRAINT FK_C5FA7E79CC80CD12 FOREIGN KEY (age_id) REFERENCES age (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE age_profiles ADD CONSTRAINT FK_C5FA7E7922077C89 FOREIGN KEY (profiles_id) REFERENCES profiles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE age_product ADD CONSTRAINT FK_1D32194FCC80CD12 FOREIGN KEY (age_id) REFERENCES age (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE age_product ADD CONSTRAINT FK_1D32194F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_profiles ADD CONSTRAINT FK_3C4A014B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_profiles ADD CONSTRAINT FK_3C4A014B22077C89 FOREIGN KEY (profiles_id) REFERENCES profiles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_product ADD CONSTRAINT FK_561DAD0271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_product ADD CONSTRAINT FK_561DAD024584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profiles ADD CONSTRAINT FK_8B308530A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profiles ADD CONSTRAINT FK_8B3085304296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE profiles ADD CONSTRAINT FK_8B30853071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE age_profiles DROP FOREIGN KEY FK_C5FA7E79CC80CD12');
        $this->addSql('ALTER TABLE age_product DROP FOREIGN KEY FK_1D32194FCC80CD12');
        $this->addSql('ALTER TABLE category_profiles DROP FOREIGN KEY FK_3C4A014B12469DE2');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE event_product DROP FOREIGN KEY FK_561DAD0271F7E88B');
        $this->addSql('ALTER TABLE profiles DROP FOREIGN KEY FK_8B30853071F7E88B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4296D31F');
        $this->addSql('ALTER TABLE profiles DROP FOREIGN KEY FK_8B3085304296D31F');
        $this->addSql('ALTER TABLE age_product DROP FOREIGN KEY FK_1D32194F4584665A');
        $this->addSql('ALTER TABLE event_product DROP FOREIGN KEY FK_561DAD024584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE age_profiles DROP FOREIGN KEY FK_C5FA7E7922077C89');
        $this->addSql('ALTER TABLE category_profiles DROP FOREIGN KEY FK_3C4A014B22077C89');
        $this->addSql('ALTER TABLE profiles DROP FOREIGN KEY FK_8B308530A76ED395');
        $this->addSql('DROP TABLE age');
        $this->addSql('DROP TABLE age_profiles');
        $this->addSql('DROP TABLE age_product');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_profiles');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_product');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE profiles');
        $this->addSql('DROP TABLE user');
    }
}
