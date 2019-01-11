<?php

namespace Application\Migrations;

use AppBundle\Entity\Type;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190111141544 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        foreach (Type::TYPES as $type) {
            $this->addSql("INSERT INTO type values (default, '$type')");
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
       $this->addSql("DELETE FROM type");
    }
}
