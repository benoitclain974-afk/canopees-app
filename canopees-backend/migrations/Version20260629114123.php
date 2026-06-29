<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260629114123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE demande_devis (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, prestation_id INT NOT NULL, ouvrier_id INT DEFAULT NULL, INDEX IDX_7DF9460219EB6921 (client_id), INDEX IDX_7DF946029E45C554 (prestation_id), INDEX IDX_7DF946024E853A9E (ouvrier_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvre (id INT AUTO_INCREMENT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_35FE2EFE9E45C554 (prestation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ouvrier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu_detaille LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, titre_bloc VARCHAR(255) NOT NULL, texte_tarifs LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF9460219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF946029E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE demande_devis ADD CONSTRAINT FK_7DF946024E853A9E FOREIGN KEY (ouvrier_id) REFERENCES ouvrier (id)');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_devis DROP FOREIGN KEY FK_7DF9460219EB6921');
        $this->addSql('ALTER TABLE demande_devis DROP FOREIGN KEY FK_7DF946029E45C554');
        $this->addSql('ALTER TABLE demande_devis DROP FOREIGN KEY FK_7DF946024E853A9E');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE9E45C554');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE demande_devis');
        $this->addSql('DROP TABLE oeuvre');
        $this->addSql('DROP TABLE ouvrier');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE tarif');
    }
}
