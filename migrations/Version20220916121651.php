<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916121651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription_examen DROP FOREIGN KEY FK_5973FB955C8659A');
        $this->addSql('ALTER TABLE inscription_examen DROP FOREIGN KEY FK_5973FB955DAC5993');
        $this->addSql('ALTER TABLE inscription_utilisateur DROP FOREIGN KEY FK_EA6DFE63FB88E14F');
        $this->addSql('ALTER TABLE inscription_utilisateur DROP FOREIGN KEY FK_EA6DFE635DAC5993');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_examen');
        $this->addSql('DROP TABLE inscription_utilisateur');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FECAB5ECCCE');
        $this->addSql('DROP INDEX IDX_514C8FECAB5ECCCE ON examen');
        $this->addSql('ALTER TABLE examen CHANGE id_competence_id competence_id INT NOT NULL, CHANGE date_time date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_514C8FEC15761DAB ON examen (competence_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE date naissance DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE inscription_examen (inscription_id INT NOT NULL, examen_id INT NOT NULL, INDEX IDX_5973FB955DAC5993 (inscription_id), INDEX IDX_5973FB955C8659A (examen_id), PRIMARY KEY(inscription_id, examen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE inscription_utilisateur (inscription_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_EA6DFE635DAC5993 (inscription_id), INDEX IDX_EA6DFE63FB88E14F (utilisateur_id), PRIMARY KEY(inscription_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inscription_examen ADD CONSTRAINT FK_5973FB955C8659A FOREIGN KEY (examen_id) REFERENCES examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_examen ADD CONSTRAINT FK_5973FB955DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_utilisateur ADD CONSTRAINT FK_EA6DFE63FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_utilisateur ADD CONSTRAINT FK_EA6DFE635DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC15761DAB');
        $this->addSql('DROP INDEX IDX_514C8FEC15761DAB ON examen');
        $this->addSql('ALTER TABLE examen CHANGE competence_id id_competence_id INT NOT NULL, CHANGE date date_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FECAB5ECCCE FOREIGN KEY (id_competence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_514C8FECAB5ECCCE ON examen (id_competence_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE naissance date DATE NOT NULL');
    }
}
