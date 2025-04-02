<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateFoods extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('foods');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('link', 'string', [
            'default' => null,
            'limit' => 555,
            'null' => true,
        ]);
        $table->addColumn('image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('food_type_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addForeignKey('food_type_id', 'food_types', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
