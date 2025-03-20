<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkLogs Model
 *
 * @property \App\Model\Table\CollaboratorsTable&\Cake\ORM\Association\BelongsTo $Collaborators
 *
 * @method \App\Model\Entity\WorkLog newEmptyEntity()
 * @method \App\Model\Entity\WorkLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\WorkLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\WorkLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\WorkLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\WorkLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\WorkLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WorkLogsTable extends Table
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

        $this->setTable('work_logs');
        $this->setDisplayField('log_type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->integer('collaborator_id')
            ->notEmptyString('collaborator_id');

        $validator
            ->date('log_date')
            ->requirePresence('log_date', 'create')
            ->notEmptyDate('log_date');

        $validator
            ->scalar('log_type')
            ->maxLength('log_type', 10)
            ->requirePresence('log_type', 'create')
            ->notEmptyString('log_type');

        $validator
            ->time('log_time')
            ->requirePresence('log_time', 'create')
            ->notEmptyTime('log_time');

        $validator
            ->scalar('log_address')
            ->maxLength('log_address', 255)
            ->allowEmptyString('log_address');

        $validator
            ->decimal('latitude')
            ->allowEmptyString('latitude');

        $validator
            ->decimal('longitude')
            ->allowEmptyString('longitude');

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
        $rules->add($rules->existsIn('collaborator_id', 'Collaborators'), ['errorField' => 'collaborator_id']);

        return $rules;
    }
}
