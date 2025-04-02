<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDietPlans extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('diet_plans');
        $table->addColumn('description', 'string', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('meal_type_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('food_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('ficha_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addForeignKey('meal_type_id', 'meal_types', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('food_id', 'foods', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('ficha_id', 'fichas', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
