<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141029014122 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('CREATE SEQUENCE PetListener_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE PetListener (id INT NOT NULL, user_id INT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updatedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sizeId INT NOT NULL, genderId INT NOT NULL, ageId INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8070B838A76ED395 ON PetListener (user_id)');
        $this->addSql('CREATE TABLE petlisteners_breeds (pet_id INT NOT NULL, breed_id INT NOT NULL, PRIMARY KEY(pet_id, breed_id))');
        $this->addSql('CREATE INDEX IDX_10FAB450966F7FB6 ON petlisteners_breeds (pet_id)');
        $this->addSql('CREATE INDEX IDX_10FAB450A8B4A30F ON petlisteners_breeds (breed_id)');
        $this->addSql('ALTER TABLE PetListener ADD CONSTRAINT FK_8070B838A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petlisteners_breeds ADD CONSTRAINT FK_10FAB450966F7FB6 FOREIGN KEY (pet_id) REFERENCES PetListener (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petlisteners_breeds ADD CONSTRAINT FK_10FAB450A8B4A30F FOREIGN KEY (breed_id) REFERENCES Breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('ALTER TABLE petlisteners_breeds DROP CONSTRAINT FK_10FAB450966F7FB6');
        $this->addSql('DROP SEQUENCE PetListener_id_seq CASCADE');
        $this->addSql('DROP TABLE PetListener');
        $this->addSql('DROP TABLE petlisteners_breeds');
    }
}
