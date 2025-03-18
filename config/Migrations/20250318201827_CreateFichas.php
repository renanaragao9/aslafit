<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateFichas extends AbstractMigration
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
        $table = $this->table('fichas');
        $table->addColumn('start_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('end_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('notes', 'json', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('student_id', 'integer', [
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
        $table->addForeignKey('student_id', 'students', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
