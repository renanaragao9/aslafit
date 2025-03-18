<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCalleds extends AbstractMigration
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
        $table = $this->table('calleds');
        $table->addColumn('urgency', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('subject', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('status', 'string', [
            'default' => 'open',
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);
        $table->addColumn('collaborator_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('student_id', 'integer', [
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
        $table->addForeignKey('collaborator_id', 'collaborators', 'id', [
            'delete' => 'SET_NULL',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('student_id', 'students', 'id', [
            'delete' => 'SET_NULL',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
