<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140924210439 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('DROP INDEX idx_f8323ab3966f7fb6');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F8323AB3966F7FB6 ON petadoption (pet_id)');
        $this->addSql('ALTER TABLE pet DROP adopted');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('DROP INDEX UNIQ_F8323AB3966F7FB6');
        $this->addSql('CREATE INDEX idx_f8323ab3966f7fb6 ON PetAdoption (pet_id)');
        $this->addSql('ALTER TABLE Pet ADD adopted BOOLEAN DEFAULT \'false\' NOT NULL');
    }
}
