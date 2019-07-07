<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190707181821 extends AbstractMigration
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
        $this->addSql('ALTER TABLE comment ADD id INT AUTO_INCREMENT NOT NULL, ADD user_id INT NOT NULL, ADD content VARCHAR(255) NOT NULL, ADD date DATE NOT NULL, DROP ssd, DROP ssa, DROP ssq, DROP sssq, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('ALTER TABLE tricks ADD id INT AUTO_INCREMENT NOT NULL, DROP comment, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user ADD id INT AUTO_INCREMENT NOT NULL, ADD email VARCHAR(180) DEFAULT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD token VARCHAR(255) DEFAULT NULL, DROP d, DROP ds, DROP df, DROP ff, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C112469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE comment MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3B153154');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('ALTER TABLE comment DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE comment ADD ssa INT NOT NULL, ADD ssq INT NOT NULL, ADD sssq INT NOT NULL, DROP id, DROP content, DROP date, CHANGE user_id ssd INT NOT NULL');
        $this->addSql('ALTER TABLE tricks MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE tricks DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tricks ADD comment INT NOT NULL, DROP id, CHANGE name name INT NOT NULL, CHANGE description description INT NOT NULL');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user ADD d INT NOT NULL, ADD ds INT NOT NULL, ADD df INT NOT NULL, ADD ff INT NOT NULL, DROP id, DROP email, DROP roles, DROP password, DROP username, DROP token');
    }
}
