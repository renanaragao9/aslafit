<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MonthlyPlans Model
 *
 * @property \App\Model\Table\FormPaymentsTable&\Cake\ORM\Association\BelongsTo $FormPayments
 * @property \App\Model\Table\PlanTypesTable&\Cake\ORM\Association\BelongsTo $PlanTypes
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\CollaboratorsTable&\Cake\ORM\Association\BelongsTo $Collaborators
 *
 * @method \App\Model\Entity\MonthlyPlan newEmptyEntity()
 * @method \App\Model\Entity\MonthlyPlan newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MonthlyPlan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MonthlyPlan get($primaryKey, $options = [])
 * @method \App\Model\Entity\MonthlyPlan findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MonthlyPlan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MonthlyPlan[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MonthlyPlan|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MonthlyPlan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MonthlyPlan[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MonthlyPlan[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MonthlyPlan[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MonthlyPlan[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MonthlyPlansTable extends Table
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

        $this->setTable('monthly_plans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('FormPayments', [
            'foreignKey' => 'payment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PlanTypes', [
            'foreignKey' => 'plan_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Collaborators', [
            'foreignKey' => 'collaborator_id',
            'joinType' => 'INNER',
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
            ->date('date_payment')
            ->requirePresence('date_payment', 'create')
            ->notEmptyDate('date_payment');

        $validator
            ->date('date_venciment')
            ->requirePresence('date_venciment', 'create')
            ->notEmptyDate('date_venciment');

        $validator
            ->decimal('value')
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->scalar('observation')
            ->allowEmptyString('observation');

        $validator
            ->integer('payment_id')
            ->notEmptyString('payment_id');

        $validator
            ->integer('plan_type_id')
            ->notEmptyString('plan_type_id');

        $validator
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->integer('collaborator_id')
            ->notEmptyString('collaborator_id');

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
        $rules->add($rules->existsIn('payment_id', 'FormPayments'), ['errorField' => 'payment_id']);
        $rules->add($rules->existsIn('plan_type_id', 'PlanTypes'), ['errorField' => 'plan_type_id']);
        $rules->add($rules->existsIn('student_id', 'Students'), ['errorField' => 'student_id']);
        $rules->add($rules->existsIn('collaborator_id', 'Collaborators'), ['errorField' => 'collaborator_id']);

        return $rules;
    }
}
