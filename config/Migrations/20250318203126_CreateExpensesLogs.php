<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateExpensesLogs extends AbstractMigration
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
        $table = $this->table('expenses_logs');
        $table->addColumn('expense_type', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('reference_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('amount', 'decimal', [
            'default' => null,
            'precision' => 10,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('transaction_type', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('date', 'date', [
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
        $table->create();
    }
}
