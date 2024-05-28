<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240528064359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO product (`title`, `price`) VALUES ("Iphone", 100);');
        $this->addSql('INSERT INTO product (`title`, `price`) VALUES ("Наушники", 20);');
        $this->addSql('INSERT INTO product (`title`, `price`) VALUES ("Чехол", 10);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM product;');
    }
}
