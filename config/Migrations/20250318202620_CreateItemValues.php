<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateItemValues extends AbstractMigration
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
        $table = $this->table('item_values');
        $table->addColumn('item_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('field_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('value', 'text', [
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
        $table->addForeignKey('item_id', 'items', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('field_id', 'items_fields', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
