<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExpensesLogs Model
 *
 * @method \App\Model\Entity\ExpensesLog newEmptyEntity()
 * @method \App\Model\Entity\ExpensesLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ExpensesLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExpensesLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExpensesLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ExpensesLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExpensesLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExpensesLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpensesLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpensesLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ExpensesLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ExpensesLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ExpensesLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExpensesLogsTable extends Table
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

        $this->setTable('expenses_logs');
        $this->setDisplayField('expense_type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('expense_type')
            ->maxLength('expense_type', 50)
            ->requirePresence('expense_type', 'create')
            ->notEmptyString('expense_type');

        $validator
            ->integer('reference_id')
            ->requirePresence('reference_id', 'create')
            ->notEmptyString('reference_id');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->scalar('transaction_type')
            ->maxLength('transaction_type', 10)
            ->requirePresence('transaction_type', 'create')
            ->notEmptyString('transaction_type');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        return $validator;
    }
}
