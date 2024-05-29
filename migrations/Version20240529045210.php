<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529045210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO coupon (`product_id`, `type`, `persent`) VALUES (1, "fix", 10);');
        $this->addSql('INSERT INTO coupon (`product_id`, `type`, `persent`) VALUES (1, "fix", 50);');
        $this->addSql('INSERT INTO coupon (`product_id`, `type`, `persent`) VALUES (1, "fix", 70);');

        $this->addSql('INSERT INTO coupon (`product_id`, `type`, `persent`) VALUES (2, "persent", 10);');
        $this->addSql('INSERT INTO coupon (`product_id`, `type`, `persent`) VALUES (2, "persent", 25);');
        $this->addSql('INSERT INTO coupon (`product_id`, `type`, `persent`) VALUES (2, "persent", 30);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM coupon;');
    }
}
