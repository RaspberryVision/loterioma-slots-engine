<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223162219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE round ADD session_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA34613FECDF FOREIGN KEY (session_id) REFERENCES game_session (id)');
        $this->addSql('CREATE INDEX IDX_C5EEEA34613FECDF ON round (session_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA34613FECDF');
        $this->addSql('DROP INDEX IDX_C5EEEA34613FECDF ON round');
        $this->addSql('ALTER TABLE round DROP session_id');
    }
}
