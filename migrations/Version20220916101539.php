<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916101539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_examen (inscription_id INT NOT NULL, examen_id INT NOT NULL, INDEX IDX_5973FB955DAC5993 (inscription_id), INDEX IDX_5973FB955C8659A (examen_id), PRIMARY KEY(inscription_id, examen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_user (inscription_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AC25ADFA5DAC5993 (inscription_id), INDEX IDX_AC25ADFAA76ED395 (user_id), PRIMARY KEY(inscription_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription_examen ADD CONSTRAINT FK_5973FB955DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_examen ADD CONSTRAINT FK_5973FB955C8659A FOREIGN KEY (examen_id) REFERENCES examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFA5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription_examen DROP FOREIGN KEY FK_5973FB955DAC5993');
        $this->addSql('ALTER TABLE inscription_examen DROP FOREIGN KEY FK_5973FB955C8659A');
        $this->addSql('ALTER TABLE inscription_user DROP FOREIGN KEY FK_AC25ADFA5DAC5993');
        $this->addSql('ALTER TABLE inscription_user DROP FOREIGN KEY FK_AC25ADFAA76ED395');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_examen');
        $this->addSql('DROP TABLE inscription_user');
    }
}
