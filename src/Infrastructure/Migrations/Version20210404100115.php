<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404100115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Init migration';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("create table task
            (
                id uuid not null,
                author_id int not null,
                executor_id int null,
                status int not null default 0,
                title varchar(255) null,
                description text null,
                optional_fields json null,
                created_at timestamp default CURRENT_TIMESTAMP not null,
                updated_at timestamp default CURRENT_TIMESTAMP not null,
                deleted_at timestamp null,
                PRIMARY KEY(id)
            )
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table task');
    }
}
