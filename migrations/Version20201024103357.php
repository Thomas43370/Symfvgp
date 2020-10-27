<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201024103357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesvgp_formulaire ADD regle_id INT DEFAULT NULL, ADD commentaire_formulaire VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE lesvgp_formulaire ADD CONSTRAINT FK_6D5DCB9B8E12947B FOREIGN KEY (regle_id) REFERENCES lesvgp_regle (id)');
        $this->addSql('CREATE INDEX IDX_6D5DCB9B8E12947B ON lesvgp_formulaire (regle_id)');
        $this->addSql('ALTER TABLE lesvgp_vgp ADD formulaire_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD procont DATETIME NOT NULL, ADD avis INT DEFAULT NULL, ADD synthese INT DEFAULT NULL, ADD resultat_essais VARCHAR(50) DEFAULT NULL, ADD texteimg VARCHAR(255) DEFAULT NULL, ADD numserie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE lesvgp_vgp ADD CONSTRAINT FK_C64A63665053569B FOREIGN KEY (formulaire_id) REFERENCES lesvgp_formulaire (id)');
        $this->addSql('ALTER TABLE lesvgp_vgp ADD CONSTRAINT FK_C64A6366A76ED395 FOREIGN KEY (user_id) REFERENCES lesvgp_users (id)');
        $this->addSql('CREATE INDEX IDX_C64A63665053569B ON lesvgp_vgp (formulaire_id)');
        $this->addSql('CREATE INDEX IDX_C64A6366A76ED395 ON lesvgp_vgp (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesvgp_formulaire DROP FOREIGN KEY FK_6D5DCB9B8E12947B');
        $this->addSql('DROP INDEX IDX_6D5DCB9B8E12947B ON lesvgp_formulaire');
        $this->addSql('ALTER TABLE lesvgp_formulaire DROP regle_id, DROP commentaire_formulaire');
        $this->addSql('ALTER TABLE lesvgp_vgp DROP FOREIGN KEY FK_C64A63665053569B');
        $this->addSql('ALTER TABLE lesvgp_vgp DROP FOREIGN KEY FK_C64A6366A76ED395');
        $this->addSql('DROP INDEX IDX_C64A63665053569B ON lesvgp_vgp');
        $this->addSql('DROP INDEX IDX_C64A6366A76ED395 ON lesvgp_vgp');
        $this->addSql('ALTER TABLE lesvgp_vgp DROP formulaire_id, DROP user_id, DROP procont, DROP avis, DROP synthese, DROP resultat_essais, DROP texteimg, DROP numserie');
    }
}
