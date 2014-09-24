<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140923230153 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('CREATE SEQUENCE PetAdoption_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE PetAdoption (id INT NOT NULL, user_id INT DEFAULT NULL, pet_id INT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, typeId INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F8323AB3A76ED395 ON PetAdoption (user_id)');
        $this->addSql('CREATE INDEX IDX_F8323AB3966F7FB6 ON PetAdoption (pet_id)');
        $this->addSql('ALTER TABLE PetAdoption ADD CONSTRAINT FK_F8323AB3A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE PetAdoption ADD CONSTRAINT FK_F8323AB3966F7FB6 FOREIGN KEY (pet_id) REFERENCES Pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('DROP SEQUENCE PetAdoption_id_seq CASCADE');
        $this->addSql('DROP TABLE PetAdoption');
    }
}
