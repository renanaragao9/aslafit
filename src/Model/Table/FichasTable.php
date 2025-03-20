<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fichas Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\AssessmentsTable&\Cake\ORM\Association\HasMany $Assessments
 * @property \App\Model\Table\DietPlansTable&\Cake\ORM\Association\HasMany $DietPlans
 * @property \App\Model\Table\ExerciseTrainingDivisionTable&\Cake\ORM\Association\HasMany $ExerciseTrainingDivision
 *
 * @method \App\Model\Entity\Ficha newEmptyEntity()
 * @method \App\Model\Entity\Ficha newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ficha[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ficha get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ficha findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ficha patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ficha[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ficha|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ficha saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ficha[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ficha[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ficha[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ficha[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FichasTable extends Table
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

        $this->setTable('fichas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Assessments', [
            'foreignKey' => 'ficha_id',
        ]);
        $this->hasMany('DietPlans', [
            'foreignKey' => 'ficha_id',
        ]);
        $this->hasMany('ExerciseTrainingDivision', [
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
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDate('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->allowEmptyString('notes');

        $validator
            ->integer('student_id')
            ->notEmptyString('student_id');

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

        return $rules;
    }
}
