<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140910014409 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('CREATE SEQUENCE City_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE oauth_auth_code_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE oauth_refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE State_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE oauth_client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE Country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE Address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE oauth_access_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fos_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fos_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE City (id INT NOT NULL, state_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D69AD0A5D83CC1 ON City (state_id)');
        $this->addSql('CREATE TABLE oauth_auth_code (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri TEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4D12F0E05F37A13B ON oauth_auth_code (token)');
        $this->addSql('CREATE INDEX IDX_4D12F0E019EB6921 ON oauth_auth_code (client_id)');
        $this->addSql('CREATE INDEX IDX_4D12F0E0A76ED395 ON oauth_auth_code (user_id)');
        $this->addSql('CREATE TABLE oauth_refresh_token (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55DCF7555F37A13B ON oauth_refresh_token (token)');
        $this->addSql('CREATE INDEX IDX_55DCF75519EB6921 ON oauth_refresh_token (client_id)');
        $this->addSql('CREATE INDEX IDX_55DCF755A76ED395 ON oauth_refresh_token (user_id)');
        $this->addSql('CREATE TABLE State (id INT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, acronym VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6252FDFFF92F3E70 ON State (country_id)');
        $this->addSql('CREATE TABLE oauth_client (id INT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris TEXT NOT NULL, secret VARCHAR(255) NOT NULL, allowed_grant_types TEXT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN oauth_client.redirect_uris IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN oauth_client.allowed_grant_types IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE Country (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Address (id INT NOT NULL, city_id INT NOT NULL, number INT NOT NULL, postalCode BIGINT NOT NULL, street VARCHAR(255) NOT NULL, district VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C2F3561D8BAC62AF ON Address (city_id)');
        $this->addSql('CREATE TABLE oauth_access_token (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7FA86A45F37A13B ON oauth_access_token (token)');
        $this->addSql('CREATE INDEX IDX_F7FA86A419EB6921 ON oauth_access_token (client_id)');
        $this->addSql('CREATE INDEX IDX_F7FA86A4A76ED395 ON oauth_access_token (user_id)');
        $this->addSql('CREATE TABLE fos_group (id INT NOT NULL, name VARCHAR(255) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B019DDB5E237E06 ON fos_group (name)');
        $this->addSql('COMMENT ON COLUMN fos_group.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE fos_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locked BOOLEAN NOT NULL, expired BOOLEAN NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, credentials_expired BOOLEAN NOT NULL, credentials_expire_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('COMMENT ON COLUMN fos_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE fos_user_group (user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('CREATE INDEX IDX_583D1F3EA76ED395 ON fos_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_583D1F3EFE54D947 ON fos_user_group (group_id)');
        $this->addSql('ALTER TABLE City ADD CONSTRAINT FK_8D69AD0A5D83CC1 FOREIGN KEY (state_id) REFERENCES State (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth_auth_code ADD CONSTRAINT FK_4D12F0E019EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth_auth_code ADD CONSTRAINT FK_4D12F0E0A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth_refresh_token ADD CONSTRAINT FK_55DCF75519EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth_refresh_token ADD CONSTRAINT FK_55DCF755A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE State ADD CONSTRAINT FK_6252FDFFF92F3E70 FOREIGN KEY (country_id) REFERENCES Country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Address ADD CONSTRAINT FK_C2F3561D8BAC62AF FOREIGN KEY (city_id) REFERENCES City (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth_access_token ADD CONSTRAINT FK_F7FA86A419EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth_access_token ADD CONSTRAINT FK_F7FA86A4A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fos_user_group ADD CONSTRAINT FK_583D1F3EA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fos_user_group ADD CONSTRAINT FK_583D1F3EFE54D947 FOREIGN KEY (group_id) REFERENCES fos_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        
        $this->addSql('ALTER TABLE Address DROP CONSTRAINT FK_C2F3561D8BAC62AF');
        $this->addSql('ALTER TABLE City DROP CONSTRAINT FK_8D69AD0A5D83CC1');
        $this->addSql('ALTER TABLE oauth_auth_code DROP CONSTRAINT FK_4D12F0E019EB6921');
        $this->addSql('ALTER TABLE oauth_refresh_token DROP CONSTRAINT FK_55DCF75519EB6921');
        $this->addSql('ALTER TABLE oauth_access_token DROP CONSTRAINT FK_F7FA86A419EB6921');
        $this->addSql('ALTER TABLE State DROP CONSTRAINT FK_6252FDFFF92F3E70');
        $this->addSql('ALTER TABLE fos_user_group DROP CONSTRAINT FK_583D1F3EFE54D947');
        $this->addSql('ALTER TABLE oauth_auth_code DROP CONSTRAINT FK_4D12F0E0A76ED395');
        $this->addSql('ALTER TABLE oauth_refresh_token DROP CONSTRAINT FK_55DCF755A76ED395');
        $this->addSql('ALTER TABLE oauth_access_token DROP CONSTRAINT FK_F7FA86A4A76ED395');
        $this->addSql('ALTER TABLE fos_user_group DROP CONSTRAINT FK_583D1F3EA76ED395');
        $this->addSql('DROP SEQUENCE City_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE oauth_auth_code_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE oauth_refresh_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE State_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE oauth_client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE Country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE Address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE oauth_access_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fos_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fos_user_id_seq CASCADE');
        $this->addSql('DROP TABLE City');
        $this->addSql('DROP TABLE oauth_auth_code');
        $this->addSql('DROP TABLE oauth_refresh_token');
        $this->addSql('DROP TABLE State');
        $this->addSql('DROP TABLE oauth_client');
        $this->addSql('DROP TABLE Country');
        $this->addSql('DROP TABLE Address');
        $this->addSql('DROP TABLE oauth_access_token');
        $this->addSql('DROP TABLE fos_group');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE fos_user_group');
    }
}
