<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExerciseTrainingDivision Model
 *
 * @property \App\Model\Table\FichasTable&\Cake\ORM\Association\BelongsTo $Fichas
 * @property \App\Model\Table\ExercisesTable&\Cake\ORM\Association\BelongsTo $Exercises
 * @property \App\Model\Table\TrainingDivisionsTable&\Cake\ORM\Association\BelongsTo $TrainingDivisions
 *
 * @method \App\Model\Entity\ExerciseTrainingDivision newEmptyEntity()
 * @method \App\Model\Entity\ExerciseTrainingDivision newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ExerciseTrainingDivision[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExerciseTrainingDivisionTable extends Table
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

        $this->setTable('exercise_training_division');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Fichas', [
            'foreignKey' => 'ficha_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Exercises', [
            'foreignKey' => 'exercise_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TrainingDivisions', [
            'foreignKey' => 'training_division_id',
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
            ->integer('order')
            ->requirePresence('order', 'create')
            ->notEmptyString('order');

        $validator
            ->integer('series')
            ->requirePresence('series', 'create')
            ->notEmptyString('series');

        $validator
            ->integer('repetitions')
            ->requirePresence('repetitions', 'create')
            ->notEmptyString('repetitions');

        $validator
            ->decimal('weight')
            ->allowEmptyString('weight');

        $validator
            ->integer('rest')
            ->allowEmptyString('rest');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('ficha_id')
            ->notEmptyString('ficha_id');

        $validator
            ->integer('exercise_id')
            ->notEmptyString('exercise_id');

        $validator
            ->integer('training_division_id')
            ->notEmptyString('training_division_id');

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
        $rules->add($rules->existsIn('ficha_id', 'Fichas'), ['errorField' => 'ficha_id']);
        $rules->add($rules->existsIn('exercise_id', 'Exercises'), ['errorField' => 'exercise_id']);
        $rules->add($rules->existsIn('training_division_id', 'TrainingDivisions'), ['errorField' => 'training_division_id']);

        return $rules;
    }
}
