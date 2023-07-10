<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706135132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_music DROP FOREIGN KEY FK_AD5E1219399BBB13');
        $this->addSql('ALTER TABLE artist_music DROP FOREIGN KEY FK_AD5E1219B7970CF8');
        $this->addSql('ALTER TABLE music_artist DROP FOREIGN KEY FK_9481557E399BBB13');
        $this->addSql('ALTER TABLE music_artist DROP FOREIGN KEY FK_9481557EB7970CF8');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_music');
        $this->addSql('DROP TABLE music');
        $this->addSql('DROP TABLE music_artist');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE artist_music (artist_id INT NOT NULL, music_id INT NOT NULL, INDEX IDX_AD5E1219B7970CF8 (artist_id), INDEX IDX_AD5E1219399BBB13 (music_id), PRIMARY KEY(artist_id, music_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_of_release DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE music_artist (music_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_9481557E399BBB13 (music_id), INDEX IDX_9481557EB7970CF8 (artist_id), PRIMARY KEY(music_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artist_music ADD CONSTRAINT FK_AD5E1219399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_music ADD CONSTRAINT FK_AD5E1219B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_artist ADD CONSTRAINT FK_9481557E399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_artist ADD CONSTRAINT FK_9481557EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
