<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exercises Model
 *
 * @property \App\Model\Table\EquipmentsTable&\Cake\ORM\Association\BelongsTo $Equipments
 * @property \App\Model\Table\MuscleGroupsTable&\Cake\ORM\Association\BelongsTo $MuscleGroups
 * @property \App\Model\Table\ExerciseTrainingDivisionTable&\Cake\ORM\Association\HasMany $ExerciseTrainingDivision
 *
 * @method \App\Model\Entity\Exercise newEmptyEntity()
 * @method \App\Model\Entity\Exercise newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Exercise[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Exercise get($primaryKey, $options = [])
 * @method \App\Model\Entity\Exercise findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Exercise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Exercise[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Exercise|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exercise saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exercise[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exercise[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exercise[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Exercise[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExercisesTable extends Table
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

        $this->setTable('exercises');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Equipments', [
            'foreignKey' => 'equipment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MuscleGroups', [
            'foreignKey' => 'muscle_group_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ExerciseTrainingDivision', [
            'foreignKey' => 'exercise_id',
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
            ->scalar('image')
            ->maxLength('image', 455)
            ->allowEmptyFile('image');

        $validator
            ->scalar('gif')
            ->maxLength('gif', 455)
            ->allowEmptyString('gif');

        $validator
            ->scalar('link')
            ->maxLength('link', 255)
            ->allowEmptyString('link');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active');

        $validator
            ->integer('equipment_id')
            ->notEmptyString('equipment_id');

        $validator
            ->integer('muscle_group_id')
            ->notEmptyString('muscle_group_id');

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
        $rules->add($rules->existsIn('equipment_id', 'Equipments'), ['errorField' => 'equipment_id']);
        $rules->add($rules->existsIn('muscle_group_id', 'MuscleGroups'), ['errorField' => 'muscle_group_id']);

        return $rules;
    }
}
