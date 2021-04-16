<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416132254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, generator_config_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type INT NOT NULL, UNIQUE INDEX UNIQ_232B318C3A524A75 (generator_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_session (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', game_id INT DEFAULT NULL, created_at DATETIME NOT NULL, expired_at DATETIME DEFAULT NULL, token VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, suid BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_4586AAFBE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_symbol (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, name VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_91FD9B31E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator_config (id INT AUTO_INCREMENT NOT NULL, seed INT NOT NULL, min INT NOT NULL, max INT NOT NULL, format LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE result_state (id INT AUTO_INCREMENT NOT NULL, matrix LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE result_state_slots_combination (result_state_id INT NOT NULL, slots_combination_id INT NOT NULL, INDEX IDX_73D0944BA2DD2322 (result_state_id), INDEX IDX_73D0944B626346EF (slots_combination_id), PRIMARY KEY(result_state_id, slots_combination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE round (id INT AUTO_INCREMENT NOT NULL, result_id INT DEFAULT NULL, game_id INT NOT NULL, session_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', status SMALLINT NOT NULL, balance DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_C5EEEA347A7B643 (result_id), INDEX IDX_C5EEEA34E48FD905 (game_id), INDEX IDX_C5EEEA34613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slots_combination (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, fields LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_7988FE51E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3A524A75 FOREIGN KEY (generator_config_id) REFERENCES generator_config (id)');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_symbol ADD CONSTRAINT FK_91FD9B31E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE result_state_slots_combination ADD CONSTRAINT FK_73D0944BA2DD2322 FOREIGN KEY (result_state_id) REFERENCES result_state (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE result_state_slots_combination ADD CONSTRAINT FK_73D0944B626346EF FOREIGN KEY (slots_combination_id) REFERENCES slots_combination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA347A7B643 FOREIGN KEY (result_id) REFERENCES result_state (id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA34E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA34613FECDF FOREIGN KEY (session_id) REFERENCES game_session (id)');
        $this->addSql('ALTER TABLE slots_combination ADD CONSTRAINT FK_7988FE51E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_session DROP FOREIGN KEY FK_4586AAFBE48FD905');
        $this->addSql('ALTER TABLE game_symbol DROP FOREIGN KEY FK_91FD9B31E48FD905');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA34E48FD905');
        $this->addSql('ALTER TABLE slots_combination DROP FOREIGN KEY FK_7988FE51E48FD905');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA34613FECDF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3A524A75');
        $this->addSql('ALTER TABLE result_state_slots_combination DROP FOREIGN KEY FK_73D0944BA2DD2322');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA347A7B643');
        $this->addSql('ALTER TABLE result_state_slots_combination DROP FOREIGN KEY FK_73D0944B626346EF');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_session');
        $this->addSql('DROP TABLE game_symbol');
        $this->addSql('DROP TABLE generator_config');
        $this->addSql('DROP TABLE result_state');
        $this->addSql('DROP TABLE result_state_slots_combination');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE slots_combination');
    }
}
