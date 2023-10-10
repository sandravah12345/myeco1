<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010123559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, commande_date DATE NOT NULL, statut VARCHAR(15) NOT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie CHANGE homme homme VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE femme femme VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE enfant enfant VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE categorie CHANGE homme homme VARCHAR(10) NOT NULL, CHANGE femme femme VARCHAR(10) NOT NULL, CHANGE enfant enfant VARCHAR(10) NOT NULL');
    }
}
