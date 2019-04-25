<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425164934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_p (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD category_p_id INT NOT NULL, CHANGE category_id category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC279777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2758E019E5 FOREIGN KEY (category_p_id) REFERENCES category_p (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC279777D11E ON produit (category_id_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2758E019E5 ON produit (category_p_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2758E019E5');
        $this->addSql('DROP TABLE category_p');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC279777D11E');
        $this->addSql('DROP INDEX IDX_29A5EC279777D11E ON produit');
        $this->addSql('DROP INDEX IDX_29A5EC2758E019E5 ON produit');
        $this->addSql('ALTER TABLE produit ADD category_id INT NOT NULL, DROP category_id_id, DROP category_p_id');
    }
}
