<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141007203002 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('CREATE TABLE users_favorite_pets (user_id INT NOT NULL, pet_id INT NOT NULL, PRIMARY KEY(user_id, pet_id))');
        $this->addSql('CREATE INDEX IDX_61DBFB0DA76ED395 ON users_favorite_pets (user_id)');
        $this->addSql('CREATE INDEX IDX_61DBFB0D966F7FB6 ON users_favorite_pets (pet_id)');
        $this->addSql('ALTER TABLE users_favorite_pets ADD CONSTRAINT FK_61DBFB0DA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_favorite_pets ADD CONSTRAINT FK_61DBFB0D966F7FB6 FOREIGN KEY (pet_id) REFERENCES Pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fos_user ADD firstName VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD lastName VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD phone BIGINT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('DROP TABLE users_favorite_pets');
        $this->addSql('ALTER TABLE fos_user DROP firstName');
        $this->addSql('ALTER TABLE fos_user DROP lastName');
        $this->addSql('ALTER TABLE fos_user DROP phone');
    }
}
