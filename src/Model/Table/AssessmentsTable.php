<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assessments Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\FichasTable&\Cake\ORM\Association\BelongsTo $Fichas
 *
 * @method \App\Model\Entity\Assessment newEmptyEntity()
 * @method \App\Model\Entity\Assessment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Assessment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Assessment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Assessment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Assessment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Assessment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Assessment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assessment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssessmentsTable extends Table
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

        $this->setTable('assessments');
        $this->setDisplayField('goal');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Fichas', [
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
            ->scalar('goal')
            ->maxLength('goal', 255)
            ->requirePresence('goal', 'create')
            ->notEmptyString('goal');

        $validator
            ->scalar('observation')
            ->maxLength('observation', 255)
            ->allowEmptyString('observation');

        $validator
            ->scalar('term')
            ->maxLength('term', 255)
            ->requirePresence('term', 'create')
            ->notEmptyString('term');

        $validator
            ->decimal('height')
            ->requirePresence('height', 'create')
            ->notEmptyString('height');

        $validator
            ->decimal('weight')
            ->requirePresence('weight', 'create')
            ->notEmptyString('weight');

        $validator
            ->decimal('arm')
            ->allowEmptyString('arm');

        $validator
            ->decimal('forearm')
            ->allowEmptyString('forearm');

        $validator
            ->decimal('breastplate')
            ->allowEmptyString('breastplate');

        $validator
            ->decimal('back')
            ->allowEmptyString('back');

        $validator
            ->decimal('waist')
            ->allowEmptyString('waist');

        $validator
            ->decimal('glute')
            ->allowEmptyString('glute');

        $validator
            ->decimal('hip')
            ->allowEmptyString('hip');

        $validator
            ->decimal('thigh')
            ->allowEmptyString('thigh');

        $validator
            ->decimal('calf')
            ->allowEmptyString('calf');

        $validator
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->integer('ficha_id')
            ->allowEmptyString('ficha_id');

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
        $rules->add($rules->existsIn('ficha_id', 'Fichas'), ['errorField' => 'ficha_id']);

        return $rules;
    }
}
