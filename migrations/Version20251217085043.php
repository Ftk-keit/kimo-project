<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251217085043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, views INT NOT NULL, status VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, bedroom INT NOT NULL, bathroom INT NOT NULL, surface VARCHAR(50) NOT NULL, characteristic JSON NOT NULL, media JSON NOT NULL, type_transaction VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, transaction_id INT DEFAULT NULL, owner_id INT NOT NULL, INDEX IDX_8BF21CDE2FC0CB0F (transaction_id), INDEX IDX_8BF21CDE7E3C61F9 (owner_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, price VARCHAR(50) NOT NULL, commission VARCHAR(50) NOT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, seller_id INT NOT NULL, buyer_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_723705D18DE820D9 (seller_id), INDEX IDX_723705D16C755722 (buyer_id), INDEX IDX_723705D1549213EC (property_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, address VARCHAR(50) NOT NULL, phone VARCHAR(8) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE visit (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, hourse TIME NOT NULL, status VARCHAR(255) NOT NULL, property_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_437EE939549213EC (property_id), INDEX IDX_437EE93919EB6921 (client_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D18DE820D9 FOREIGN KEY (seller_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D16C755722 FOREIGN KEY (buyer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE93919EB6921 FOREIGN KEY (client_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE2FC0CB0F');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE7E3C61F9');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D18DE820D9');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D16C755722');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1549213EC');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE939549213EC');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE93919EB6921');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE visit');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
