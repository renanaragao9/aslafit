<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Collaborators Model
 *
 * @property \App\Model\Table\PositionsTable&\Cake\ORM\Association\BelongsTo $Positions
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CalledsTable&\Cake\ORM\Association\HasMany $Calleds
 * @property \App\Model\Table\EventsTable&\Cake\ORM\Association\HasMany $Events
 * @property \App\Model\Table\MediasTable&\Cake\ORM\Association\HasMany $Medias
 * @property \App\Model\Table\MonthlyPlansTable&\Cake\ORM\Association\HasMany $MonthlyPlans
 * @property \App\Model\Table\WorkLogsTable&\Cake\ORM\Association\HasMany $WorkLogs
 *
 * @method \App\Model\Entity\Collaborator newEmptyEntity()
 * @method \App\Model\Entity\Collaborator newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Collaborator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Collaborator get($primaryKey, $options = [])
 * @method \App\Model\Entity\Collaborator findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Collaborator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Collaborator[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Collaborator|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Collaborator saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Collaborator[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Collaborator[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Collaborator[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Collaborator[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CollaboratorsTable extends Table
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

        $this->setTable('collaborators');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Positions', [
            'foreignKey' => 'position_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Calleds', [
            'foreignKey' => 'collaborator_id',
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'collaborator_id',
        ]);
        $this->hasMany('Medias', [
            'foreignKey' => 'collaborator_id',
        ]);
        $this->hasMany('MonthlyPlans', [
            'foreignKey' => 'collaborator_id',
        ]);
        $this->hasMany('WorkLogs', [
            'foreignKey' => 'collaborator_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('birth_date')
            ->allowEmptyDate('birth_date');

        $validator
            ->date('entry_date')
            ->allowEmptyDate('entry_date');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 10)
            ->allowEmptyString('gender');

        $validator
            ->scalar('color')
            ->maxLength('color', 50)
            ->allowEmptyString('color');

        $validator
            ->scalar('img')
            ->maxLength('img', 255)
            ->allowEmptyString('img');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->integer('position_id')
            ->notEmptyString('position_id');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');

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
        $rules->add($rules->existsIn('position_id', 'Positions'), ['errorField' => 'position_id']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
