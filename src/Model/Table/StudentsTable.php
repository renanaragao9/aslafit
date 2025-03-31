<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CalledsTable&\Cake\ORM\Association\HasMany $Calleds
 * @property \App\Model\Table\EventRegistrationsTable&\Cake\ORM\Association\HasMany $EventRegistrations
 * @property \App\Model\Table\FichasTable&\Cake\ORM\Association\HasMany $Fichas
 * @property \App\Model\Table\MonthlyPlansTable&\Cake\ORM\Association\HasMany $MonthlyPlans
 *
 * @method \App\Model\Entity\Student newEmptyEntity()
 * @method \App\Model\Entity\Student newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student get($primaryKey, $options = [])
 * @method \App\Model\Entity\Student findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Student[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
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

        $this->setTable('students');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Calleds', [
            'foreignKey' => 'student_id',
        ]);
        $this->hasMany('EventRegistrations', [
            'foreignKey' => 'student_id',
        ]);
        $this->hasMany('Fichas', [
            'foreignKey' => 'student_id',
        ]);
        $this->hasMany('MonthlyPlans', [
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('birth_date')
            ->requirePresence('birth_date', 'create')
            ->notEmptyDate('birth_date');

        $validator
            ->date('entry_date')
            ->requirePresence('entry_date', 'create')
            ->notEmptyDate('entry_date');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 10)
            ->allowEmptyString('gender');

        $validator
            ->decimal('weight')
            ->requirePresence('weight', 'create')
            ->notEmptyString('weight');

        $validator
            ->decimal('height')
            ->requirePresence('height', 'create')
            ->notEmptyString('height');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
