<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024025351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, date DATETIME NOT NULL, table_number INT NOT NULL, total INT DEFAULT NULL, INDEX IDX_7A2119E39395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_food (id INT AUTO_INCREMENT NOT NULL, bill_id INT DEFAULT NULL, food_id INT DEFAULT NULL, order_date DATETIME NOT NULL, quantity INT NOT NULL, order_price INT NOT NULL, INDEX IDX_99C913E01A8C12F5 (bill_id), INDEX IDX_99C913E0BA8E87C4 (food_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E39395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE order_food ADD CONSTRAINT FK_99C913E01A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('ALTER TABLE order_food ADD CONSTRAINT FK_99C913E0BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E39395C3F3');
        $this->addSql('ALTER TABLE order_food DROP FOREIGN KEY FK_99C913E01A8C12F5');
        $this->addSql('ALTER TABLE order_food DROP FOREIGN KEY FK_99C913E0BA8E87C4');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE order_food');
    }
}
