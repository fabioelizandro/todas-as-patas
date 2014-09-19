<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140919002741 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('CREATE SEQUENCE Pet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE Pet (id INT NOT NULL, organization_id INT NOT NULL, name VARCHAR(255) NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updatedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deletedAt TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, displayQuantity INT NOT NULL, sizeId INT NOT NULL, ageId INT NOT NULL, genderId INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DC1FDD6532C8A3DE ON Pet (organization_id)');
        $this->addSql('CREATE TABLE pets_breeds (pet_id INT NOT NULL, breed_id INT NOT NULL, PRIMARY KEY(pet_id, breed_id))');
        $this->addSql('CREATE INDEX IDX_B4312CFE966F7FB6 ON pets_breeds (pet_id)');
        $this->addSql('CREATE INDEX IDX_B4312CFEA8B4A30F ON pets_breeds (breed_id)');
        $this->addSql('ALTER TABLE Pet ADD CONSTRAINT FK_DC1FDD6532C8A3DE FOREIGN KEY (organization_id) REFERENCES Organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pets_breeds ADD CONSTRAINT FK_B4312CFE966F7FB6 FOREIGN KEY (pet_id) REFERENCES Pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pets_breeds ADD CONSTRAINT FK_B4312CFEA8B4A30F FOREIGN KEY (breed_id) REFERENCES Breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('ALTER TABLE pets_breeds DROP CONSTRAINT FK_B4312CFE966F7FB6');
        $this->addSql('DROP SEQUENCE Pet_id_seq CASCADE');
        $this->addSql('DROP TABLE Pet');
        $this->addSql('DROP TABLE pets_breeds');
    }
}
