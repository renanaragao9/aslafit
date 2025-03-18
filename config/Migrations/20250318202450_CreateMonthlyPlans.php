<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMonthlyPlans extends AbstractMigration
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
        $table = $this->table('monthly_plans');
        $table->addColumn('date_payment', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('date_venciment', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('value', 'decimal', [
            'default' => null,
            'precision' => 10,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('observation', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('payment_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('plan_type_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('student_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('collaborator_id', 'integer', [
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
        $table->addForeignKey('payment_id', 'form_payments', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('plan_type_id', 'plan_types', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('student_id', 'students', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('collaborator_id', 'collaborators', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
