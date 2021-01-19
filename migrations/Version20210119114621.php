<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210119114621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, generator_config_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type INT NOT NULL, UNIQUE INDEX UNIQ_232B318C3A524A75 (generator_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_symbol (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, name VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_91FD9B31E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator_config (id INT AUTO_INCREMENT NOT NULL, seed INT NOT NULL, min INT NOT NULL, max INT NOT NULL, format LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE result_state (id INT AUTO_INCREMENT NOT NULL, matrix LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE round (id INT AUTO_INCREMENT NOT NULL, result_id INT DEFAULT NULL, game_id INT NOT NULL, status SMALLINT NOT NULL, balance DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_C5EEEA347A7B643 (result_id), UNIQUE INDEX UNIQ_C5EEEA34E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slots_combination (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, fields LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_7988FE51E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3A524A75 FOREIGN KEY (generator_config_id) REFERENCES generator_config (id)');
        $this->addSql('ALTER TABLE game_symbol ADD CONSTRAINT FK_91FD9B31E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA347A7B643 FOREIGN KEY (result_id) REFERENCES result_state (id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA34E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE slots_combination ADD CONSTRAINT FK_7988FE51E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_symbol DROP FOREIGN KEY FK_91FD9B31E48FD905');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA34E48FD905');
        $this->addSql('ALTER TABLE slots_combination DROP FOREIGN KEY FK_7988FE51E48FD905');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3A524A75');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA347A7B643');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_symbol');
        $this->addSql('DROP TABLE generator_config');
        $this->addSql('DROP TABLE result_state');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE slots_combination');
    }
}
