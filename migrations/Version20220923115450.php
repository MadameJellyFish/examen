<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923115450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6A76ED395 ON inscription (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498E2AD382');
        $this->addSql('DROP INDEX IDX_8D93D6498E2AD382 ON user');
        $this->addSql('ALTER TABLE user DROP inscriptions_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A76ED395');
        $this->addSql('DROP INDEX IDX_5E90F6D6A76ED395 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP user_id');
        $this->addSql('ALTER TABLE user ADD inscriptions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498E2AD382 FOREIGN KEY (inscriptions_id) REFERENCES inscription (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498E2AD382 ON user (inscriptions_id)');
    }
}
