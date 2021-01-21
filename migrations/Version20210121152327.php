<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121152327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE result_state_slots_combination (result_state_id INT NOT NULL, slots_combination_id INT NOT NULL, INDEX IDX_73D0944BA2DD2322 (result_state_id), INDEX IDX_73D0944B626346EF (slots_combination_id), PRIMARY KEY(result_state_id, slots_combination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE result_state_slots_combination ADD CONSTRAINT FK_73D0944BA2DD2322 FOREIGN KEY (result_state_id) REFERENCES result_state (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE result_state_slots_combination ADD CONSTRAINT FK_73D0944B626346EF FOREIGN KEY (slots_combination_id) REFERENCES slots_combination (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE result_state_slots_combination');
    }
}
