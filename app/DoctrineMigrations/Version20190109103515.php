<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190109103515 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contain (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, book_id INT DEFAULT NULL, qte INT NOT NULL, INDEX IDX_4BEFF7C88805AB2F (annonce_id), INDEX IDX_4BEFF7C816A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C88805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C816A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE annonce CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book CHANGE type_id type_id INT DEFAULT NULL, CHANGE collection collection VARCHAR(255) DEFAULT NULL, CHANGE rating rating INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE rating rating INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contain');
        $this->addSql('ALTER TABLE annonce CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book CHANGE type_id type_id INT DEFAULT NULL, CHANGE collection collection VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE rating rating INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE rating rating INT DEFAULT NULL');
    }
}
