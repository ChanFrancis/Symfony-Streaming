<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241002150522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media ADD title VARCHAR(255) NOT NULL, ADD short_description LONGTEXT NOT NULL, ADD long_description LONGTEXT NOT NULL, ADD release_date DATE NOT NULL, ADD cover_image VARCHAR(255) NOT NULL, ADD staff JSON DEFAULT NULL, ADD cast JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media DROP title, DROP short_description, DROP long_description, DROP release_date, DROP cover_image, DROP staff, DROP cast');
    }
}
