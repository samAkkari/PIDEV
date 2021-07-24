<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721221829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_ingredient (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_recette (id INT AUTO_INCREMENT NOT NULL, recette_id INT DEFAULT NULL, ing1_id INT DEFAULT NULL, ing2_id INT DEFAULT NULL, ing3_id INT DEFAULT NULL, ing4_id INT DEFAULT NULL, ing5_id INT DEFAULT NULL, ing6_id INT DEFAULT NULL, ing7_id INT DEFAULT NULL, ing8_id INT DEFAULT NULL, ing9_id INT DEFAULT NULL, ing10_id INT DEFAULT NULL, INDEX IDX_AFE81A8189312FE9 (recette_id), INDEX IDX_AFE81A814B3990D9 (ing1_id), INDEX IDX_AFE81A81598C3F37 (ing2_id), INDEX IDX_AFE81A81E1305852 (ing3_id), INDEX IDX_AFE81A817CE760EB (ing4_id), INDEX IDX_AFE81A81C45B078E (ing5_id), INDEX IDX_AFE81A81D6EEA860 (ing6_id), INDEX IDX_AFE81A816E52CF05 (ing7_id), INDEX IDX_AFE81A813631DF53 (ing8_id), INDEX IDX_AFE81A818E8DB836 (ing9_id), INDEX IDX_AFE81A8191941916 (ing10_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, category_ingredient_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_4B60114F8DE4C5C7 (category_ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, id_menu_id INT DEFAULT NULL, id_produit_id INT DEFAULT NULL, id_commande_id INT DEFAULT NULL, id_utilisateur_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_3170B74B124A4062 (id_menu_id), INDEX IDX_3170B74BAABEFE2C (id_produit_id), INDEX IDX_3170B74B9AF8E3A3 (id_commande_id), INDEX IDX_3170B74BC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, date_naiss VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A8189312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A814B3990D9 FOREIGN KEY (ing1_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A81598C3F37 FOREIGN KEY (ing2_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A81E1305852 FOREIGN KEY (ing3_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A817CE760EB FOREIGN KEY (ing4_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A81C45B078E FOREIGN KEY (ing5_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A81D6EEA860 FOREIGN KEY (ing6_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A816E52CF05 FOREIGN KEY (ing7_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A813631DF53 FOREIGN KEY (ing8_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A818E8DB836 FOREIGN KEY (ing9_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE details_recette ADD CONSTRAINT FK_AFE81A8191941916 FOREIGN KEY (ing10_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F8DE4C5C7 FOREIGN KEY (category_ingredient_id) REFERENCES category_ingredient (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B124A4062 FOREIGN KEY (id_menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F8DE4C5C7');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A814B3990D9');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A81598C3F37');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A81E1305852');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A817CE760EB');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A81C45B078E');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A81D6EEA860');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A816E52CF05');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A813631DF53');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A818E8DB836');
        $this->addSql('ALTER TABLE details_recette DROP FOREIGN KEY FK_AFE81A8191941916');
        $this->addSql('DROP TABLE category_ingredient');
        $this->addSql('DROP TABLE details_recette');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE user');
    }
}
