<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190707184509 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(155) NOT NULL, iso_code VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, price NUMERIC(10, 0) NOT NULL, discount_price NUMERIC(10, 0) DEFAULT NULL, sku VARCHAR(155) NOT NULL, localizations NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_localization (product INT NOT NULL, language INT NOT NULL, name VARCHAR(155) NOT NULL, url_key VARCHAR(255) DEFAULT NULL, canonical LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, meta_keywords VARCHAR(155) DEFAULT NULL, meta_description VARCHAR(155) DEFAULT NULL, INDEX IDX_1578BD2CD34A04AD (product), INDEX IDX_1578BD2CD4DB71B5 (language), PRIMARY KEY(product, language)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_localization ADD CONSTRAINT FK_1578BD2CD34A04AD FOREIGN KEY (product) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_localization ADD CONSTRAINT FK_1578BD2CD4DB71B5 FOREIGN KEY (language) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO language (`name`, `iso_code`) VALUE ("Türkçe", "tr");');
        $this->addSql('INSERT INTO language (`name`, `iso_code`) VALUE ("Engilish", "en");');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_localization DROP FOREIGN KEY FK_1578BD2CD4DB71B5');
        $this->addSql('ALTER TABLE product_localization DROP FOREIGN KEY FK_1578BD2CD34A04AD');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_localization');
    }
}
