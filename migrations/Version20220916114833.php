<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916114833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FECAB5ECCCE');
        $this->addSql('DROP INDEX IDX_514C8FECAB5ECCCE ON examen');
        $this->addSql('ALTER TABLE examen CHANGE id_competence_id competence_id INT NOT NULL');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_514C8FEC15761DAB ON examen (competence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC15761DAB');
        $this->addSql('DROP INDEX IDX_514C8FEC15761DAB ON examen');
        $this->addSql('ALTER TABLE examen CHANGE competence_id id_competence_id INT NOT NULL');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FECAB5ECCCE FOREIGN KEY (id_competence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_514C8FECAB5ECCCE ON examen (id_competence_id)');
    }
}
