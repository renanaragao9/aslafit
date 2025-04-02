<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class DietPlansTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('diet_plans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MealTypes', [
            'foreignKey' => 'meal_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Foods', [
            'foreignKey' => 'food_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Fichas', [
            'foreignKey' => 'ficha_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->integer('meal_type_id')
            ->notEmptyString('meal_type_id');

        $validator
            ->integer('food_id')
            ->notEmptyString('food_id');

        $validator
            ->integer('ficha_id')
            ->allowEmptyString('ficha_id');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('meal_type_id', 'MealTypes'), ['errorField' => 'meal_type_id']);
        $rules->add($rules->existsIn('food_id', 'Foods'), ['errorField' => 'food_id']);
        $rules->add($rules->existsIn('ficha_id', 'Fichas'), ['errorField' => 'ficha_id']);

        return $rules;
    }
}
