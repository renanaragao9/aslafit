<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Calleds Model
 *
 * @property \App\Model\Table\CollaboratorsTable&\Cake\ORM\Association\BelongsTo $Collaborators
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 *
 * @method \App\Model\Entity\Called newEmptyEntity()
 * @method \App\Model\Entity\Called newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Called[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Called get($primaryKey, $options = [])
 * @method \App\Model\Entity\Called findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Called patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Called[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Called|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Called saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Called[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Called[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Called[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Called[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CalledsTable extends Table
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

        $this->setTable('calleds');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Collaborators', [
            'foreignKey' => 'collaborator_id',
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
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
            ->scalar('urgency')
            ->maxLength('urgency', 50)
            ->requirePresence('urgency', 'create')
            ->notEmptyString('urgency');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('subject')
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->allowEmptyString('notes');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->notEmptyString('status');

        $validator
            ->integer('collaborator_id')
            ->allowEmptyString('collaborator_id');

        $validator
            ->integer('student_id')
            ->allowEmptyString('student_id');

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
        $rules->add($rules->existsIn('student_id', 'Students'), ['errorField' => 'student_id']);

        return $rules;
    }
}
