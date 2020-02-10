<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200208115114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE villes (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, ville_departement VARCHAR(4) NOT NULL, ville_nom_reel VARCHAR(46) NOT NULL, ville_code_postal VARCHAR(255) NOT NULL, ville_code_commune VARCHAR(6) NOT NULL, ville_arrondissement INT NOT NULL, ville_canton VARCHAR(5) NOT NULL, ville_longitude_deg DOUBLE PRECISION NOT NULL, ville_latitude_deg DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE villes_france_free');
        $this->addSql('ALTER TABLE activitys CHANGE link link VARCHAR(255) DEFAULT NULL, CHANGE prices prices VARCHAR(255) DEFAULT NULL, CHANGE note note VARCHAR(255) DEFAULT NULL, CHANGE img img VARCHAR(255) DEFAULT NULL, CHANGE latitude latitude VARCHAR(255) DEFAULT NULL, CHANGE longitude longitude VARCHAR(255) DEFAULT NULL, CHANGE postcode postcode INT DEFAULT NULL');
        $this->addSql('ALTER TABLE id CHANGE userid userid INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images CHANGE category category VARCHAR(255) DEFAULT NULL, CHANGE img img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE products CHANGE price price VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE alias alias VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE villes_france_free (ville_id INT UNSIGNED AUTO_INCREMENT NOT NULL, ville_departement VARCHAR(3) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, ville_nom_reel VARCHAR(45) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, ville_code_postal VARCHAR(255) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, ville_code_commune VARCHAR(5) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, ville_arrondissement SMALLINT UNSIGNED DEFAULT NULL, ville_canton VARCHAR(4) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`, ville_longitude_deg DOUBLE PRECISION DEFAULT \'NULL\', ville_latitude_deg DOUBLE PRECISION DEFAULT \'NULL\', INDEX ville_departement (ville_departement), INDEX ville_code_postal (ville_code_postal), INDEX ville_nom_reel (ville_nom_reel), INDEX ville_longitude_latitude_deg (ville_longitude_deg, ville_latitude_deg), UNIQUE INDEX ville_code_commune_2 (ville_code_commune), INDEX ville_code_commune (ville_code_commune), PRIMARY KEY(ville_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE villes');
        $this->addSql('ALTER TABLE activitys CHANGE link link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE prices prices VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE note note VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE img img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE latitude latitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE longitude longitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postcode postcode INT DEFAULT NULL');
        $this->addSql('ALTER TABLE id CHANGE userid userid INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images CHANGE category category VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE img img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE products CHANGE price price VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE alias alias VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
