<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateWorkLogs extends AbstractMigration
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
        $table = $this->table('work_logs');
        $table->addColumn('collaborator_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('log_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('log_type', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ]);
        $table->addColumn('log_time', 'time', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('log_address', 'string', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('latitude', 'decimal', [
            'default' => null,
            'precision' => 10,
            'scale' => 8,
            'null' => true,
        ]);
        $table->addColumn('longitude', 'decimal', [
            'default' => null,
            'precision' => 11,
            'scale' => 8,
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
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addIndex(['collaborator_id', 'log_date', 'log_type'], [
            'unique' => true,
        ]);
        $table->create();
    }
}
