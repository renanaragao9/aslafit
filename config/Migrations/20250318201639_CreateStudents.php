<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateStudents extends AbstractMigration
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
        $table = $this->table('students');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('birth_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('entry_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('gender', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('weight', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('height', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('color', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        $table->addColumn('img', 'string', [
            'default' => 'default-user.jpg',
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'integer', [
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
        $table->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
