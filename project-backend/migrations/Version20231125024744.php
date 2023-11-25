<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231125024744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE chart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chart (id INT NOT NULL, name_coin_id INT DEFAULT NULL, id_coin_id INT DEFAULT NULL, current_amount_id INT DEFAULT NULL, volume_usd24_hr DOUBLE PRECISION NOT NULL, volume_usd1_hr DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E5562A2A20F819 ON chart (name_coin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E5562A2AD6D614D7 ON chart (id_coin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E5562A2A4097C734 ON chart (current_amount_id)');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT FK_E5562A2A20F819 FOREIGN KEY (name_coin_id) REFERENCES coin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT FK_E5562A2AD6D614D7 FOREIGN KEY (id_coin_id) REFERENCES coin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT FK_E5562A2A4097C734 FOREIGN KEY (current_amount_id) REFERENCES coin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE chart_id_seq CASCADE');
        $this->addSql('ALTER TABLE chart DROP CONSTRAINT FK_E5562A2A20F819');
        $this->addSql('ALTER TABLE chart DROP CONSTRAINT FK_E5562A2AD6D614D7');
        $this->addSql('ALTER TABLE chart DROP CONSTRAINT FK_E5562A2A4097C734');
        $this->addSql('DROP TABLE chart');
    }
}
