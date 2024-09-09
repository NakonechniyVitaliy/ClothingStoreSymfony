<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909191316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cloth ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cloth ADD CONSTRAINT FK_22F16BBE12469DE2 FOREIGN KEY (category_id) REFERENCES cloth_category (id)');
        $this->addSql('CREATE INDEX IDX_22F16BBE12469DE2 ON cloth (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cloth DROP FOREIGN KEY FK_22F16BBE12469DE2');
        $this->addSql('DROP INDEX IDX_22F16BBE12469DE2 ON cloth');
        $this->addSql('ALTER TABLE cloth DROP category_id');
    }
}
