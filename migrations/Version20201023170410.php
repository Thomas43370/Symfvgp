<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023170410 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lesvgptitre');
        $this->addSql('ALTER TABLE lesvgp_clients ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesvgp_clients ADD CONSTRAINT FK_F3360986A76ED395 FOREIGN KEY (user_id) REFERENCES lesvgp_users (id)');
        $this->addSql('CREATE INDEX IDX_F3360986A76ED395 ON lesvgp_clients (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesvgptitre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lesvgp_clients DROP FOREIGN KEY FK_F3360986A76ED395');
        $this->addSql('DROP INDEX IDX_F3360986A76ED395 ON lesvgp_clients');
        $this->addSql('ALTER TABLE lesvgp_clients DROP user_id');
    }
}
