<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DietPlans Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\MealTypesTable&\Cake\ORM\Association\BelongsTo $MealTypes
 * @property \App\Model\Table\FoodsTable&\Cake\ORM\Association\BelongsTo $Foods
 * @property \App\Model\Table\FichasTable&\Cake\ORM\Association\BelongsTo $Fichas
 *
 * @method \App\Model\Entity\DietPlan newEmptyEntity()
 * @method \App\Model\Entity\DietPlan newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DietPlan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DietPlan get($primaryKey, $options = [])
 * @method \App\Model\Entity\DietPlan findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DietPlan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DietPlan[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DietPlan|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DietPlan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DietPlan[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DietPlan[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DietPlan[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DietPlan[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DietPlansTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('diet_plans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
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

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->integer('meal_type_id')
            ->notEmptyString('meal_type_id');

        $validator
            ->integer('food_id')
            ->notEmptyString('food_id');

        $validator
            ->integer('ficha_id')
            ->allowEmptyString('ficha_id');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('student_id', 'Students'), ['errorField' => 'student_id']);
        $rules->add($rules->existsIn('meal_type_id', 'MealTypes'), ['errorField' => 'meal_type_id']);
        $rules->add($rules->existsIn('food_id', 'Foods'), ['errorField' => 'food_id']);
        $rules->add($rules->existsIn('ficha_id', 'Fichas'), ['errorField' => 'ficha_id']);

        return $rules;
    }
}
