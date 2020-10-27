<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023150944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesvgp_formulaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, donnees LONGTEXT NOT NULL, duree INT NOT NULL, levage TINYINT(1) NOT NULL, questionnaire TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_proposition (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, proposition VARCHAR(255) NOT NULL, type VARCHAR(50) NOT NULL, categ VARCHAR(255) NOT NULL, unite_valeur VARCHAR(255) DEFAULT NULL, equipements LONGTEXT DEFAULT NULL, INDEX IDX_782B228FBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_question (id INT AUTO_INCREMENT NOT NULL, titre_id INT DEFAULT NULL, regle_id INT DEFAULT NULL, question VARCHAR(255) NOT NULL, verif VARCHAR(255) NOT NULL, INDEX IDX_E5B72459D54FAE5E (titre_id), INDEX IDX_E5B724598E12947B (regle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_titre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_vgp (id INT AUTO_INCREMENT NOT NULL, matcli_id INT DEFAULT NULL, rapport VARCHAR(255) NOT NULL, dateproconc INT NOT NULL, relance INT NOT NULL, donnees LONGTEXT NOT NULL, tableau LONGTEXT NOT NULL, INDEX IDX_C64A636642CF6553 (matcli_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lesvgp_proposition ADD CONSTRAINT FK_782B228FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES lesvgp_categorie (id)');
        $this->addSql('ALTER TABLE lesvgp_question ADD CONSTRAINT FK_E5B72459D54FAE5E FOREIGN KEY (titre_id) REFERENCES lesvgp_titre (id)');
        $this->addSql('ALTER TABLE lesvgp_question ADD CONSTRAINT FK_E5B724598E12947B FOREIGN KEY (regle_id) REFERENCES lesvgp_regle (id)');
        $this->addSql('ALTER TABLE lesvgp_vgp ADD CONSTRAINT FK_C64A636642CF6553 FOREIGN KEY (matcli_id) REFERENCES lesvgp_matcli (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesvgp_question DROP FOREIGN KEY FK_E5B72459D54FAE5E');
        $this->addSql('DROP TABLE lesvgp_formulaire');
        $this->addSql('DROP TABLE lesvgp_proposition');
        $this->addSql('DROP TABLE lesvgp_question');
        $this->addSql('DROP TABLE lesvgp_titre');
        $this->addSql('DROP TABLE lesvgp_vgp');
    }
}
