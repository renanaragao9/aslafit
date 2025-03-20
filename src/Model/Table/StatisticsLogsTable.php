<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StatisticsLogs Model
 *
 * @method \App\Model\Entity\StatisticsLog newEmptyEntity()
 * @method \App\Model\Entity\StatisticsLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StatisticsLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StatisticsLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\StatisticsLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StatisticsLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StatisticsLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StatisticsLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StatisticsLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StatisticsLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatisticsLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatisticsLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatisticsLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StatisticsLogsTable extends Table
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

        $this->setTable('statistics_logs');
        $this->setDisplayField('statistic_type');
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
            ->scalar('statistic_type')
            ->maxLength('statistic_type', 50)
            ->requirePresence('statistic_type', 'create')
            ->notEmptyString('statistic_type');

        $validator
            ->integer('reference_id')
            ->requirePresence('reference_id', 'create')
            ->notEmptyString('reference_id');

        $validator
            ->integer('value')
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        return $validator;
    }
}
