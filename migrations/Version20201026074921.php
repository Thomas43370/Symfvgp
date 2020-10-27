<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026074921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesvgp_image_defauts (id INT AUTO_INCREMENT NOT NULL, vgp_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_90B1BDE2B594589C (vgp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesvgp_image_photo (id INT AUTO_INCREMENT NOT NULL, vgp_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_BC14E16DB594589C (vgp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nom (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lesvgp_image_defauts ADD CONSTRAINT FK_90B1BDE2B594589C FOREIGN KEY (vgp_id) REFERENCES lesvgp_vgp (id)');
        $this->addSql('ALTER TABLE lesvgp_image_photo ADD CONSTRAINT FK_BC14E16DB594589C FOREIGN KEY (vgp_id) REFERENCES lesvgp_vgp (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lesvgp_image_defauts');
        $this->addSql('DROP TABLE lesvgp_image_photo');
        $this->addSql('DROP TABLE nom');
    }
}
