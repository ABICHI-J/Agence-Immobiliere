<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502230159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F54C2885D7');
        $this->addSql('DROP INDEX IDX_E46960F54C2885D7 ON favorites');
        $this->addSql('ALTER TABLE favorites CHANGE annonces_id annonce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F58805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
        $this->addSql('CREATE INDEX IDX_E46960F58805AB2F ON favorites (annonce_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F58805AB2F');
        $this->addSql('DROP INDEX IDX_E46960F58805AB2F ON favorites');
        $this->addSql('ALTER TABLE favorites CHANGE annonce_id annonces_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F54C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E46960F54C2885D7 ON favorites (annonces_id)');
    }
}
