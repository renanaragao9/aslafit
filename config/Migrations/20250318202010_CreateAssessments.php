<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateAssessments extends AbstractMigration
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
        $table = $this->table('assessments');
        $table->addColumn('goal', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('observation', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('term', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('height', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('weight', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => false,
        ]);
        $table->addColumn('arm', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('forearm', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('breastplate', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('back', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('waist', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('glute', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('hip', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('thigh', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('calf', 'decimal', [
            'default' => null,
            'precision' => 5,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('student_id', 'integer', [
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
        $table->addForeignKey('ficha_id', 'fichas', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
