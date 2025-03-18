<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateExerciseTrainingDivision extends AbstractMigration
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
        $table = $this->table('exercise_training_division');
        $table->addColumn('order', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('series', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('repetitions', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('weight', 'decimal', [
            'default' => null,
            'precision' => 10,
            'scale' => 2,
            'null' => true,
        ]);
        $table->addColumn('rest', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('ficha_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('exercise_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('training_division_id', 'integer', [
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
        $table->addForeignKey('ficha_id', 'fichas', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('exercise_id', 'exercises', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('training_division_id', 'training_divisions', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
