<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025083155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesvgp_questionnaire (id INT AUTO_INCREMENT NOT NULL, formulaire_id INT DEFAULT NULL, donnees LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_FD26AAB45053569B (formulaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lesvgp_questionnaire ADD CONSTRAINT FK_FD26AAB45053569B FOREIGN KEY (formulaire_id) REFERENCES lesvgp_formulaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lesvgp_questionnaire');
    }
}
