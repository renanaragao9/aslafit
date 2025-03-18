<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateItemLogs extends AbstractMigration
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
        $table = $this->table('item_logs');
        $table->addColumn('item_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('location_id', 'integer', [
            'default' => null,
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
        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);
        $table->addColumn('sold', 'boolean', [
            'default' => false,
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
        $table->addForeignKey('item_id', 'items', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('location_id', 'storage_locations', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
