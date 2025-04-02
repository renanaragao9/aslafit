<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FichasTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('fichas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Assessments', [
            'foreignKey' => 'ficha_id',
        ]);
        $this->hasMany('DietPlans', [
            'foreignKey' => 'ficha_id',
        ]);
        $this->hasMany('ExerciseTrainingDivision', [
            'foreignKey' => 'ficha_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDate('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->allowEmptyString('notes');

        $validator
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('student_id', 'Students'), ['errorField' => 'student_id']);

        return $rules;
    }
}
