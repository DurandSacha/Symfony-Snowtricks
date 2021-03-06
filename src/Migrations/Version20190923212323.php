<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923212323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, tricks_id INT NOT NULL, user_id INT NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526C3B153154 (tricks_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, tricks_id INT DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, texte VARCHAR(255) DEFAULT NULL, thumbnail TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_6A2CA10C3B153154 (tricks_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tricks (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, category_tricks_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_E1D902C1F675F31B (author_id), INDEX IDX_E1D902C1FC75E364 (category_tricks_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3B153154 FOREIGN KEY (tricks_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C3B153154 FOREIGN KEY (tricks_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C1F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C1FC75E364 FOREIGN KEY (category_tricks_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C1FC75E364');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3B153154');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C3B153154');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C1F675F31B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE tricks');
        $this->addSql('DROP TABLE user');
    }
}
