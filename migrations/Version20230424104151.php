<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424104151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites_user DROP FOREIGN KEY FK_1650483B84DDC6B4');
        $this->addSql('ALTER TABLE favorites_user DROP FOREIGN KEY FK_1650483BA76ED395');
        $this->addSql('DROP TABLE favorites_user');
        $this->addSql('ALTER TABLE favorites ADD user_id INT DEFAULT NULL, ADD annonces_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F54C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id)');
        $this->addSql('CREATE INDEX IDX_E46960F5A76ED395 ON favorites (user_id)');
        $this->addSql('CREATE INDEX IDX_E46960F54C2885D7 ON favorites (annonces_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorites_user (favorites_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1650483B84DDC6B4 (favorites_id), INDEX IDX_1650483BA76ED395 (user_id), PRIMARY KEY(favorites_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favorites_user ADD CONSTRAINT FK_1650483B84DDC6B4 FOREIGN KEY (favorites_id) REFERENCES favorites (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_user ADD CONSTRAINT FK_1650483BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F5A76ED395');
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F54C2885D7');
        $this->addSql('DROP INDEX IDX_E46960F5A76ED395 ON favorites');
        $this->addSql('DROP INDEX IDX_E46960F54C2885D7 ON favorites');
        $this->addSql('ALTER TABLE favorites DROP user_id, DROP annonces_id');
    }
}
