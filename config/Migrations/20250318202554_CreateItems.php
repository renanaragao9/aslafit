<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateItems extends AbstractMigration
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
        $table = $this->table('items');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('quantity', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('unit_price', 'decimal', [
            'default' => null,
            'precision' => 10,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('available_for_use', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('for_sale', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('local_storage', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('item_type_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('supplier_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('storage_location_id', 'integer', [
            'default' => null,
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
        $table->addForeignKey('item_type_id', 'item_types', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('supplier_id', 'suppliers', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('storage_location_id', 'storage_locations', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
