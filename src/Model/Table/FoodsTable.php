<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FoodsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('foods');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('DietPlans', [
            'foreignKey' => 'food_id',
        ]);

        $this->belongsTo('FoodTypes', [
            'foreignKey' => 'food_type_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('link')
            ->maxLength('link', 555)
            ->allowEmptyString('link');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyString('image');

        $validator
            ->integer('food_type_id')
            ->requirePresence('food_type_id', 'create')
            ->notEmptyString('food_type_id');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        return $validator;
    }
}
