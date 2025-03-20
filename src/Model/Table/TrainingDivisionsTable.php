<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TrainingDivisions Model
 *
 * @property \App\Model\Table\ExerciseTrainingDivisionTable&\Cake\ORM\Association\HasMany $ExerciseTrainingDivision
 *
 * @method \App\Model\Entity\TrainingDivision newEmptyEntity()
 * @method \App\Model\Entity\TrainingDivision newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TrainingDivision[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TrainingDivision get($primaryKey, $options = [])
 * @method \App\Model\Entity\TrainingDivision findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TrainingDivision patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TrainingDivision[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TrainingDivision|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TrainingDivision saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TrainingDivision[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TrainingDivision[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TrainingDivision[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TrainingDivision[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TrainingDivisionsTable extends Table
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

        $this->setTable('training_divisions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ExerciseTrainingDivision', [
            'foreignKey' => 'training_division_id',
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
            ->maxLength('name', 355)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active');

        return $validator;
    }
}
