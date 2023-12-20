<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220163335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE galerie_categorie (galerie_id INT NOT NULL, categorie_id INT NOT NULL, PRIMARY KEY(galerie_id, categorie_id))');
        $this->addSql('CREATE INDEX IDX_ABBF71DE825396CB ON galerie_categorie (galerie_id)');
        $this->addSql('CREATE INDEX IDX_ABBF71DEBCF5E72D ON galerie_categorie (categorie_id)');
        $this->addSql('ALTER TABLE galerie_categorie ADD CONSTRAINT FK_ABBF71DE825396CB FOREIGN KEY (galerie_id) REFERENCES galerie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE galerie_categorie ADD CONSTRAINT FK_ABBF71DEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE galerie ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9E7D1590F675F31B ON galerie (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE galerie_categorie DROP CONSTRAINT FK_ABBF71DE825396CB');
        $this->addSql('ALTER TABLE galerie_categorie DROP CONSTRAINT FK_ABBF71DEBCF5E72D');
        $this->addSql('DROP TABLE galerie_categorie');
        $this->addSql('ALTER TABLE galerie DROP CONSTRAINT FK_9E7D1590F675F31B');
        $this->addSql('DROP INDEX IDX_9E7D1590F675F31B');
        $this->addSql('ALTER TABLE galerie DROP author_id');
    }
}
