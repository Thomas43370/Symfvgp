<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023133202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesvgp_categorie (id INT AUTO_INCREMENT NOT NULL, regle_id INT DEFAULT NULL, categorie VARCHAR(255) NOT NULL, commentaire_categorie VARCHAR(255) DEFAULT NULL, INDEX IDX_CAFD139E8E12947B (regle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_clients (id INT AUTO_INCREMENT NOT NULL, societe VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_donnees_membres (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, societe VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, logo TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F0B5E057A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_energie (id INT AUTO_INCREMENT NOT NULL, energie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_marque (id INT AUTO_INCREMENT NOT NULL, marque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_matcli (id INT AUTO_INCREMENT NOT NULL, clients_id INT DEFAULT NULL, lesvgp_categorie_id INT DEFAULT NULL, lesvgp_modele_id INT DEFAULT NULL, commentaire_matcli VARCHAR(255) DEFAULT NULL, INDEX IDX_B546E62DAB014612 (clients_id), INDEX IDX_B546E62D332F9F33 (lesvgp_categorie_id), INDEX IDX_B546E62D2F9472A0 (lesvgp_modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_modele (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, energie_id INT DEFAULT NULL, modele VARCHAR(255) NOT NULL, commentaire_modele VARCHAR(255) DEFAULT NULL, INDEX IDX_57543F4A4827B9B2 (marque_id), INDEX IDX_57543F4AB732A364 (energie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_regle (id INT AUTO_INCREMENT NOT NULL, regle VARCHAR(255) NOT NULL, commentaire_regle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lesvgp_categorie ADD CONSTRAINT FK_CAFD139E8E12947B FOREIGN KEY (regle_id) REFERENCES lesvgp_regle (id)');
        $this->addSql('ALTER TABLE lesvgp_donnees_membres ADD CONSTRAINT FK_F0B5E057A76ED395 FOREIGN KEY (user_id) REFERENCES lesvgp_users (id)');
        $this->addSql('ALTER TABLE lesvgp_matcli ADD CONSTRAINT FK_B546E62DAB014612 FOREIGN KEY (clients_id) REFERENCES lesvgp_clients (id)');
        $this->addSql('ALTER TABLE lesvgp_matcli ADD CONSTRAINT FK_B546E62D332F9F33 FOREIGN KEY (lesvgp_categorie_id) REFERENCES lesvgp_categorie (id)');
        $this->addSql('ALTER TABLE lesvgp_matcli ADD CONSTRAINT FK_B546E62D2F9472A0 FOREIGN KEY (lesvgp_modele_id) REFERENCES lesvgp_modele (id)');
        $this->addSql('ALTER TABLE lesvgp_modele ADD CONSTRAINT FK_57543F4A4827B9B2 FOREIGN KEY (marque_id) REFERENCES lesvgp_marque (id)');
        $this->addSql('ALTER TABLE lesvgp_modele ADD CONSTRAINT FK_57543F4AB732A364 FOREIGN KEY (energie_id) REFERENCES lesvgp_energie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesvgp_matcli DROP FOREIGN KEY FK_B546E62D332F9F33');
        $this->addSql('ALTER TABLE lesvgp_matcli DROP FOREIGN KEY FK_B546E62DAB014612');
        $this->addSql('ALTER TABLE lesvgp_modele DROP FOREIGN KEY FK_57543F4AB732A364');
        $this->addSql('ALTER TABLE lesvgp_modele DROP FOREIGN KEY FK_57543F4A4827B9B2');
        $this->addSql('ALTER TABLE lesvgp_matcli DROP FOREIGN KEY FK_B546E62D2F9472A0');
        $this->addSql('ALTER TABLE lesvgp_categorie DROP FOREIGN KEY FK_CAFD139E8E12947B');
        $this->addSql('DROP TABLE lesvgp_categorie');
        $this->addSql('DROP TABLE lesvgp_clients');
        $this->addSql('DROP TABLE lesvgp_donnees_membres');
        $this->addSql('DROP TABLE lesvgp_energie');
        $this->addSql('DROP TABLE lesvgp_marque');
        $this->addSql('DROP TABLE lesvgp_matcli');
        $this->addSql('DROP TABLE lesvgp_modele');
        $this->addSql('DROP TABLE lesvgp_regle');
    }
}
