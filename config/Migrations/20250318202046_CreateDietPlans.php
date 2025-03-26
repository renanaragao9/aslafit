<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDietPlans extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
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
